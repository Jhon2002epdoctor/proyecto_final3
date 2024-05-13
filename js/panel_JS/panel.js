document.addEventListener("DOMContentLoaded", async () => {
  await llamartodasCasas();
  BotonInsertarCasa();
  OcultarCasa();
  let datos = [];
  const radios = document.querySelectorAll(
      'input[type="radio"][name="buscar"]'
  );
  const contenedorPanel = document.querySelector(".panel-contenedor");
  const buscadorInput = document.getElementById("buscador");
  let timeout = null;

  radios.forEach((checkbox) => {
      checkbox.addEventListener("change", function () {
          buscadorInput.value = "";
      });
  });

  buscadorInput.addEventListener("input", async function (event) {
      event.preventDefault();
      let datos = [];
      clearTimeout(timeout);
      let valorBuscador = eliminarEspacios(buscadorInput.value);
      timeout = setTimeout(async () => {
          if (!valorBuscador || valorBuscador === "") {
              llamartodasCasas();
          } else {
              radios.forEach(async (checkbox) => {
                  if (checkbox.checked) {
                      parametro = checkbox.value;
                      datos = await submitSearch(buscadorInput.value, parametro);
                      iniciarPaginacion(datos);
                      event.preventDefault();
                  }
              });
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
              return [];
          }
          break;
      case "titulo":
      case "comunidad":
          regex = /^[A-Za-z]+$/;
          validacion = regex.test(searchQuery);
          if (!validacion) {
              buscadorInput.value = "";
              buscadorInput.placeholder = `Has seleccionado una búsqueda por ${parametro}, acepta solo letras.`;
              return [];
          }
       break;
  }

  await fetch(
      `http://localhost/proyecto_final/Modelo/panel_control/panelbuscador.php?opcion=${parametro}&valor=${searchQuery}`
  )
      .then((response) => response.json())
      .then((data) => {
          datos = data;
      })
      .catch((error) => {
          console.error("Error:", error);
      });
  return datos;
}

async function llamartodasCasas() {
  const contenedorPanel = document.querySelector(".panel-contenedor");
  await fetch(
      "http://localhost/proyecto_final/Modelo/panel_control/panelbuscador.php?opcion=todas"
  )
      .then((response) => response.json())
      .then((data) => {
         console.log(data);
          iniciarPaginacion(data);
      })
      .catch((error) => {
          console.error("Error:", error);
      });
}
function iniciarPaginacion(datos) {
  var tamPagina = 4; // Define cuántos elementos quieres por página
  var totalPaginas = Math.ceil(datos.length / tamPagina);

  mostrarPagina(1, tamPagina, datos);
  agregarControlesPaginacion(1, totalPaginas , datos);
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
      });
  }
}
function mostrarPagina(pagina, tamPagina, datos) {
  var inicio = (pagina - 1) * tamPagina;
  var fin = inicio + tamPagina;
  var datosPaginados = datos.slice(inicio, fin);
  InsertarCasas(datosPaginados)
}

function agregarControlesPaginacion(pagina, totalPaginas, datos) {
  let datosAgregar  = []; 
  datosAgregar = datos;
  var contenedorPaginacion = document.getElementById('paginacion');
  contenedorPaginacion.innerHTML = '';  

  for (let i = 1; i <= totalPaginas; i++) {
      var boton = document.createElement('button');

      boton.textContent = i;
      boton.className = pagina === i ? 'active' : ''; 
      boton.addEventListener('click', () => {
        let datosAgregar  = []; 
        datosAgregar = datos;
          mostrarPagina(i, 4, datosAgregar); 
          agregarControlesPaginacion(i, totalPaginas, datosAgregar); 
      });
      contenedorPaginacion.appendChild(boton);
  }
}

function VerCasa() {
  const botonesVer = document.querySelectorAll(".ver");
  botonesVer.forEach((boton) => {
      boton.addEventListener("click", function () {
          const id = this.getAttribute("data-id");
          window.location.href = `http://localhost/proyecto_final/Vista/panel_control/MostrasCasa.php?id=${id}`;
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
          window.location.href = `http://localhost/proyecto_final/Vista/panel_control/ModificarCasa.php?id=${id}`;
      });
  });
}


function eliminarEspacios(cadena) {
  return cadena.replace(/\s+/g, '');
}


function BotonInsertarCasa(){
    const boton = document.querySelector(".boton-insertar");
    boton.addEventListener("click", function () {
        window.location.href = `/proyecto_final/Vista/panel_control/InsertarCasa.php`;
    });
}

