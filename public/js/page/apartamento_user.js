(function (win, doc) {
    "use strict";
    const form = doc.querySelector('#form-create');
    const btnCreate = doc.querySelectorAll('.btn-create');

    btnCreate.forEach(item=>{
        item.addEventListener('click',(e)=>{
            form.action = item.getAttribute('url');
        });
    });

})(window, document);
