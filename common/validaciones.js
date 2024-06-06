
export function validarInput(input, validacion) {
    const valor = input.value.trim();
    let valido = document.querySelector(`.validar${input.id}`);
    valido.innerHTML = "";

    switch (input.type) {
        case "text":
            if (valor === "") {
                valido.innerHTML = `Introduce un ${input.name}`;
                valido.style.color = "red";
                validacion.estado = false;
            }
            break;
        case "password":
            if (valor === "") {
                valido.innerHTML = "Introduce una contraseña";
                valido.style.color = "red";
                validacion.estado = false;
            }
            break;
        case "number":
            if (valor === "" || isNaN(valor) || valor <= 0) {
                valido.innerHTML = `Introduce un valor válido para ${input.name}`;
                valido.style.color = "red";
                validacion.estado = false;
            }
            break;
        case "email":
            if (valor === "" || !valor.includes("@")) {
                valido.innerHTML = "Introduce un correo válido";
                valido.style.color = "red";
                validacion.estado = false;
            }
            break;
        case "checkbox":
            // Para los checkboxes, puedes mostrar un mensaje si es necesario
            break;
        case "file":
            if (input.files.length === 0) {
                valido.innerHTML = "Sube al menos una imagen";
                valido.style.color = "red";
                validacion.estado = false;
            }
            break;
        default:
            break;
    }
}