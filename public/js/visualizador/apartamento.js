(function(win, doc){
    "use strict";

    const moradorResidente = doc.querySelectorAll('.morador-residente');

    moradorResidente.forEach(item =>{
        item.addEventListener('click',(e)=>{
            fetch(item.getAttribute('url'))
            .then((response)=>{ return response.json();})
            .then((data)=>{
                doc.querySelector("#apartamento_num_casa").value = data.numCasa;
                doc.querySelector("#apartamento_dimensao").value = data.dimensao;
                doc.querySelector("#apartamento_descricao").value = data.descricao;
                doc.querySelector("#apartamento_created").value = `${data.nameCreated} em ${data.createdAt}`;
                doc.querySelector("#apartamento_updated").value = `${data.nameUpdated} em ${data.updatedAt}`;
            });
        })
    });
})(window,document);
