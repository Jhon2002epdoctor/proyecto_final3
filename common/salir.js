export async function Salir() {
    let salir = document.getElementById("salir");

  if (salir) {
    salir.addEventListener("click", async (event) => {
      event.preventDefault();
      localStorage.removeItem("id");

      fetch("/proyecto_final/Modelo/llamadas/salir.php?salir=true")
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });

      window.location.href = "/proyecto_final/Vista/login.php";
    });
  }
}
