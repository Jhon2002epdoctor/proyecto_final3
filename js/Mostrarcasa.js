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

  await fetch(
    `http://localhost/proyecto_final/Modelo/llamadas/MostrarCasa.php?id=${id}`
  )
    .then((response) => response.json())
    .then(async (data) => {
      console.log(data);

      data.forEach((item) => {
        informacion.innerHTML = `
             <h3>${validacionItem(item.titulo)}</h3>
             <p>Piso en Venta en ${validacionItem(item.ciudad)}, ${validacionItem(item.comunidad_autonoma)}</p>
             <p>${ validacionItem(item.precio)}$</p>
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
                <p>${validacionItem(item.precio)}$</p>
          </div>
          ${destacadoTexto}
          <div class="icon-casa">
              <p>Habitaciones</p>
              <i style="font-size:24px" class="fa">&#xf236;</i>
          </div>
          <div class="icon-casa">
              <p>Baños</p>
              <i class="fa fa-bath" style="font-size:24px"></i>
          </div>
          <div class="icon-casa">
              <p>m2</p>
              <i style='font-size:24px' class='far'>&#xf1ad;</i>
          </div>
        `
      
      
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
      scrollAmount = 600; 
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
