import { LlamadasDestacadas, Megusta, attachClickHandlers } from "./llamadasDestacadas.js";

document.addEventListener('DOMContentLoaded',  async ()  =>{
 await LlamadasDestacadas();
    attachClickHandlers();
    Megusta(); 
    const corazones = document.querySelector(".corazones");
  if (corazones) {
      corazones.addEventListener("click", () => {
          window.location.href = `/proyecto_final/Vista/Megusta.php`;
      });
  } else {
      console.log('El elemento con la clase .corazones no fue encontrado en el DOM');
  }
});





