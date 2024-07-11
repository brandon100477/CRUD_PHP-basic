const formulario = document.querySelectorAll(".Formulario");

formulario.forEach((form) => {
    form.addEventListener("submit",function(e){
        e.preventDefault();
        Swal.fire({
            title: "Esta a punto de enviar el formulario.",
            icon: "question",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Correcto!",
            cancelButtonText: "Cancelar"
          }).then((result) => {
            if (result.isConfirmed) {
                let data = new FormData(this);
                let method = this.getAttribute("method");
                let action = this.getAttribute("action");
                let encabezado = new Headers();
                let config={
                    method: method,
                    headers: encabezado,
                    body: data,
                    mode: 'cors',
                    cache: 'no-cache'
                };

                fetch(action, config).then((response) => response.json()).then((response) => { return alertas_ajax(respuesta) });
            }
          });

    });
})

function alertas_ajax(alerta){

}