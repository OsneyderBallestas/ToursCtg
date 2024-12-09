document.addEventListener('DOMContentLoaded', () => {
  // Mostrar todos los tours al cargar la página
  document.querySelectorAll('.tour-card').forEach(card => {
      card.style.display = 'block';
  });

  // Hacer que el botón "Todos" esté activo al cargar
  const allButton = document.querySelector('.category-button[data-category-id="all"]');
  if (allButton) {
      allButton.classList.add('active');
  }

  // Añadir eventos a los botones de categorías
  document.querySelectorAll('.category-button').forEach(button => {
      button.addEventListener('click', () => {
          const categoryId = button.getAttribute('data-category-id');

          // Resaltar el botón activo
          document.querySelectorAll('.category-button').forEach(btn => btn.classList.remove('active'));
          button.classList.add('active');

          // Filtrar las tarjetas de tours según la categoría seleccionada
          document.querySelectorAll('.tour-card').forEach(card => {
              card.style.display = (categoryId === 'all' || card.getAttribute('data-category-id') === categoryId)
                  ? 'block' 
                  : 'none';
          });
      });
  });

  // Manejar clics en tarjetas de promoción de tours
  document.querySelectorAll('.promo-tour').forEach(tarjeta => {
      tarjeta.addEventListener('click', function(event) {
          // Verifica si el clic fue fuera del botón "Reservar"
          if (!event.target.classList.contains('btn-reservar-promo')) {
              const link = this.dataset.link;  // Obtiene el link del atributo data-link
              if (link) {
                  window.location.href = link;  // Redirige al link correspondiente
              }
          }
      });
  });
});
