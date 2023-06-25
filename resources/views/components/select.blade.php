<label for="{{ $name }}">
    <i class="{{ $icon }}"></i>
    <span>{{ $label }}</span>
    @if ($require ?? false)
        <span class="text-danger">*</span>
    @endif
</label>
<select class="form-control @isset($class) {{ $class }} @endisset" name="{{ $name }}" id="{{ $name }}" @if ($require ?? false) required @endif
 @isset($default) default="{{ $default }}" @endisset>
    @isset($init)
        @foreach ($list as $key => $value)
            <option value="{{$key}}" @if ($key == $init) selected @endif>{{$value}}</option>
        @endforeach
    @else
        @isset($display)
            <option value="">{{ $display ?? "Escolha uma das opções"}}</option>
        @else
            <option value="">{{ "Escolha uma das opções"}}</option>
        @endisset

        @foreach ($list as $key => $value)
            <option value="{{$key}}">{{$value}}</option>
        @endforeach

    @endisset
</select>
