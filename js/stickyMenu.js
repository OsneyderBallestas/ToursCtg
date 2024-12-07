// Espera a que todo el contenido del DOM esté completamente cargado y listo para ser manipulado
document.addEventListener("DOMContentLoaded", () => {
  // Selecciona el elemento con la clase "header" (posiblemente el encabezado de la página)
  const header = document.querySelector(".header");

  // Agrega un evento que escucha el desplazamiento de la ventana
  window.addEventListener("scroll", () => {
      // Verifica si el desplazamiento vertical de la ventana supera los 50 píxeles
      if (window.scrollY > 50) {
          // Si es mayor a 50 píxeles, añade la clase "scrolled" al elemento "header"
          // Esto generalmente se usa para cambiar el estilo del encabezado, como hacerlo más pequeño o cambiar su color
          header.classList.add("scrolled");
      } else {
          // Si el desplazamiento es menor o igual a 50 píxeles, remueve la clase "scrolled" del encabezado
          // Esto restaura su estilo original
          header.classList.remove("scrolled");
      }
  });
});
