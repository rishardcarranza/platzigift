window.addEventListener("DOMContentLoaded", function () {
    console.log("Registro cargado");
    let $form = document.querySelector("#signup");
    let $msg = document.querySelector(".message");
    
    $form.addEventListener("submit", function(e) {
        e.preventDefault();

        let datos = new FormData($form);
        // Asi es como Wordpress los va a recibir
        let datosParse = new URLSearchParams(datos);

        fetch(`${fl.rest_url}/registro`,
            {
                method: "POST",
                body: datosParse
            }
        )
        .then(res => res.json())
        .then(json => {
            console.log(json);
            $msg.innerHTML = json?.msg;
        })
        .catch(error => console.log(error));

    });
});