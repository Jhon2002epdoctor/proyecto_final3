import { Paginacion } from "../class/PaginacionClass.js";
import { Megusta, attachClickHandlers } from "../common/Inserccion.js";

export async function LlamadasDestacadas() {
  let paginacion = new Paginacion(".destacados", ".paginacion", 9, InsertarCasas);
  await paginacion.IniciarEjecuccion("http://localhost/proyecto_final/Modelo/llamadas/destacados.php", {});
}

async function InsertarCasas(datos) {
  const panel = document.querySelector(".destacados");
  panel.innerHTML = "";

  if (datos.length) {
    for (const item of datos) {
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
          let corazonUsuario = id ? 
            `<i style="font-size: 24px" class="fa corazon" data-id="${item.id}">&#xf004;</i>` :
            `<i style="font-size: 24px" class="fa " data-id="${item.id}" >&#xf004;</i>`;

          const cardHTML = `
            <div class="card">
              <div class="card-image-container">
                <img src="data:image/jpeg;base64,${imagenPrincipal}" alt="Imagen">
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
                <button class="boton3"><a href="/proyecto_final/Vista/Conctato.php">Contactar</a></button>
                <button data-id="${item.id}" class="pdf boton3">pdf</button>
              </div>
            </div>`;
          
          // Añadir la tarjeta al DOM
          panel.insertAdjacentHTML('beforeend', cardHTML);
        }
      }
    }
    // Después de agregar todas las tarjetas, configurar los controladores de eventos
     DescargarPDF();
  }

  attachClickHandlers();
  Megusta();
}

 function DescargarPDF() {
  let botones = document.querySelectorAll(".pdf");

  botones.forEach(boton => {
    boton.addEventListener("click", async () => {
      let id = boton.getAttribute("data-id");
      let respuesta = await fetch("/proyecto_final/Modelo/pdf.php", {
        method: "POST",
        headers: {
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ id }),
      });

      if (respuesta.ok) {
        let blob = await respuesta.blob();
        let link = document.createElement('a');
        link.href = window.URL.createObjectURL(blob);
        link.download = `Propiedad_${id}.pdf`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      } else {
        console.error('Error al generar el PDF');
      }
    });
  });
}

