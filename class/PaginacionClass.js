// class Paginacion {

//     constructor(selectorPanel, selectorPaginacion, tamPagina = 15 , datos , MetodoInserccion) {
//       this.panel = document.querySelector(selectorPanel);
//       this.contenedorPaginacion = document.querySelector(selectorPaginacion);
//       this.tamPagina = tamPagina;
//       this.datos = datos;
//       this.MetodoInserccion = MetodoInserccion;
//     }

//     iniciarPaginacion(datos) {
//       this.datos = datos;
//       const totalPaginas = Math.ceil(this.datos.length / this.tamPagina);
//       this.mostrarPagina(1);
//       this.agregarControlesPaginacion(1, totalPaginas);
//     }
  
//     mostrarPagina(pagina , tamPagina , datos) {
//       let inicio = (pagina - 1) * tamPagina;
//       let fin = inicio + this.tamPagina;
//       let datosPaginados = datos.slice(inicio, fin);
//       this.MetodoInserccion(datosPaginados);
//     }
  
//     agregarControlesPaginacion(pagina, totalPaginas , datos) {
//       this.contenedorPaginacion.innerHTML = "";

//       for (let i = 1; i <= totalPaginas; i++) {
//         let boton = document.createElement("button");
  
//         boton.textContent = i;
//         boton.className = pagina === i ? "active" : "";
//         boton.addEventListener("click", () => {
//           this.mostrarPagina(i,15,datos);
//           this.agregarControlesPaginacion(i, totalPaginas,datos);
//         });
//       contenedorPaginacion.appendChild(boton);
//       }
//     }
  
//     // InsertarCasas(datos) {
//     //   this.panel.innerHTML = "";
//     //   console.log(datos);
  
//     //   if (datos.length) {
//     //     datos.forEach((item) => {
//     //       if (item.imagenes.length) {
//     //         let imagenPrincipal = "";
//     //         for (const imagen of item.imagenes) {
//     //           if (imagen.ocultoImagen == 0) {
//     //             imagenPrincipal = imagen.imagen;
//     //             break;
//     //           }
//     //         }
  
//     //         if (imagenPrincipal != "") {
//     //           const id = localStorage.getItem("id");
//     //           let corazonUsuario = ``;
  
//     //           if (id) {
//     //             corazonUsuario = `<i style="font-size: 24px" class="fa corazon" data-id="${item.id}">&#xf004;</i>`;
//     //           } else {
//     //             corazonUsuario = `<i style="font-size: 24px" class="fa " data-id="${item.id}" >&#xf004;</i>`;
//     //           }
  
//     //           this.panel.innerHTML += `
//     //             <div class="card">
//     //                  <div class="card-image-container">
//     //                  <img src="data:image/jpeg;base64,${imagenPrincipal}" alt="Imagen" ">
//     //                  </div>
//     //                  <div class="icons-1 flex padding-top-10">
//     //                      <p class="precio">${item.precio}$</p>
//     //                      <i style="font-size: 24px" class="fa ojo" data-id="${item.id}">&#xf06e;</i>
//     //                      ${corazonUsuario}
//     //                  </div>
//     //                  <div class="descripcion padding-top-10 padding-bottom-5">
//     //                       ${item.titulo}
//     //                  </div>
//     //                  <div class="icons-2 flex padding-top-10">
//     //                      <i style="font-size: 18px" class="fa">&#xf236;</i> ${item.habitaciones}
//     //                      <i style="font-size: 18px" class="fa">&#xf2cc;</i> 2
//     //                      <i style="font-size: 18px" class="fas">&#xf1ad;</i> 3
//     //                  </div>
//     //                  <div class="icons-3 flex padding-bottom-10 padding-top-10">
//     //                      <i style="font-size: 18px" class="fa">&#xf095;</i>
//     //                      <button class="boton3"><a href="/proyecto_final/Vista/Conctato.php">Contactar</a> </button>
//     //                  </div>
//     //              </div>        
//     //           `;
//     //         }
//     //       }
//     //     });
//     //   }
//     // }

//   }
  
//   // Uso de la clase
//   document.addEventListener("DOMContentLoaded", async () => {
//     const paginacion = new Paginacion(".destacados", ".paginacion");
//     await paginacion.llamartodasCasas("http://localhost/proyecto_final/Modelo/panel_control/panelbuscador.php?opcion=todas");
//   });
  

  class Paginacion {
    constructor(selectorPanel, selectorPaginacion, tamPagina = 15, metodoInserccion , ConfiguracionFetch) {
        this.panel = document.querySelector(selectorPanel);
        this.contenedorPaginacion = document.querySelector(selectorPaginacion);
        this.tamPagina = tamPagina;
        this.datos = [];
        this.metodoInserccion = metodoInserccion; // Asegúrate de que esto es una función
    }

    async IniciarEjecuccion(url) {
        try {
            const response = await fetch(url , ConfiguracionFetch);
            const data = await response.json();
            this.datos = data;
            this.iniciarPaginacion();
        } catch (error) {
            console.error("Error al cargar los datos:", error);
        }
    }

    iniciarPaginacion() {
        const totalPaginas = Math.ceil(this.datos.length / this.tamPagina);
        this.mostrarPagina(1);
        this.agregarControlesPaginacion(1, totalPaginas);
    }

    mostrarPagina(pagina) {
        const inicio = (pagina - 1) * this.tamPagina;
        const fin = inicio + this.tamPagina;
        const datosPaginados = this.datos.slice(inicio, fin);
        if (this.metodoInserccion && typeof this.metodoInserccion === "function") {
            this.metodoInserccion(datosPaginados);
        } else {
            console.error('La función de inserción no está definida correctamente.');
        }
    }

    agregarControlesPaginacion(pagina, totalPaginas) {
        this.contenedorPaginacion.innerHTML = "";
        for (let i = 1; i <= totalPaginas; i++) {
            const boton = document.createElement("button");
            boton.textContent = i;
            boton.className = pagina === i ? "active" : "";
            boton.addEventListener("click", () => {
                this.mostrarPagina(i);
                this.agregarControlesPaginacion(i, totalPaginas);
            });
            this.contenedorPaginacion.appendChild(boton);
        }
    }
}

// Función de inserción personalizada para mostrar datos
function insertarCasas(datos) {
    const panel = document.querySelector(".destacados");
    panel.innerHTML = ""; // Limpia el contenido anterior
    // Inserta el nuevo contenido
    datos.forEach(casa => {
        panel.innerHTML += `<div class="card">${casa.nombre}</div>`; // Ejemplo de inserción
    });
}

// Ejecutar la clase cuando el documento esté listo
document.addEventListener("DOMContentLoaded", () => {
    const paginacion = new Paginacion('.destacados', '.paginacion', 15, insertarCasas);
    paginacion.llamartodasCasas("http://localhost/proyecto_final/Modelo/panel_control/panelbuscador.php?opcion=todas");
});
