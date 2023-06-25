(function (win, doc) {
    "use strict";

    const formServico = doc.querySelector('#form-servico');
    const btnAddServico = doc.querySelector("#btn-add-servico");
    const modalServicoTitle = doc.querySelector('#modalServicoTitle');

    const btnUpItems = doc.querySelectorAll('.btn-servico-tr');
    const btnDelItems = doc.querySelectorAll('.btn-servico-del');

    btnAddServico.addEventListener('click',(e)=>{
        let formControl = doc.querySelectorAll(".form-control");
        formControl.forEach((input) => {input.setAttribute("value", "");});
        modalServicoTitle.innerHTML = "Adicionar";
        formServico.querySelector("[name='_method']").setAttribute('value','POST');
    });

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            let row = item.parentElement.parentElement;
            let column = row.children;
            let servicoDatas = [
                {name:"nome", value: column[0].innerHTML},
                {name:"descricao", value: column[1].innerHTML},
            ];
            modalServicoTitle.innerHTML = "Actualização";
            formServico.action = item.getAttribute('url');
            formServico.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
            servicoDatas.forEach(obj =>{
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
