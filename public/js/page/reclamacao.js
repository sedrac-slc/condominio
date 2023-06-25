(function (win, doc) {
    "use strict";

    const formReclamacao = doc.querySelector('#form-reclamacao');
    const btnAddApartamento = doc.querySelector("#btn-add-reclamacao");
    const modalReclamacaoTitle = doc.querySelector('#modalReclamacaoTitle');

    const btnUpItems = doc.querySelectorAll('.btn-reclamacao-tr');
    const btnDelItems = doc.querySelectorAll('.btn-reclamacao-del');
    const  textArea = doc.querySelectorAll('#descricao');

    btnAddApartamento.addEventListener('click',(e)=>{
        let formControl = doc.querySelectorAll(".form-control");
        formControl.forEach((input) => {input.setAttribute("value", "");});
        textArea.innerHTML="";
        modalReclamacaoTitle.innerHTML = "Adicionar";
        formReclamacao.action = btnAddApartamento.getAttribute('url');
        formReclamacao.querySelector("[name='_method']").setAttribute('value',btnAddApartamento.getAttribute('method'));
    });

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            let row = item.parentElement.parentElement;
            let column = row.children;
            let reclamacaoDatas = [
                {name:"motivo", value: column[0].innerHTML},
                {name:"descricao", value: column[1].innerHTML},
            ];
            modalReclamacaoTitle.innerHTML = "Actualização";
            formReclamacao.action = item.getAttribute('url');
            formReclamacao.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
            reclamacaoDatas.forEach(obj =>{
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
