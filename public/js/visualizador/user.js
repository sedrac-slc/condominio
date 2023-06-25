(function(win, doc){
    "use strict";

    const apartamentoUser = doc.querySelectorAll('.apartamento-user');
    apartamentoUser.forEach(item =>{
        item.addEventListener('click',(e)=>{
            fetch(item.getAttribute('url'))
            .then((response)=>{return response.json();})
            .then((data)=>{
                const dataNascimento = data.dataNascimento != null ? data.dataNascimento : "morador";
                doc.querySelector("#user_name").value = data.name;
                doc.querySelector("#user_email").value = data.email;
                doc.querySelector("#user_funcao").value = data.funcao;
                doc.querySelector("#user_genero").value = data.genero;
                doc.querySelector("#user_telefone").value = data.telefone;
                doc.querySelector("#user_data_nascimento").value = dataNascimento;
                doc.querySelector("#user_created").value = `${data.nameCreated} em ${data.createdAt}`;
                doc.querySelector("#user_updated").value = `${data.nameUpdated} em ${data.updatedAt}`;
            });
        })
    });

})(window,document);
