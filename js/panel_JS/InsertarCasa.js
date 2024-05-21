import { validarInput } from "../../common/validaciones.js";

document.addEventListener("DOMContentLoaded", () => {
  const modificarBtn = document.getElementById("modificarBtn");
  const form = document.getElementById("propertyForm");
  let validacion = { estado: true };
  let valores = {};
  
  modificarBtn.addEventListener("click", async (event) => {
    event.preventDefault();
    const inputs = document.querySelectorAll("input");
    const texarea = document.getElementById("descripcion");
    let seccion = document.querySelector(".validarDescripcion");
    seccion.innerHTML = "";  

    if (texarea.value.trim() === "") {
      seccion.innerHTML = "Introduce una descripción";
      seccion.style.color = "red";
      validacion.estado = false;
    } else {
      valores["descripcion"] = texarea.value.trim(); 
    }

    for (let input of inputs) {
      validarInput(input, validacion);
      if (input.type === "checkbox" || input.type === "file") {
        valores[input.id] = input.type === "file" ? input.files : input.checked;
      } else {
        valores[input.id] = input.value.trim();
      }
    }

    if (validacion.estado && valores.imagenes && valores.imagenes.length > 0) {
      try {
        const imagePromises = Array.from(valores.imagenes).map((file) =>
          convertFileToBase64(file)
        );
        const base64Images = await Promise.all(imagePromises);
        valores["imagenes"] = base64Images.map(image => image.split(",")[1]); 

        const response = await fetch("/proyecto_final/Modelo/panel_control/InsertarCasa.php", {
          method: "POST",
          headers: { "Content-Type": "application/json" },
          body: JSON.stringify(valores),
        });
        
        if (response.success) {
          form.reset();  
        } else {
  
        }
      } catch (error) {
        console.error("Error:", error);
     
      }
    } else {
 
    }
  });

  function convertFileToBase64(file) {
    return new Promise((resolve, reject) => {
      const reader = new FileReader();
      reader.readAsDataURL(file);
      reader.onload = () => resolve(reader.result);
      reader.onerror = (error) => reject(error);
    });
  }
  
});
