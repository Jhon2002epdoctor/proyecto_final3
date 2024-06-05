import { BASE_URL } from "../js/config.js";

export async function Salir() {
    let salir = document.getElementById("salir");

  if (salir) {
    salir.addEventListener("click", async (event) => {
      event.preventDefault();
      localStorage.removeItem("id");

     await   fetch(`${BASE_URL}/Modelo/llamadas/salir.php?salir=true`)
        .then((response) => response.json())
        .then((data) => {
          console.log(data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });

      window.location.href = `${BASE_URL}/Vista/login.php`;
    });
  }
}
