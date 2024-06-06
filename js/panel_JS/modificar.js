import { BASE_URL } from "../config.js";

document.addEventListener("DOMContentLoaded", async () => {
  const url = window.location.href;
  const urlObj = new URL(url);
  const params = new URLSearchParams(urlObj.search);
  const id = params.get("id");
  const botonModificar = document.querySelector(".Modificartotalmente");
  let imagenesArray = [];
  await MostrarCasa(id);

  document.getElementById("imagenes").addEventListener("change", function (event) {
    imagenesArray = [];
    const files = event.target.files;  
    imagenesArray = Array.from(files);
  });

  botonModificar.addEventListener("click", async () => {
    await ModificarCasa(imagenesArray, id);
  });
});

async function MostrarCasa(id) {
  const descripcion = document.querySelector("textarea");
  const habitaciones = document.querySelector("#habitaciones");
  const precio = document.querySelector("#precio");
  const comunidad = document.querySelector("#comunidad");
  const ciudad = document.querySelector("#ciudad");
  const destacado = document.querySelector("#destacado");
  const imagenes = document.querySelector(".imagenes-modificar");
  const oculto = document.querySelector("#oculto");
  const tipo = document.getElementById("tipo");

  await fetch(`${BASE_URL}/Modelo/panel_control/MostraCasaModificada.php?id=${id}`)
    .then((response) => response.json())
    .then(async (data) => {
      if (data.length) {
        habitaciones.value = data[0].habitaciones;
        comunidad.value = data[0].comunidad_autonoma;
        ciudad.value = data[0].ciudad;
        precio.value = data[0].precio;
        descripcion.value = data[0].descripcion;
        destacado.checked = data[0].destacado === 1;
        oculto.checked = data[0].oculto === 1;
        tipo.value = data[0].titulo;

        data[0].imagenes.forEach((img) => {
          let checked = img.oculto == 0 ? "" : "checked";
          imagenes.innerHTML += `<div class="imagen-modificar">
                                    <img src="../../img/${img.imagen}" alt="imagen.">
                                    <label>Ocultar 
                                        <input type="checkbox" name="eliminar[]" ${checked} value="${img.id}"> 
                                    </label>
                                </div>`;
        });
      }
    })
    .catch((error) => console.error("Error:", error));
}

async function ModificarCasa(imagenesArray, id) {
  const formData = new FormData();
  formData.append("id", id);
  formData.append("descripcion", document.querySelector("textarea").value);
  formData.append("habitaciones", document.querySelector("#habitaciones").value);
  formData.append("precio", document.querySelector("#precio").value);
  formData.append("comunidad", document.querySelector("#comunidad").value);
  formData.append("ciudad", document.querySelector("#ciudad").value);
  formData.append("destacado", document.querySelector("#destacado").checked ? 1 : 0);
  formData.append("oculto", document.querySelector("#oculto").checked ? 1 : 0);
  formData.append("titulo", document.querySelector("#tipo").value);

  const checkboxes = document.querySelectorAll('input[type="checkbox"]');

  checkboxes.forEach(checkbox => {
    formData.append( checkbox.id, checkbox.checked);
  });

  imagenesArray.forEach((file, index) => {
    formData.append(`imagenes[]`, file);
  });

  console.log([...formData]); // Debug: Muestra los datos en FormData

  await fetch(`${BASE_URL}/Modelo/panel_control/Modificar.php`, {
    method: "POST",
    body: formData,
  })
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
      window.location.href = `${BASE_URL}/Vista/Panel_control/panel.php`;
    })
    .catch((error) => console.error("Error:", error));
}
