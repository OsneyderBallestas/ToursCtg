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
  
        // Filtrar las tarjetas de tours
        document.querySelectorAll('.tour-card').forEach(card => {
          if (categoryId === 'all') {
            card.style.display = 'block'; // Mostrar todas las tarjetas
          } else {
            card.style.display = card.getAttribute('data-category-id') === categoryId ? 'block' : 'none';
          }
        });
      });
    });
  });
  