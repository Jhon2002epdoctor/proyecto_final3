export  function iniciarPaginacion(datos) {
  let tamPagina = 4; 
  let totalPaginas = Math.ceil(datos.length / tamPagina);

  mostrarPagina(1, tamPagina, datos);
  agregarControlesPaginacion(1, totalPaginas , datos);
}

export function mostrarPagina(pagina, tamPagina, datos) {
  var inicio = (pagina - 1) * tamPagina;
  var fin = inicio + tamPagina;
  var datosPaginados = datos.slice(inicio, fin);
  InsertarCasas(datosPaginados)
}

export function agregarControlesPaginacion(pagina, totalPaginas, datos) {
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
