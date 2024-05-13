document.addEventListener("DOMContentLoaded", async () => {
  const url = window.location.href;
  const urlObj = new URL(url);
  const params = new URLSearchParams(urlObj.search);
  const id = params.get("id");
  const botonModificar = document.querySelector(".Modificartotalmente");
  let imagenesArray = [];
  await MostrarCasa(id);
   
  document.getElementById("imagenes").addEventListener("change", async function(event) {
    imagenesArray = [];  
    const files = event.target.files;
    
  
    await Promise.all(Array.from(files).map(file => {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();

            reader.onload = function(e) {
                imagenesArray.push(reader.result);  
                resolve();  
            };

            reader.onerror = reject;  

            reader.readAsDataURL(file);  
        });
    }));
});


  botonModificar.addEventListener("click", async () => {
    ModificarCasa(imagenesArray);
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
        destacado.value = data[0].destacado === 1 ? true : false;

        data[0].imagenes.forEach((img) => {
          imagenes.innerHTML += `  <div class="imagen-modificar">
                                        <img src="data:image/jpeg;base64,${img.imagen}" alt="imagen.">
                                        <input type="checkbox" name="eliminar[]" value="${img.id}"> Eliminar
                                   </div>`;
        });
      }
    })
    .catch((error) => console.error("Error:", error));
}

async function EliminarImagen(id) {
  await fetch(
    `http://localhost/proyecto_final/Vista/panel_control/EliminarImagen.php?id=${id}`
  )
    .then((response) => response.json())
    .then((data) => {
      console.log(data);
    });
}

async function ModificarCasa(imagenesArray) {
  const url = window.location.href;
  const urlObj = new URL(url);
  const params = new URLSearchParams(urlObj.search);
  const id = params.get("id");
  const checkboxes = document.querySelectorAll(
    'input[name="eliminar[]"]:checked'
  );
  const descripcion = document.querySelector("textarea").value;
  const habitaciones = document.querySelector("#habitaciones").value;
  const titulo = document.querySelector("#titulo").value;
  const precio = document.querySelector("#precio").value;
  const comunidad = document.querySelector("#comunidad").value;
  const ciudad = document.querySelector("#ciudad").value;
  const destacado = document.querySelector("#destacado").checked;


 

  const idsEliminar = Array.from(checkboxes).map((checkbox) => checkbox.value);

  if (idsEliminar.length) {
    idsEliminar.forEach((id) => async () => {
      await EliminarImagen(id);
    });
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
