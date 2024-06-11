import { BASE_URL } from "../js/config.js";

export async function Salir() {
  let salir = document.querySelectorAll("#salir");

  if (salir) {
   await salir.forEach((element) => {
      element.addEventListener("click", async (event) => {
        event.preventDefault();
        localStorage.removeItem("id");

        try {
          const response = await fetch(`${BASE_URL}/Modelo/llamadas/salir.php?salir=true`);
          const data = await response.json();
          console.log(data);
        } catch (error) {
          console.error("Error:", error);
        }

        window.location.href = `${BASE_URL}/Vista/login.php`;
      });
    });
  }
}
