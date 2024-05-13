document.addEventListener("DOMContentLoaded" ,  async () => {


  //  let id = localStorage .getItem("id");


  //  await fetch(`http://localhost/proyecto_final/Modelo/llamadas/Megustallamada.php?id=${id}`,{
  //   method: "GET",
  //   headers: {
  //      "Content-Type": "application/json",
  //   },
  // }).then( response => response.json()).then((data) => {
  //   console.log(data);
  //   InsertarCasas(data)
  // })
   
  
})




function InsertarCasas(datos){
    if(datos.length){
        const panel = document.querySelector(".panel-contenedor");
        panel.innerHTML = "";
        datos.forEach((item) => {
          panel.innerHTML += `
              <div class="card">
              <img src="data:image/jpeg;base64,${item.imagenes[0].imagen}" alt="Imagen" style="max-width: 100%; height: auto;">
                  <div class="icons-1 flex padding-top-10">
                    <p class="precio">$${item.precio}</p>
                    <i style="font-size: 24px" class="fa ojo" data-id="${item.id}">&#xf06e;</i>
                    <i style="font-size: 24px" class="fa corazon" data-id="${item.id}"  >&#xf004;</i>
                  </div>
                  <div class="descripcion padding-top-10 padding-bottom-5">
                    ${item.descripcion}
                  </div>
                  <div class="icons-2 flex padding-top-10">
                    <i style="font-size: 24px" class="fa">&#xf236;</i> 1
                    <i style="font-size: 24px" class="fa">&#xf2cc;</i> 2
                    <i style="font-size: 24px" class="fas">&#xf1ad;</i> 3
                  </div>
                  <div class="icons-3 flex padding-bottom-10 padding-top-10">
                    <i style="font-size: 24px" class="fa">&#xf095;</i>
                    <button class="boton3">Conectar</button>
                  </div>
                </div>`;
        });  
      
    } 
  }
  