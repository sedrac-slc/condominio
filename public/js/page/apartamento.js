(function (win, doc) {
    "use strict";

    const formApartamento = doc.querySelector('#form-apartamento');
    const btnAddApartamento = doc.querySelector("#btn-add-apartamento");
    const modalApartamantoTitle = doc.querySelector('#modalApartamantoTitle');

    const btnUpItems = doc.querySelectorAll('.btn-apartamento-tr');
    const btnDelItems = doc.querySelectorAll('.btn-apartamento-del');
    const  textArea = doc.querySelectorAll('#descricao');

    btnAddApartamento.addEventListener('click',(e)=>{
        let formControl = doc.querySelectorAll(".form-control");
        formControl.forEach((input) => {input.setAttribute("value", "");});
        textArea.innerHTML="";
        modalApartamantoTitle.innerHTML = "Adicionar";
        formApartamento.querySelector("[name='_method']").setAttribute('value','POST');
    });

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            let row = item.parentElement.parentElement;
            let column = row.children;
            let apartamentoDatas = [
                {name:"num_casa", value: column[0].innerHTML},
                {name:"dimensao", value: column[1].innerHTML},
                {name:"descricao", value: column[2].innerHTML},
            ];
            textArea.innerHTML =  column[2].innerHTML;
            textArea.placeholder =  column[2].innerHTML;
            modalApartamantoTitle.innerHTML = "Actualização";
            formApartamento.action = item.getAttribute('url');
            formApartamento.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
            apartamentoDatas.forEach(obj =>{
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
