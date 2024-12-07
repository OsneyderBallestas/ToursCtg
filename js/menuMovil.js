// JavaScript para la versión móvil

// Seleccionamos los elementos del DOM (Document Object Model) necesarios para la funcionalidad móvil
const btnMenuMovil = document.querySelector('#btn-menu-movil'); // Botón de menú hamburguesa en móvil
const menuMovil = document.querySelector('#menu-movil'); // Menú desplegable para móvil
const btnCloseMovil = document.querySelector('#btn-close-movil'); // Botón de cerrar en el menú móvil
const headerMovil = document.querySelector('.header-movil'); // Header móvil

// Creamos la capa de fondo (overlay) que aparece detrás del menú móvil cuando se abre
const overlay = document.createElement('div'); // Creamos un nuevo elemento div
overlay.classList.add('overlay'); // Añadimos la clase 'overlay' que ya tiene estilos en el CSS
document.body.appendChild(overlay); // Añadimos el overlay al cuerpo del documento

// Función para cerrar el menú móvil y ocultar el overlay
function closeMenu() {
    menuMovil.classList.remove('active'); // Removemos la clase 'active' del menú, lo que lo oculta
    overlay.style.display = 'none'; // Ocultamos la capa de fondo
}

// Abrir el menú móvil al hacer clic en el ícono de menú hamburguesa
btnMenuMovil.addEventListener('click', () => {
    menuMovil.classList.toggle('active'); // Alternamos la clase 'active' para mostrar/ocultar el menú
    overlay.style.display = menuMovil.classList.contains('active') ? 'block' : 'none'; // Mostramos/ocultamos el overlay según el estado del menú
});

// Cerrar el menú móvil al hacer clic en el botón de cerrar dentro del menú
btnCloseMovil.addEventListener('click', closeMenu);

// Cerrar el menú móvil al hacer clic en cualquier lugar del overlay
overlay.addEventListener('click', closeMenu);

// Sticky Header: Oculta el header móvil al hacer scroll hacia abajo y lo muestra al hacer scroll hacia arriba
let lastScrollY = window.scrollY; // Posición inicial del scroll

window.addEventListener('scroll', () => {
    if (window.scrollY > lastScrollY) {
        // Scroll hacia abajo: oculta el header
        headerMovil.style.transform = 'translateY(-100%)'; // Desplaza el header hacia arriba
    } else {
        // Scroll hacia arriba: muestra el header
        headerMovil.style.transform = 'translateY(0)'; // Restablece la posición original del header
    }
    lastScrollY = window.scrollY; // Actualiza la posición del scroll
});
