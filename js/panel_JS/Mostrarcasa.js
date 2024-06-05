document.addEventListener("DOMContentLoaded", async () => {
  const url = window.location.href;
  const urlObj = new URL(url);
  const params = new URLSearchParams(urlObj.search);
  const id = params.get("id");

  await MostrarCasa(id);
  carruselActivo();
});

async function MostrarCasa(id) {
  let carrusel = document.querySelector(".carrusel-container");
  const informacion = document.querySelector(".informacion");
  const icons_casa = document.querySelector(".icons-casa");
  const descripcion = document.querySelector(".descripcion");
  await fetch(
    `/proyecto_final/Modelo/llamadas/MostrarCasa.php?id=${id}`
  )
    .then((response) => response.json())
    .then(async (data) => {
      console.log(data);

      data.forEach((item) => {
        informacion.innerHTML = `
             <p>${validacionItem(item.titulo)} en Venta en ${validacionItem(item.ciudad)}, ${validacionItem(item.comunidad_autonoma)}</p>
             <p>${ validacionItem(item.precio)}€</p>
        `;
      item.imagenes.forEach((img) => {
          carrusel.innerHTML += `  <div class="producto-carrusel">
                                        <img src="data:image/jpeg;base64,${img}" alt="imagen.">
                                  </div>`;
        });
       let destacadoTexto = item.destacado == 1 ? ` <div class="icon-casa">
                                                              <p>Destacado</p>
                                                              <i style="font-size:24px" class="fa">&#xf006;</i>
                                                    </div>` : "";

        icons_casa.innerHTML = `
           <div class="icon-casa">
                <p>Precio</p>
                <p>${validacionItem(item.precio)}€</p>
          </div>
          ${destacadoTexto}
          <div class="icon-casa">
              <p>Habitaciones</p>
              <div>
              <i style="font-size:24px" class="fa">&#xf236;</i> 
              ${validacionItem(item.habitaciones)}
              </div>
     
          </div>
          <div class="icon-casa">
              <p>Baños</p>
              <div>
              <i class="fa fa-bath" style="font-size:24px"></i>
              ${validacionItem(item.banos)}
              </div>
          </div>
          <div class="icon-casa">
              <p>m2</p>
              <div>
              ${validacionItem(item.metros)}m2
              </div>
          </div>
               <div class="icon-casa">
              <p>ciudad</p>
              <div>
              ${validacionItem(item.ciudad)}
              </div>
          </div>
          </div>
          <div class="icon-casa">
              <p>Comunidad</p>
              <div>
              ${validacionItem(item.comunidad_autonoma)}
              </div>
          </div>
        <div class="icon-casa">
              <p>Tipo</p>
              <div>
              ${validacionItem(item.titulo)}
              </div>
          </div>
          
        `

        descripcion.innerHTML = `${item.descprcion}`
      
      });
    })
    .catch((error) => console.error("Error:", error));
}
const carruselActivo = () => {
  const carrusel = document.querySelector(".carrusel-container");
  const btnback = document.querySelector("#btnback");
  const btnNext = document.querySelector("#btnNext");
  let scrollAmount = 300; 
  let lastScreenWidth = window.innerWidth;


  const updateScrollAmount = () => {
    const screenWidth = window.innerWidth;
    console.log(screenWidth);
    if (
      (screenWidth > 700 && lastScreenWidth <= 700) ||
      (screenWidth <= 700 && lastScreenWidth > 700)
    ) {
 
      carrusel.scrollLeft = 0;
      console.log("Carrusel reseteado a posición 0");
    }

  
    if (screenWidth > 700) {
      scrollAmount = 900; 
    } else {
      scrollAmount = 300;
    }
    lastScreenWidth = screenWidth;
  };

  window.addEventListener("resize", updateScrollAmount);
  updateScrollAmount();

  document.addEventListener("click", (e) => {
    if (e.target === btnNext || e.target.matches(".adelante *")) {
      carrusel.scrollLeft += scrollAmount;
      console.log(`cantidad: ${carrusel.scrollLeft}`);
      console.log(`Desplazamiento a la derecha: ${scrollAmount}`);
    }

    if (e.target === btnback || e.target.matches(".atras *")) {
      carrusel.scrollLeft -= scrollAmount;
    }
  });
};

function validacionItem(valor) {
  return valor ?? "";
}
