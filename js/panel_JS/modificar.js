import { convertFileToBase64 } from "../../common/ConVertirEnBase64.js";

document.addEventListener("DOMContentLoaded", async () => {
  const url = window.location.href;
  const urlObj = new URL(url);
  const params = new URLSearchParams(urlObj.search);
  const id = params.get("id");
  const botonModificar = document.querySelector(".Modificartotalmente");
  let imagenesArray = [];
  await MostrarCasa(id);

  document.getElementById("imagenes").addEventListener("change", async function (event) {
     imagenesArray = [];
     const files = event.target.files;  
     const imagenesPromeso  = Array.from(files).map((file) => {
         return  convertFileToBase64(file); 
     })
     const base64Images = await Promise.all(imagenesPromeso);
      imagenesArray  = base64Images.map(image => image.split(",")[1]);  
    });

  botonModificar.addEventListener("click", async () => {
    ModificarCasa(imagenesArray , id);
  });
});

async function MostrarCasa(id) {
  const descripcion = document.querySelector("textarea");
  const habitaciones = document.querySelector("#habitaciones");
  const titulo = document.querySelector("#titulo");
  const precio = document.querySelector("#precio");
  const comunidad = document.querySelector("#comunidad");
  const ciudad = document.querySelector("#ciudad");
  const destacado = document.querySelector("#destacado");
  const imagenes = document.querySelector(".imagenes-modificar");
  const oculto = document.querySelector("#oculto");
  let ckecked = ``; 

  await fetch(
    `http://localhost/proyecto_final/Modelo/panel_control/MostraCasaModificada.php?id=${id}`
  )
    .then((response) => response.json())
    .then(async (data) => {
      console.log(data);
      if (data.length) {
        habitaciones.value = data[0].habitaciones;
        comunidad.value = data[0].comunidad_autonoma;
        ciudad.value = data[0].ciudad;
        titulo.value = data[0].titulo;
        precio.value = data[0].precio;
        descripcion.value = data[0].descripcion;
        destacado.checked = data[0].destacado === 1 ? true : false;
        oculto.checked = data[0].oculto === 1 ? true : false;
        
      
        data[0].imagenes.forEach((img) => {
          ckecked = img.oculto == 0 ? "" : "checked"
          imagenes.innerHTML += `  <div class="imagen-modificar">
                                        <img src="data:image/jpeg;base64,${img.imagen}" alt="imagen.">
                                        <label for="">Ocultar 
                                           <input type="checkbox" name="eliminar[]"  ${ckecked}  value="${img.id}"> 
                                        </label>
                                   </div>`;
        });
      }
    })
    .catch((error) => console.error("Error:", error));
}

async function ModificarCasa(imagenesArray , id) {

  const checkboxes = document.querySelectorAll(
    'input[name="eliminar[]"]'
  );  
  const descripcion = document.querySelector("textarea").value;
  const habitaciones = document.querySelector("#habitaciones").value;
  const titulo = document.querySelector("#titulo").value;
  const precio = document.querySelector("#precio").value;
  const comunidad = document.querySelector("#comunidad").value;
  const ciudad = document.querySelector("#ciudad").value;
  const destacado = document.querySelector("#destacado").checked;
  const oculto = document.querySelector("#oculto").checked;

  let valorCkeck = []
  let valor = {

  }
  // const idsEliminar = Array.from(checkboxes).map((checkbox) => ...valorCkeck );

  for (let checkbox of checkboxes) {
    valor = {checked:checkbox.checked  , dataId:checkbox.value}
    valorCkeck.push(valor);
  }


  const datosEnviar = {
    id: id,
    descripcion: descripcion,
    habitaciones: habitaciones,
    titulo: titulo,
    precio: precio,
    comunidad: comunidad,
    ciudad: ciudad,
    destacado: destacado,
    imagenes: imagenesArray,
    checkboxDataArray: valorCkeck,
    oculto: oculto
  };
  console.log(datosEnviar);
  await fetch(
    `http://localhost/proyecto_final/Modelo/panel_control/Modificar.php?`,
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(datosEnviar),
    }
  )
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
    });
}
