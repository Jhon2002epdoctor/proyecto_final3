import { validarInput } from "../../common/validaciones.js";
import { BASE_URL } from "../config.js";

document.addEventListener("DOMContentLoaded", () => {
  const modificarBtn = document.getElementById("modificarBtn");
  const form = document.getElementById("propertyForm");
  let validacion = { estado: true };

  modificarBtn.addEventListener("click", async (event) => {
    event.preventDefault();
    const formData = new FormData();

    // Validar descripción
    const texarea = document.getElementById("descripcion");
    let seccion = document.querySelector(".validardescripcion");
    seccion.innerHTML = "";

    if (texarea.value.trim() === "") {
      seccion.innerHTML = "Introduce una descripción";
      seccion.style.color = "red";
      validacion.estado = false;
    } else {
      formData.append("descripcion", texarea.value.trim());
    }

    // Validar otros inputs excepto checkboxes
    const inputs = document.querySelectorAll("input, textarea");
    for (let input of inputs) {
      if (input.type !== "submit" && input.type !== "checkbox") {
        validarInput(input, validacion);
        if (input.type === "file") {
          for (let file of input.files) {
            formData.append(input.id + "[]", file);
          }
        } else {
          formData.append(input.id, input.value.trim());
        }
      }
    }

    // Manejar checkboxes por separado
    const checkboxes = document.querySelectorAll("input[type='checkbox']");
    for (let checkbox of checkboxes) {
      formData.append(checkbox.id, checkbox.checked ? "1" : "0");
    }
    const select = document.getElementById("tipo");
    formData.append(select.id , select.value)
    // Debugging: Verificar el contenido del objeto FormData
    for (let [key, value] of formData.entries()) {
      console.log(key, value);
    }

    if (validacion.estado) {
      try {
        const response = await fetch(`${BASE_URL}/Modelo/panel_control/InsertarCasa.php`, {
          method: "POST",
          body: formData,
        });

        if (response.ok) {
          const text = await response.text();
          alert(text);
          console.log(text);
           window.location.href = `${BASE_URL}/Vista/Panel_control/panel.php`;
        } else {
          console.error('Error en la respuesta del servidor');
        }
      } catch (error) {
        console.error('Error:', error);
      }
    }
  });
});
