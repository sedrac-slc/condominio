(function (win, doc) {
    "use strict";

    const formPagamento = doc.querySelector('#form-pagamento');
    const btnAddPagamento = doc.querySelector("#btn-add-pagamento");
    const modalPagamentoTitle = doc.querySelector('#modalPagamentoTitle');

    const btnUpItems = doc.querySelectorAll('.btn-pagamento-tr');
    const btnDelItems = doc.querySelectorAll('.btn-pagamento-del');

    btnAddPagamento.addEventListener('click',(e)=>{
        let formControl = doc.querySelectorAll(".form-control");
        formControl.forEach((input) => {input.setAttribute("value", "");});
        modalPagamentoTitle.innerHTML = "Adicionar";
        formPagamento.querySelector("[name='_method']").setAttribute('value','POST');
    });

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            let row = item.parentElement.parentElement;
            let column = row.children;
            let mes = {name:"mes", value: column[2].innerHTML};
            let pagamentoDatas = [
                {name:"nome", value: column[0].innerHTML},
                {name:"valor", value: column[1].innerHTML},
                {name:"ano", value: column[3].innerHTML},
                {name:"descricao", value: column[4].innerHTML},
            ];

            modalPagamentoTitle.innerHTML = "Actualização";
            formPagamento.action = item.getAttribute('url');
            formPagamento.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
            pagamentoDatas.forEach(obj =>{
                doc.querySelector(`[name='${obj.name}']`).setAttribute("value", obj.value);
            });

            changeSelectMes(mes);

        })
    });

    function changeSelectMes(mes){
        let select = doc.querySelector('[name="mes"]');
        let selectOptions = select.children;
        let options = [];
        for(let i = 0; i < selectOptions.length; i++)
            options.push({value: selectOptions[i].value, html: selectOptions[i].innerHTML});
        select.innerHTML = '';
        let html = "";
        for(let i = 0; i < options.length; i++){
            let status = options[i].html.trim().toLowerCase() == mes.value.trim().toLowerCase();
            let seleted = status ? "selected" : "";
            html += `<option value="${options[i].value}" ${seleted}>${options[i].html}</option>`;
        }
        select.innerHTML = html;
    }

    btnDelItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            doc.querySelector('#form-del').action = item.getAttribute('url');
        })
    });

})(window, document);
