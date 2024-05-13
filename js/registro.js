import { validarInput } from "../common/validaciones.js";

document.addEventListener("DOMContentLoaded", () => {
    document.querySelector(".enviar").addEventListener("click", (e) => {
        e.preventDefault();
        let validacion = {estado:true}
        const inputs = document.querySelectorAll("input");
        let  valores = {}
       for (let input of inputs) {
            validarInput(input , validacion);
            valores = {...valores, [input.id]: input.value};
        }
    
        if(validacion.estado){
            console.log(valores);   
        }
    });
    
})

