import { validarInput } from "../common/validaciones.js";

document.addEventListener("DOMContentLoaded", () => {

  let  inputs = [];  
  
  let nombre = document.getElementById('name').value;
  let email = document.getElementById('email').value;
  let asunto = document.getElementById('subject').value;
  let  mensaje = document.getElementById('message').value;

  inputs.push(nombre , email , asunto , mensaje);
   
//    validarInput()
 
   
//   console.log(valores);

})