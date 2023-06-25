(function (win, doc) {
    "use strict";

    const selectUserType = doc.querySelector('#user_type_perfil');
    const selectUserFuncao = doc.querySelector('#funcao');

    const componentMembro = doc.querySelectorAll('.component-membro');


    const formUser = doc.querySelector('#form-user');
    const btnUserUp = doc.querySelector("#btn-up-user");
    const btnUserAdd = doc.querySelector("#btn-add-user");
    const btnUserDel = doc.querySelector("#btn-del-user");
    const passwordInput = doc.querySelector('#password-input');
    const modalUserTitle = doc.querySelector('#modalUserTitle');

    const btnUpItems = doc.querySelectorAll('.btn-user-tr');
    const btnDelItems = doc.querySelectorAll('.btn-user-del');
    const formControl = doc.querySelectorAll(".form-control");

    const valuesInput = [];

    const pass = [
        doc.querySelector("#password"),
        doc.querySelector("#password_confirmation")
    ];

    selectUserType.addEventListener("change",(e)=>{
        let value = e.target.value;
        if(value == "MORADOR" || value==""){

        componentMembro.forEach(item=>{
            if(!item.classList.contains('d-none'))
                 item.classList.add('d-none');
          });
        }else{
            componentMembro.forEach(item=>{
                if(item.classList.contains('d-none'))
                     item.classList.remove('d-none');
              });
        }
    });

    btnUserAdd.addEventListener("click", (e) => {
        modalUserTitle.innerHTML = "Criação";
        initNeedRouteForm(btnUserAdd);
        valueOfFormControl(btnUserAdd,1);
        selectDefaultFuncao(selectUserFuncao.getAttribute('default'));
    });

    btnUserUp.addEventListener("click", (e) => {
        modalUserTitle.innerHTML = "Actualização";
        initNeedRouteForm(btnUserUp);
        valueOfFormControl(btnUserUp,2);
        let userData = doc.querySelector("#user-data");
        let membroFuncao = doc.querySelector("#membro-funcao");
        let userDatas = [
            {name:"name", value: userData.dataset.name},
            {name:"email", value: userData.dataset.email},
            {name:"telefone", value: userData.dataset.telefone},
            {name:"data_nascimento", value: userData.dataset.data_nascimento}
        ];
        userDatas.forEach(obj =>{
            doc.querySelector(`[name='${obj.name}']`).setAttribute("value", obj.value);
        });
        if(membroFuncao){
            let funcao = membroFuncao.dataset.funcao;
            analitySelectFunc(funcao);
        }else{
            analitySelectFunc(null);
        }
    });

    btnUserDel.addEventListener('click', (e)=>{
        doc.querySelector('#user-name').innerHTML = "[sua conta, não teras como recuperar os teus dados.]";
        doc.querySelector('#form-del').action = item.getAttribute('url');
    })

    btnUpItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            passwordOpenOrClose(2);

            let row = item.parentElement.parentElement;
            let column = row.children;
            let genero = {name:"genero", value: column[2].innerHTML};
            let userDatas = [
                {name:"name", value: column[0].innerHTML},
                {name:"email", value: column[1].innerHTML},
                {name:"telefone", value: column[3].innerHTML},
                {name:"data_nascimento", value: column[4].innerHTML}
            ];

            let funcao = item.dataset.funcao;

            analitySelectFunc(funcao);

            modalUserTitle.innerHTML = "Actualização";

            formUser.action = item.getAttribute('url');
            doc.querySelector("[name='_method']").setAttribute('value',item.getAttribute('method'));
            userDatas.forEach(obj =>{
                doc.querySelector(`[name='${obj.name}']`).setAttribute("value", obj.value);
            });
            changeSelectGenero(genero);
        })
    });

    btnDelItems.forEach(item =>{
        item.addEventListener('click', (e)=>{
            let row = item.parentElement.parentElement;
            let column = row.children;
            doc.querySelector('#user-name').innerHTML = "["+column[0].innerHTML+"]";
            doc.querySelector('#form-del').action = item.getAttribute('url');
        })
    });

    function analitySelectFunc(funcao){
        let optionsUser = selectUserType.querySelectorAll('option');

        if(funcao){
            let funcoes = document.querySelector("#funcao");
            componentMembro.forEach(membro => {
                if(membro.classList.contains('d-none'))
                    membro.classList.remove('d-none')
            });
            let optionsFunc = funcoes.querySelectorAll('option');

            compareOptions(optionsUser,"MEMBRO");
            compareOptions(optionsFunc,funcao);
        }else{
            componentMembro.forEach(membro => {
                if(!membro.classList.contains('d-none'))
                    membro.classList.add('d-none')
            });
            compareOptions(optionsUser,"MORADOR");
        }
    }

    function compareOptions(options, compare){
        options.forEach(option => {
            if(option.value == compare){
                if(!option.hasAttribute('selected'))
                    option.setAttribute('selected','');
            }else{
                option.removeAttribute('selected');
            }
        });
    }

    function changeSelectGenero(genero){
        let select = doc.querySelector('[name="genero"]');
        let selectOptions = select.children;
        let options = [];
        for(let i = 0; i < selectOptions.length; i++)
            options.push({value: selectOptions[i].value, html: selectOptions[i].innerHTML});
        select.innerHTML = '';
        let html = "";
        for(let i = 0; i < options.length; i++){
            let status = options[i].html.trim().toLowerCase() == genero.value.trim().toLowerCase();
            let seleted = status ? "selected" : "";
            html += `<option value="${options[i].value}" ${seleted}>${options[i].html}</option>`;
        }
        select.innerHTML = html;
    }

    function valueOfFormControl(btn,status) {
        formUserAttribuite(btn);
        switch (status) {
            case 1:
                passwordOpenOrClose(status);
                 (valuesInput.length == 0)
                    ? formControl.forEach((input) => {
                        if (input.hasAttribute("name")) {
                            valuesInput.push({nome: input.getAttribute("name"),value: input.getAttribute("value")});
                            input.setAttribute("value", "");
                        }
                    })
                    : formControl.forEach((input) => {input.setAttribute("value", "");});
                break;
            case 2:
                passwordOpenOrClose(status);
                valuesInput.forEach((input) => {
                    doc.querySelector(`[name='${input.nome}']`).setAttribute("value", input.value);
                    if(input.nome == 'genero' && input.value != null)
                        changeSelectGenero({name: input.nome, value: input.value.trim()});
                });
                break;

        }
    }

    function passwordOpenOrClose(status){
        switch(status){
            case 1:
                pass.forEach(tag=>{tag.removeAttribute('disabled');});
                passwordInput.classList.remove('d-none');
            break;
            case 2:
                pass.forEach(tag=>{tag.setAttribute('disabled',true);});
                passwordInput.classList.add('d-none');
            break;
        }
    }

    function initNeedRouteForm(btn){
        let action = formUser.getAttribute('action');
        if(action == "#" || action=="null" || action == "")
            formUserAttribuite(btn);
    }

    function formUserAttribuite(btn){
        formUser.setAttribute('action',btn.getAttribute('url'));
        doc.querySelector("[name='_method']").setAttribute('value',btn.getAttribute('method'));
    }

})(window, document);
