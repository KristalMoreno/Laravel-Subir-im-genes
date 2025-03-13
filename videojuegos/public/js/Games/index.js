console.log("El archivo index.js se ha cargado correctamente");
document.addEventListener("DOMContentLoaded", function () {
    setTimeout(() => {
        let alerta = document.getElementById('alerta');
        if (alerta) {
            alerta.style.transition = "opacity 0.5s ease-out";
            alerta.style.opacity = "0";
            setTimeout(() => {
                alerta.style.visibility = "hidden";
            }, 500); // Espera que termine la animación antes de ocultarlo
        }
    }, 3000); // Desaparece después de 3 segundos
});
let btnEliminar = document.querySelector('#btnEliminar');
let lbl_nombre = document.querySelector('#lbl_nombre');

window.setInfo = (id, nombre) => {
    console.log("setInfo ejecutado con ID:", id, "Nombre:", nombre);
    btnEliminar.setAttribute('data-id', id);
    lbl_nombre.innerHTML = 'Eliminarás el videojuego <b>' + nombre + '</b>';
};

btnEliminar.addEventListener('click', () => {
    let id = btnEliminar.getAttribute('data-id');
    console.log("Botón de eliminar presionado, ID obtenido:", id);

    let form = document.querySelector('#frm_' + id);
    
    if (form) {
        console.log("Formulario encontrado, enviando...");
        form.submit();
    } else {
        console.error("Formulario no encontrado con id:", '#frm_' + id);
    }
});
