import { BASE_URL } from "../js/config.js";

export function DescargarPDF() {
  let botones = document.querySelectorAll(".pdf");

  botones.forEach((boton) => {
    boton.addEventListener("click", async () => {
      let id = boton.getAttribute("data-id");
      let respuesta = await fetch(`${BASE_URL}/Modelo/pdf.php`, {
        method: "POST",
        headers: {
          "Content-Type": "application/json",
        },
        body: JSON.stringify({ id }),
      });

      if (respuesta.ok) {
        let blob = await respuesta.blob();
        let link = document.createElement("a");
        link.href = window.URL.createObjectURL(blob);
        link.download = `Propiedad_${id}.pdf`;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
      } else {
        console.error("Error al generar el PDF");
      }
    });
  });
}
