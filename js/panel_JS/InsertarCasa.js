import { validarInput } from "../../common/validaciones.js";
import { BASE_URL } from "../config.js";

document.addEventListener("DOMContentLoaded", () => {
  const modificarBtn = document.getElementById("modificarBtn");
  const form = document.getElementById("propertyForm");
  let validacion = { estado: true };

  modificarBtn.addEventListener("click", async (event) => {
    event.preventDefault();
    const formdat = {};

    // Validar descripción
    const texarea = document.getElementById("descripcion");
    let seccion = document.querySelector(".validardescripcion");
    seccion.innerHTML = "";

    if (texarea.value.trim() === "") {
      seccion.innerHTML = "Introduce una descripción";
      seccion.style.color = "red";
      validacion.estado = false;
    } else {
      formdat["descripcion"] = texarea.value.trim();
    }

    // Validar otros inputs excepto checkboxes
    const inputs = document.querySelectorAll("input, textarea");
    for (let input of inputs) {
      if (input.type !== "submit" && input.type !== "checkbox") {
        validarInput(input, validacion);
        if (input.type === "file") {
          formdat[input.id] = [];
          for (let file of input.files) {
            formdat[input.id].push(file);
          }
        } else {
          formdat[input.id] = input.value.trim();
        }
      }
    }

    // Manejar checkboxes por separado
    const checkboxes = document.querySelectorAll("input[type='checkbox']");
    for (let checkbox of checkboxes) {
      formdat[checkbox.id] = checkbox.checked ? "1" : "0";
    }

    // Debugging: Verificar el contenido del objeto formdat
    console.log(formdat);

    if (validacion.estado) {
      try {
        const response = await fetch(`${BASE_URL}/Modelo/panel_control/InsertarCasa.php`, {
          method: "POST",
          headers: {
            'Content-Type': 'application/json'
          },
          body: JSON.stringify(formdat),
        });

        if (response.ok) {
          const text = await response.text();
          alert(text);
          console.log(text);
          // form.reset();
          // window.location.href = `${BASE_URL}/Vista/Panel_control/panel.php`;
        } else {
          console.error('Error en la respuesta del servidor');
        }
      } catch (error) {
        console.error('Error:', error);
      }
    }
  });
});
