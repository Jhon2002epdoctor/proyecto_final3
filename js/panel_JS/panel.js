
import { PaginacionBuscador } from "../../class/PaginacionClassBuscador.js";
import { BASE_URL } from "../config.js";


document.addEventListener("DOMContentLoaded", async () => {
  applyFilters(); 
    
  await  DatosEstadisticas().then(data => {
        MostrarEstadistica(data);
   })

  let buscadorInput = document.getElementById("buscar");
  buscadorInput.addEventListener("click" , () => {
     applyFilters();
  })

  BotonInsertarCasa();
  OcultarCasa();   
});


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
                  <p>metros cuadrados</p>
                  <p>${dato.metros}</p>
              </div>
              <div class="precio-panel">
                  <p>Precio</p>
                  <p>${dato.precio}€</p>
              </div>
              <div class="titulo-panel">
                  <p>Tipo</p>
                  <p>${dato.titulo}</p>
              </div>
              <div class="comunidad-panel">
                  <p>Habitaciones</p>
                  <p>${dato.habitaciones}</p>
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
          window.location.href = `${BASE_URL}/Vista/panel_control/MostrasCasa.php?id=${id}`;
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
                await fetch(`${BASE_URL}/Modelo/panel_control/EliminarCasa.php?id=${id}`)
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
          window.location.href = `${BASE_URL}/Vista/panel_control/ModificarCasa.php?id=${id}`;
      });
  });
}

async function applyFilters() {
    const form = document.getElementById("filterForm");
    let l = document.getElementById("metrosCheckbox").checked;
    console.log(l);
    const filters = {
      metros: document.getElementById("metrosCheckbox").checked
        ? document.getElementById("metros").value
        : null,
      price: document.getElementById("priceCheckbox").checked
        ? {
            min: document.getElementById("minPrice").value,
            max: document.getElementById("maxPrice").value,
          }
        : null,
      rooms: document.getElementById("roomsCheckbox").checked
        ? document.getElementById("rooms").value
        : null,
      houseType: document.getElementById("typeCheckbox").checked
        ? document.getElementById("houseType").value
        : null,
    };
  
    let paginacion = new PaginacionBuscador(
      ".panel-contenedor",
      "#paginacion",
      4,
      InsertarCasas
    );
  
    await paginacion.IniciarEjecuccion(`${BASE_URL}/Modelo/panel_control/Buscador.php`, {
      method: "POST",
      headers: {
        "Content-Type": "application/json",
      },
      body: JSON.stringify(filters),
    });
}


function BotonInsertarCasa(){
    const boton = document.querySelector(".boton-insertar");
    boton.addEventListener("click", function () {
        window.location.href = `${BASE_URL}/Vista/panel_control/InsertarCasa.php`;
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
