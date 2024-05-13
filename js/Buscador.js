document.addEventListener("DOMContentLoaded", async () => {
  await llamartodasCasas();
  const buscador = document.getElementById("filtro-select");
  let timeout = null;
  console.log(buscador);
  buscador.addEventListener("input", async () => {
    clearTimeout(timeout);
    let valorBuscador = buscador.value.trim();
    let metodoBusqueda = document.getElementById("metodo-busqueda").value;
    timeout = setTimeout(async () => {
      if (valorBuscador === "") {
        await llamartodasCasas();
      } else {
        let datos = await submitSearch(valorBuscador, metodoBusqueda);
        iniciarPaginacion(datos);
      }
    }, 1000);
  });
});

async function submitSearch(valorBuscador, metodoBusqueda) {
  let regex;
  let validacion;
  let datos = [];

  datosEnviar = {
    metodoBusqueda: metodoBusqueda,
    valorBuscador: valorBuscador,
  };
  const buscador = document.getElementById("buscador");
  switch (metodoBusqueda) {
    case "precio":
      regex = /^\d+$/;
      validacion = regex.test(valorBuscador);
      if (validacion) {
        await fetch(`http://localhost/proyecto_final/Modelo/Buscador.php`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(datosEnviar),
        })
          .then((response) => response.json())
          .then((data) => {
            datos = data;
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      } else {
        buscador.value = "";
        buscador.placeholder = `Has seleccionado el precio solo hacepta números`;
      }
      break;
    case "titulo":
      regex = /^[A-Za-z]+$/;
      validacion = regex.test(valorBuscador);
      if (validacion) {
        await fetch(`http://localhost/proyecto_final/Modelo/Buscador.php`, {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(datosEnviar),
        })
          .then((response) => response.json())
          .then((data) => {
            datos = data;
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      } else {
        buscador.value = "";
        buscador.placeholder = `Has seleccionado titulo solo acepta letras`;
      }
      break;
  }

  return datos;
}

async function llamartodasCasas() {
  const contenedorPanel = document.querySelector(".panel-contenedor");
  await fetch(
    "http://localhost/proyecto_final/Modelo/panel_control/panelbuscador.php?opcion=todas"
  )
    .then((response) => response.json())
    .then((data) => {
      InsertarCasas(data);
    })
    .catch((error) => {
      console.error("Error:", error);
    });
}

function InsertarCasas(datos) {
  const panel = document.querySelector(".panel-contenedor");
  panel.innerHTML = "";
  console.log(datos);

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
                       <i style="font-size: 24px" class="fa ojo" data-id="${item.id}">&#xf06e;</i>
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
}

function iniciarPaginacion(datos) {
  let tamPagina = 15;
  let totalPaginas = Math.ceil(datos.length / tamPagina);

  mostrarPagina(1, tamPagina, datos);
  agregarControlesPaginacion(1, totalPaginas, datos);
}

function mostrarPagina(pagina, tamPagina, datos) {
  var inicio = (pagina - 1) * tamPagina;
  var fin = inicio + tamPagina;
  var datosPaginados = datos.slice(inicio, fin);
  InsertarCasas(datosPaginados);
}

function agregarControlesPaginacion(pagina, totalPaginas, datos) {
  let datosAgregar = [];
  datosAgregar = datos;
  var contenedorPaginacion = document.getElementById("paginacion");
  contenedorPaginacion.innerHTML = "";

  for (let i = 1; i <= totalPaginas; i++) {
    var boton = document.createElement("button");

    boton.textContent = i;
    boton.className = pagina === i ? "active" : "";
    boton.addEventListener("click", () => {
      let datosAgregar = [];
      datosAgregar = datos;
      mostrarPagina(i, 15, datosAgregar);
      agregarControlesPaginacion(i, totalPaginas, datosAgregar);
    });
    contenedorPaginacion.appendChild(boton);
  }
}
