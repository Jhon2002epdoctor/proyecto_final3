export function attachClickHandlers() {
    const ojos = document.querySelectorAll(".ojo");
    ojos.forEach((ojo) => {
      ojo.addEventListener("click", function () {
        const id = this.getAttribute("data-id");
        window.location.href = `http://localhost/proyecto_final/Vista/MostrarCasa.php?id=${id}`;
      });
    });
  }
  
export function Megusta() {
    const ojos = document.querySelectorAll(".corazon");
    ojos.forEach((ojo) => {
      ojo.addEventListener("click", function () {
        const id_casa = this.getAttribute("data-id");
        let id_usuario = localStorage.getItem("id");
        let datosEnviar = {
          id_casa: id_casa,
          id_usuario: id_usuario,
        };
  
        fetch("http://localhost/proyecto_final/Modelo/Megusta.php", {
          method: "POST",
          headers: {
            "Content-Type": "application/json",
          },
          body: JSON.stringify(datosEnviar),
        })
          .then((response) => response.json())
          .then((data) => {
            console.log(data);
          })
          .catch((error) => console.error("Error:", error));
      });
    });
  }