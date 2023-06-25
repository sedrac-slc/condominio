(function (win, doc) {
    "use strict";

    const formReuniao = doc.querySelector('#form-reuniao');
    const btnAddReuniao = doc.querySelector("#btn-add-reuniao");
    const modalReuniaoTitle = doc.querySelector('#modalReuniaoTitle');

    const btnUpItems = doc.querySelectorAll('.btn-reuniao-tr');
    const btnDelItems = doc.querySelectorAll('.btn-reuniao-del');

    btnAddReuniao.addEventListener('click',(e)=>{
        let formControl = doc.querySelectorAll(".form-control");
        formControl.forEach((input) => {input.setAttribute("value", "");});
        modalReuniaoTitle.innerHTML = "Adicionar";
    });

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            let row = item.parentElement.parentElement;
            let column = row.children;
            let reuniaoDatas = [
                {name:"tema", value: column[0].innerHTML},
                {name:"data", value: column[1].innerHTML},
                {name:"hora_comeco", value: column[2].innerHTML}
            ];
            modalReuniaoTitle.innerHTML = "Actualização";
            formReuniao.action = item.getAttribute('url');
            doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
            reuniaoDatas.forEach(obj =>{
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
