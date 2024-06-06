import { Paginacion } from "../class/PaginacionClass.js";
import { PaginacionBuscador } from "../class/PaginacionClassBuscador.js";
import { Megusta, attachClickHandlers } from "../common/Inserccion.js";
import { DescargarPDF } from "../common/pdf.js";
import { BASE_URL } from "./config.js";

document.addEventListener("DOMContentLoaded", async () => {
 
  applyFilters();
  
  const buscador = document.getElementById("buscar")

  buscador.addEventListener("click", () => {
       applyFilters(); 
  }) 
 
});

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

  await paginacion.IniciarEjecuccion(`${BASE_URL}/Modelo/Buscador2.php`, {
    method: "POST",
    headers: {
      "Content-Type": "application/json",
    },
    body: JSON.stringify(filters),
  });

}


function InsertarCasas(datos) {
  let panel = document.querySelector(".panel-contenedor");
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
                <img src="../img/${imagenPrincipal}" alt="Imagen">
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
                <button class="boton3"><a href="${BASE_URL}/Vista/Conctato.php">Contactar</a></button>
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
