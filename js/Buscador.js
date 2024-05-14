import { Paginacion } from "../class/PaginacionClass.js";
import { Megusta, attachClickHandlers } from "../common/Inserccion.js";

document.addEventListener("DOMContentLoaded", async () => {
  let paginacion = new Paginacion(".panel-contenedor","#paginacion",3,InsertarCasas );

  await paginacion.IniciarEjecuccion(
    "http://localhost/proyecto_final/Modelo/Buscador2.php",
    {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify({
        metodoBusqueda: "todos",
        valorBuscador: "",
      }),
    }
  );

  const buscador = document.querySelector(".buscador");
  let timeout = null;
  buscador.addEventListener("input", async () => {
    clearTimeout(timeout);
    let valorBuscador = buscador.value.trim();
    let metodoBusqueda = document.getElementById("filtro-select").value;
    timeout = setTimeout(async () => {
      if (valorBuscador === "") {
        await paginacion.IniciarEjecuccion(
          "http://localhost/proyecto_final/Modelo/Buscador2.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify({
              metodoBusqueda: "todos",
              valorBuscador: "",
            }),
          }
        );
      } else {
        await submitSearch(valorBuscador, metodoBusqueda);
      }
    }, 1000);
  });
});

async function submitSearch(valorBuscador, metodoBusqueda) {
  let regex;
  let validacion;
  let datos = [];
  let paginacion = new Paginacion(
    ".panel-contenedor",
    "#paginacion",
    3,
    InsertarCasas
  );

  let datosEnviar = {
    metodoBusqueda: metodoBusqueda,
    valorBuscador: valorBuscador,
  };
  const buscador = document.querySelector(".buscador");
  switch (metodoBusqueda) {
    case "precio":
      regex = /^\d+$/;
      validacion = regex.test(valorBuscador);
      if (validacion) {

        await paginacion.IniciarEjecuccion(
          "http://localhost/proyecto_final/Modelo/Buscador2.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(datosEnviar),
          }
        );
      } else {
        buscador.value = "";
        buscador.placeholder = `Has seleccionado el precio solo hacepta números`;
      }
      break;
    case "titulo":
      regex = /^[A-Za-z]+$/;
      validacion = regex.test(valorBuscador);
      if (validacion) {
       
        await paginacion.IniciarEjecuccion(
          "http://localhost/proyecto_final/Modelo/Buscador2.php",
          {
            method: "POST",
            headers: {
              "Content-Type": "application/json",
            },
            body: JSON.stringify(datosEnviar),
          }
        );
      } else {
        buscador.value = "";
        buscador.placeholder = `Has seleccionado titulo solo acepta letras`;
      }
      break;
  }

  return datos;
}

function InsertarCasas(datos) {
   let panel = document.querySelector(".panel-contenedor");
   panel.innerHTML = "";
  if (datos.length) {
    datos.forEach((item) => {
      if (item.imagenes.length) {
        let imagenPrincipal = "";
        for (const imagen of item.imagenes) {
          if (imagen.ocultoImagen == 0) {
            imagenPrincipal = imagen.imagen;
            break;
          }
        }

        if (imagenPrincipal != "") {
          let id = localStorage.getItem("id");
          let corazonUsuario = ``;

          if (id) {
            corazonUsuario = `<i style="font-size: 24px" class="fa corazon" data-id="${item.id}">&#xf004;</i>`;
          } else {
            corazonUsuario = `<i style="font-size: 24px" class="fa " data-id="${item.id}" >&#xf004;</i>`;
          }
          panel.innerHTML += `
              <div class="card">
                   <div class="card-image-container">
                   <img src="data:image/jpeg;base64,${imagenPrincipal}" alt="Imagen" ">
                   </div>
                   <div class="icons-1 flex padding-top-10">
                       <p class="precio">${item.precio}$</p>
                       <i style="font-size: 24px" class="fa ojo" data-id="${item.id_casa}">&#xf06e;</i>
                       ${corazonUsuario}
                   </div>
                   <div class="descripcion padding-top-10 padding-bottom-5">
                        ${item.titulo}
                   </div>
                   <div class="icons-2 flex padding-top-10">
                       <i style="font-size: 18px" class="fa">&#xf236;</i> ${item.habitaciones}
                       <i style="font-size: 18px" class="fa">&#xf2cc;</i> 2
                       <i style="font-size: 18px" class="fas">&#xf1ad;</i> 3
                   </div>
                   <div class="icons-3 flex padding-bottom-10 padding-top-10">
                       <i style="font-size: 18px" class="fa">&#xf095;</i>
                       <button class="boton3"><a href="/proyecto_final/Vista/Conctato.php">Contactar</a> </button>
                   </div>
               </div>
                  `;
        }
      }
    });
  }
  attachClickHandlers();
  Megusta();
}
