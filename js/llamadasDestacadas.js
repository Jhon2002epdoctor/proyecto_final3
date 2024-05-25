import { Megusta, attachClickHandlers } from "../common/Inserccion.js";
import { DescargarPDF } from "../common/pdf.js";

export async function LlamadasDestacadas() {
  const response = await fetch(
    "/proyecto_final/Modelo/llamadas/destacados.php"
  );
  const data = await response.json();

  if (!data.message) {
    console.log(data);
    InsertarCasas(data);
  }
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
          let corazonUsuario = id
            ? `<i style="font-size: 24px" class="fa corazon" data-id="${item.id}">&#xf004;</i>`
            : ``;

          let pdf = id
            ? `  <i class="fa fa-file-pdf-o pdf" data-id="${item.id} style="font-size:18px"></i>`
            : ``;

          const cardHTML = `
            <div class="card">
              <div class="card-image-container">
                <img src="data:image/jpeg;base64,${imagenPrincipal}" alt="Imagen">
              </div>
              <div class="icons-1 flex padding-top-10">
                <p class="precio">${item.precio}€</p>
                <i style="font-size: 24px" class="fa ojo" data-id="${item.id}">&#xf06e;</i>
                ${corazonUsuario}
                ${pdf}
              </div>
              <div class="descripcion padding-top-10 padding-bottom-5">
                ${item.titulo} en Venta en ${item.comunidad_autonoma} , ${item.ciudad}
              </div>
              <div class="icons-2 flex padding-top-10">
                <i style="font-size: 18px" class="fa">&#xf236;</i>${item.habitaciones}
                <i style="font-size: 18px" class="fa">&#xf2cc;</i>${item.banos}
                <i style="font-size: 18px" class="fas">&#xf1ad;</i>${item.metros} m2
              </div>
              <div class="icons-3 flex padding-bottom-10 padding-top-10">
                <i style="font-size: 18px" class="fa">&#xf095;</i>
                <button class="boton3"><a href="/proyecto_final/Vista/Conctato.php">Contactar</a></button>
              </div>
            </div>`;


          panel.insertAdjacentHTML("beforeend", cardHTML);
        }
      }
    }
    DescargarPDF();
  }

  attachClickHandlers();
  Megusta();
}

