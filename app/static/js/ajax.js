const formulario = document.querySelectorAll(".Formulario");
/* Alerta para el envio de formulario. */
formulario.forEach(form => {
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
                    mode: 'cors',
                    cache: 'no-cache',
                    body: data,
                };

                fetch(action, config)
                .then(response => response.json())
                .then(response => { 
                    return alertas_ajax(response)
                });
            }
          });

    });
})
/* Creación de alertas escalables para una mejor UX/UI */
function alertas_ajax(alert){
    var alerta = JSON.parse(alert)
    if(alerta.tipo =='simple'){
        
        Swal.fire({
            title: alerta.title,
            text: alerta.text,
            icon: alerta.icono,
            confirmButtonText: 'Aceptar'
          });
    }else if(alerta.tipo =='recargar'){
        Swal.fire({
            title: alerta.title,
            text: alerta.text,
            icon: alerta.icono,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.isConfirmed) {
              location.reload();
            }
          });
    }else if((alerta.tipo =='limpiar')){
        Swal.fire({
            title: alerta.title,
            text: alerta.text,
            icon: alerta.icono,
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Aceptar"
        }).then((result) => {
            if (result.isConfirmed) {
                document.querySelector(".Formulario").reset();
            }
          });
    }else if((alerta.tipo =='redirect')){
        window.location.href=alerta.url;
    }
}