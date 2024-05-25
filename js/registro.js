import { validarInput } from "../common/validaciones.js";

document.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".enviar").addEventListener("click", (e) => {
        e.preventDefault();
        let validacion = { estado: true };
        const inputs = document.querySelectorAll("input");
        let valores = {};
        
        for (let input of inputs) {
            validarInput(input, validacion);
            valores = { ...valores, [input.id]: input.value };
        }

        if (validacion.estado) {
            fetch('/proyecto_final/Modelo/registroInsertar.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(valores)
            })
            .then(response => response.json())
            .then(data => {
                  if(data.usuario){
                     let  usuario =   document.querySelector(".usuario");
                     usuario.style.color = "red"; 
                     usuario.style.fontSize = "15px";
                     usuario.innerHTML = "Usuario ya registrado";
                  }
                  else{
                        window.location.href = "/proyecto_final/Vista/login.php";
                  }

            })
            .catch(error => {
                console.error('Error:', error);
            });

            console.log(valores);
        } else {
            console.log("Hay errores en los inputs");
        }
    });
});
