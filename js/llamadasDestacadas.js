export async function LlamadasDestacadas() {
  const searchInput = document.querySelector(".destacados");




  // await fetch(
  //   "http://localhost/proyecto_final/Modelo/llamadas/destacados.php",
  //   {
  //     method: "GET",
  //     headers: {
  //       "Content-Type": "application/json",
  //     },
  //   }
  // )
  //   .then((response) => response.json())
  //   .then((data) => {
  //     let panel = document.querySelector(".destacados");
  //     let contenedorPaginacion = document.querySelector(".paginacion");
  //     paginacion = new  Paginacion(panel , contenedorPaginacion , 15 ,MetodoInserccion)

  //     iniciarPaginacion(data);
  //     attachClickHandlers();
  //   })
  //   .catch((error) => console.error("Error:", error));

   let paginacion =  new Paginacion(".destacados", ".paginacion", 15, InsertarCasas , {});

  await  paginacion.IniciarEjecuccion("http://localhost/proyecto_final/Modelo/llamadas/destacados.php")

}

export function attachClickHandlers() {
  const ojos = document.querySelectorAll(".ojo");
  ojos.forEach((ojo) => {
    ojo.addEventListener("click", function () {
      const id = this.getAttribute("data-id");
      window.location.href = `http://localhost/proyecto_final/Vista/MostrarCasa.php?id=${id}`;
    });
  });
}

export function Megusta() {
  const ojos = document.querySelectorAll(".corazon");
  ojos.forEach((ojo) => {
    ojo.addEventListener("click", function () {
      const id_casa = this.getAttribute("data-id");
      let id_usuario = localStorage.getItem("id");
      let datosEnviar = {
        id_casa: id_casa,
        id_usuario: id_usuario,
      };

      fetch("http://localhost/proyecto_final/Modelo/Megusta.php", {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify(datosEnviar),
      })
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
        })
        .catch((error) => console.error("Error:", error));
    });
  });
}




function InsertarCasas(datos) {
  const panel = document.querySelector(".destacados");
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

// function iniciarPaginacion(datos) {
//   let tamPagina = 15;
//   let totalPaginas = Math.ceil(datos.length / tamPagina);

//   mostrarPagina(1, tamPagina, datos);
//   agregarControlesPaginacion(1, totalPaginas, datos);
// }

// function mostrarPagina(pagina, tamPagina, datos) {
//   var inicio = (pagina - 1) * tamPagina;
//   var fin = inicio + tamPagina;
//   var datosPaginados = datos.slice(inicio, fin);
//   InsertarCasas(datosPaginados);
// }

// function agregarControlesPaginacion(pagina, totalPaginas, datos) {
//   let datosAgregar = [];
//   datosAgregar = datos;
//   var contenedorPaginacion = document.querySelector(".paginacion");
//   contenedorPaginacion.innerHTML = "";

//   for (let i = 1; i <= totalPaginas; i++) {
//     var boton = document.createElement("button");

//     boton.textContent = i;
//     boton.className = pagina === i ? "active" : "";
//     boton.addEventListener("click", () => {
//       let datosAgregar = [];
//       datosAgregar = datos;
//       mostrarPagina(i, 15, datosAgregar);
//       agregarControlesPaginacion(i, totalPaginas, datosAgregar);
//     });
//     contenedorPaginacion.appendChild(boton);
//   }
// }
