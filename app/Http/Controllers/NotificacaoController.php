<?php

namespace App\Http\Controllers;

use App\Models\Notificacao;
use App\Models\Reuniao;
use App\Models\User;
use App\Utils\AlertMessage;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;


class NotificacaoController extends Controller
{

    public function notificao($reuniao_id)
    {
        return DB::table('notificacaos')
            ->where('reuniao_id', $reuniao_id)
            ->select('user_id')
            ->distinct()
            ->get()->map(function ($item) {
                return $item->user_id;
            });
    }

    public function users_notificacao(Request $request, $id)
    {
        $panel = "reuniao";
        $reuniao = Reuniao::find($id);
        $users = DB::table('user_menbro_or_morador_residente as umomr')
            ->whereNotIn('umomr.id', $this->notificao($id))
            ->select('umomr.*')
            ->paginate();
        if (isset($request->type) && $request->type == "plus") {
            $mult = true;
            return view('page.reuniao.users_notificacao', compact('users', 'reuniao', 'panel', 'mult'));
        }

        return view('page.reuniao.users_notificacao', compact('users', 'reuniao', 'panel'));
    }

    public function users_confirmacao($id)
    {
        $panel = "reuniao";
        $reuniao = Reuniao::find($id);
        $users = DB::table('user_menbro_or_morador_residente as umomr')
            ->whereIn('umomr.id', $this->notificao($id))
            ->select('umomr.*')
            ->paginate();
        return view('page.reuniao.users_confirmacao', compact('users', 'reuniao', 'panel'));
    }

    private function enviarMensagemParaEmail($assunto, $mensagem, $email)
    {
        Mail::html($mensagem, function ($message) use ($email, $assunto) {
            $message->to($email)->subject($assunto);
        });
    }

    private function prepararMensagemParaEnviar($reuniao, $user)
    {
        $this->enviarMensagemParaEmail(
            "Convite para reunião ({$reuniao->tema})S",
            "Caro senhor(a) {$user->name} pedimos a sua comparência para esta reunião marcado às {$reuniao->hora_comeco} em {$reuniao->data}. Actualizado: " . Carbon::now(),
            $user->email
        );
    }

    private function foiConvidado($reuniao_id, $user_id): bool
    {
        $notificado = Notificacao::where([
            'user_id' => $user_id,
            'reuniao_id' => $reuniao_id
        ])->first();
        return isset($notificado->id);
    }

    private function tentaEnviarMensagem($reuniao_id, $user_id)
    {
        DB::transaction(function () use ($reuniao_id, $user_id) {
            $user = User::find($user_id);
            $reuniao = Reuniao::find($reuniao_id);
            $this->prepararMensagemParaEnviar($reuniao, $user);
            Notificacao::create([
                'user_id' => $user->id,
                'reuniao_id' => $reuniao->id,
                'how_created' => Auth::user()->id,
                'how_updated' => Auth::user()->id
            ]);
        });
    }

    public function notificar_store($reuniao_id, $user_id)
    {
        try {
            if ($this->foiConvidado($reuniao_id, $user_id)) {
                toastr()->warning("Este utilizador já foi notificado", "Aviso!");
                return redirect()->back();
            }
            $this->tentaEnviarMensagem($reuniao_id, $user_id);
            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message, $alertMessage->type);
        } catch (Exception) {
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message, $alertMessage->type);
        } finally {
            return redirect()->route('reuniao.home');
        }
    }

    public function notificar_store_mult(Request $request, $reuniao_id)
    {
        try {
            $request->validate(["users" => 'required']);

            if (sizeof($request->users) == 0) {
                toastr()->warning("Nenhum usuário selecionado", "Aviso!");
                return redirect()->back();
            }

            foreach ($request->users as $key => $value)
                if (!$this->foiConvidado($reuniao_id, $value))
                    $this->tentaEnviarMensagem($reuniao_id, $value);

            $alertMessage = AlertMessage::CREATE();
            toastr()->success($alertMessage->message, $alertMessage->type);
        } catch (Exception) {
            $alertMessage = AlertMessage::DANGER();
            toastr()->error($alertMessage->message, $alertMessage->type);
        } finally {
            return redirect()->route('reuniao.home');
        }
    }

    public function users_notificacao_cancel($reuniao_id, $user_id)
    {
        try {
            if ($this->foiConvidado($reuniao_id, $user_id)) {
                DB::transaction(function () use ($reuniao_id, $user_id) {
                    $notificado = Notificacao::where([
                        'user_id' => $user_id,
                        'reuniao_id' => $reuniao_id
                    ])->first();
                    
                    $notificado->delete();

                    $user = User::find($user_id);
                    $reuniao = Reuniao::find($reuniao_id);

                    $this->enviarMensagemParaEmail(
                        "Cancelamento do convite para reunião ({$reuniao->tema})",
                        "Caro senhor(a) {$user->name} informanos que não será necessário a sua presença na reunião marcado às {$reuniao->hora_comeco} em {$reuniao->data}. Actualizado: " . Carbon::now(),
                        $user->email
                    );
                });
            }
            toastr()->success("Notificação de cancelamento, foi realizado com successo", "Aviso");
            return redirect()->back();
        } catch (\Exception) {
            toastr()->warning("Nenhum usuário selecionado", "Aviso!");
            return redirect()->back();
        }
    }

    public function search(Request $request, $reuniao_id)
    {
        $panel = "reuniao";
        $reuniao = Reuniao::find($reuniao_id);
        $field = strtolower($request->field);
        $search = htmlspecialchars($request->search);
        $users = DB::table('user_menbro_or_morador_residente as umomr')
            ->whereNotIn('umomr.id', $this->notificao($reuniao_id))
            ->where($field, 'like', '%' . $search . '%')
            ->select('umomr.*')
            ->paginate();

        if (isset($request->type)) {
            $mult = true;
            return view('page.reuniao.users_notificacao', compact('users', 'reuniao', 'panel', 'mult'));
        }

        return view('page.reuniao.users_notificacao', compact('users', 'reuniao', 'panel'));
    }

    public function painel()
    {
        $panel = "notificacao";
        return view('page.notificacao', compact('panel'));
    }
}
