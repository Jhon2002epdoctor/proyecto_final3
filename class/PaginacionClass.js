
export  class Paginacion {
    constructor(selectorPanel, selectorPaginacion, tamPagina = 15, metodoInserccion) {
        this.panel = document.querySelector(selectorPanel);
        this.contenedorPaginacion = document.querySelector(selectorPaginacion);
        this.tamPagina = tamPagina;
        this.datos = [];
        this.metodoInserccion = metodoInserccion; 
    }

    async IniciarEjecuccion(url , ConfiguracionFetch = {}) {
        try {
            const response = await fetch(url , ConfiguracionFetch);
            const data = await response.json();
            
            if(!data.message){
                console.log(data);
                this.datos = data;
                this.iniciarPaginacion();
            }
       
        } catch (error) {
            console.error("Error al cargar los datos:", error);
        }
    }

    iniciarPaginacion() {
        let totalPaginas = Math.ceil(this.datos.length / this.tamPagina);
        this.mostrarPagina(1);
        this.agregarControlesPaginacion(1, totalPaginas);
    }

    mostrarPagina(pagina) {
        let inicio = (pagina - 1) * this.tamPagina;
        let fin = inicio + this.tamPagina;
        let datosPaginados = this.datos.slice(inicio, fin);
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



