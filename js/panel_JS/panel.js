import { Paginacion } from "../../class/PaginacionClass.js";
import { eliminarEspacios } from "../../common/EliminarEspacios.js";

document.addEventListener("DOMContentLoaded", async () => {
   let paginacion = new Paginacion(".panel-contenedor","#paginacion",3,InsertarCasas );
   paginacion.IniciarEjecuccion("/proyecto_final/Modelo/panel_control/panelbuscador.php?opcion=todas" , {});
 
  await  DatosEstadisticas().then(data => {
      MostrarEstadistica(data);
   })

  let buscadorInput = document.getElementById("buscador");
  let timeout = null;
  BotonInsertarCasa();
  OcultarCasa();
  buscadorInput.addEventListener("input", async () => {
    clearTimeout(timeout);
    let valorBuscador =   buscadorInput.value.trim();
    let metodoBusqueda = document.getElementById("filtro").value;
    timeout = setTimeout(async () => {
      if (valorBuscador === "") {
        let paginacion = new Paginacion(".panel-contenedor","#paginacion",3,InsertarCasas );
        paginacion.IniciarEjecuccion("/proyecto_final/Modelo/panel_control/panelbuscador.php?opcion=todas" , {});      
      } else {
        await submitSearch(eliminarEspacios(valorBuscador),metodoBusqueda);
      }
    }, 1000);
  });
   


});

async function submitSearch(searchQuery, parametro) {
  let regex;
  let validacion;
  let datos = [];
  const buscadorInput = document.getElementById("buscador");
  switch (parametro) {
      case "id_busqueda":
      case "precio":
      case "imagenes":
          regex = /^\d+$/;
          validacion = regex.test(searchQuery);
          if (!validacion) {
              buscadorInput.value = "";
              buscadorInput.placeholder = `Has seleccionado una búsqueda por ${parametro}, acepta solo números.`;
              return "";
          }
          break;
      case "titulo":
      case "comunidad":
          regex = /^[A-Za-z]+$/;
          validacion = regex.test(searchQuery);
          if (!validacion) {
              buscadorInput.value = "";
              buscadorInput.placeholder = `Has seleccionado una búsqueda por ${parametro}, acepta solo letras.`;
              return "";
          }
       break;
  }

      let paginacion = new Paginacion(".panel-contenedor","#paginacion",3,InsertarCasas );
      paginacion.IniciarEjecuccion(`http://localhost/proyecto_final/Modelo/panel_control/panelbuscador.php?opcion=${parametro}&valor=${searchQuery}` , {});      

  return "";
}


function InsertarCasas(datos) {
  const contenedorPanel = document.querySelector(".panel-contenedor");
  contenedorPanel.innerHTML = "";

  if (datos.length) {
      datos.forEach((dato) => {
          
          const div = document.createElement("div");
          div.classList.add("casa-panel");
  
           if(dato.oculto == 1){
                div.classList.add("transparente");
           }

          div.innerHTML = `
              <div class="id-panel">
                  <p>ID</p>
                  <p>${dato.id}</p>
              </div>
              <div class="precio-panel">
                  <p>Precio</p>
                  <p>${dato.precio}$</p>
              </div>
              <div class="titulo-panel">
                  <p>Título</p>
                  <p>${dato.titulo}</p>
              </div>
              <div class="comunidad-panel">
                  <p>Comunidad Autónoma</p>
                  <p>Alicante</p>
              </div>
              <div class="img-panel">
                  <p>Imágenes</p>
                  <p>${dato.imagenes}</p>
              </div>
              <div class="botones">
                  <p>Botones</p>
                  <div class="boton">
                      <button class="modificar" data-id="${dato.id}">Modificar</button>
                      <button class="eliminar" data-id="${dato.id}">Ocultar</button>
                      <button class="ver" id="toggleButton" data-id="${dato.id}">Ver</button>
                  </div>
              </div>`;

          contenedorPanel.appendChild(div);
          VerCasa();
          ModificarCasa();
          OcultarCasa();
          BotonInsertarCasa();
      });
  }
}
function VerCasa() {
  const botonesVer = document.querySelectorAll(".ver");
  botonesVer.forEach((boton) => {
      boton.addEventListener("click", function () {
          const id = this.getAttribute("data-id");
          window.location.href = `/proyecto_final/Vista/panel_control/MostrasCasa.php?id=${id}`;
      });
  });
}
async function OcultarCasa() {
    document.querySelectorAll(".eliminar").forEach(boton => {
        // Asegurarse de que el evento solo se agregue una vez
        if (!boton.hasAttribute('data-listener')) {
            boton.setAttribute('data-listener', 'true');
            boton.addEventListener("click", async function (event) {
                event.stopPropagation(); // Detiene la propagación del evento
                const id = this.getAttribute("data-id");
                await fetch(`/proyecto_final/Modelo/panel_control/EliminarCasa.php?id=${id}`)
                    .then(response => response.json())
                    .then(data => {
                        const casaPanel = boton.closest('.casa-panel');
                        if (casaPanel && data.success) { // Asegúrate de que la respuesta sea exitosa antes de cambiar el estilo
                            casaPanel.classList.toggle('transparente');
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                    });
            });
        }
    });
}
function ModificarCasa() {
  const botonesModificar = document.querySelectorAll(".modificar");
  botonesModificar.forEach((boton) => {
      boton.addEventListener("click", function () {
          const id = this.getAttribute("data-id");
          window.location.href = `/proyecto_final/Vista/panel_control/ModificarCasa.php?id=${id}`;
      });
  });
}
function BotonInsertarCasa(){
    const boton = document.querySelector(".boton-insertar");
    boton.addEventListener("click", function () {
        window.location.href = `/proyecto_final/Vista/panel_control/InsertarCasa.php`;
    });
}



async function DatosEstadisticas(){
 const ctx = document.getElementById('myChart');
    let dataResponsive = {}; 
   await  fetch("/Proyecto_final/Modelo/Estadisticas.php")
     .then((response) => response.json())
     .then((data) => {
        dataResponsive = data; 
     })
  
      return dataResponsive ; 

}


function MostrarEstadistica(data){

    const ctx = document.getElementById('myChart').getContext('2d');
    const myChart = new Chart(ctx, {
        type: 'bar',
        data: {
            labels: ['Casas', 'Fotos', 'Me gusta', 'Usuarios'],
            datasets: [{
                label: '# of Items',
                data: [data.total_casas, data.total_fotos, data.total_megusta, data.total_usuarios],
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgba(255, 206, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)'
                ],
                borderColor: [
                    'rgba(255, 99, 132, 1)',
                    'rgba(54, 162, 235, 1)',
                    'rgba(255, 206, 86, 1)',
                    'rgba(75, 192, 192, 1)'
                ],
                borderWidth: 1
            }]
        },
        options: {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
}
