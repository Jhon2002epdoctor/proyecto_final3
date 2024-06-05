import { Paginacion } from "./PaginacionClass.js";

export  class PaginacionBuscador extends Paginacion {
  constructor(
    selectorPanel,
    selectorPaginacion,
    tamPagina = 15,
    metodoInserccion
  ) {
    super(selectorPanel, selectorPaginacion, tamPagina, metodoInserccion);
  }

  async IniciarEjecuccion(url, ConfiguracionFetch = {}) {
    try {
      const response = await fetch(url, ConfiguracionFetch);
      const data = await response.json();
      const penel_contenedor = document.querySelector(".no_encontrado"); 
      const panel = document.querySelector(".panel-contenedor");
      const panel_paginacion = document.querySelector("#paginacion");

      if (data.length === 0) {
         console.log(data);
          penel_contenedor.innerHTML = "<h1 class='encontrado' >No se han encontrado resultados</h1>";
          panel.innerHTML = "";
          panel_paginacion.innerHTML = "";
      }
      else{
        penel_contenedor.innerHTML = " ";
        this.datos = data;
        this.iniciarPaginacion();
      }

    } catch (error) {
      console.error("Error al cargar los datos:", error);
    }
  }
}
