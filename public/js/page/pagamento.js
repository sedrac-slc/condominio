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
            let pagamentoDatas = [
                {name:"nome", value: column[0].innerHTML},
                {name:"valor", value: column[1].innerHTML},
                {name:"descricao", value: column[2].innerHTML},
            ];
            modalPagamentoTitle.innerHTML = "Actualização";
            formPagamento.action = item.getAttribute('url');
            formPagamento.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
            pagamentoDatas.forEach(obj =>{
                doc.querySelector(`[name='${obj.name}']`).setAttribute("value", obj.value);
            });

        })
    });

    btnDelItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            doc.querySelector('#form-del').action = item.getAttribute('url');
        })
    });

})(window, document);
