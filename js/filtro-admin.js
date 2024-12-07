document.addEventListener('DOMContentLoaded', () => {
    const categoryFilter = document.getElementById('filter-category');
    const searchBar = document.getElementById('search-bar');
    const tourList = document.getElementById('tour-list');

    function filterTours() {
        const categoryValue = categoryFilter.value.toLowerCase();
        const searchValue = searchBar.value.toLowerCase();

        // Iterar sobre las filas de la tabla
        Array.from(tourList.children).forEach(row => {
            // Obtener valores de las filas
            const category = row.dataset.category ? row.dataset.category.toLowerCase() : '';
            const name = row.dataset.name ? row.dataset.name.toLowerCase() : '';
            const price = row.dataset.price ? row.dataset.price.toLowerCase() : '';
            const state = row.dataset.state ? row.dataset.state.toLowerCase() : '';

            // Verificar coincidencias con los filtros
            const matchesCategory = categoryValue === 'all' || category === categoryValue;
            const matchesSearch = name.includes(searchValue) || price.includes(searchValue) || state.includes(searchValue);

            // Mostrar u ocultar la fila según los filtros
            row.style.display = matchesCategory && matchesSearch ? '' : 'none';
        });
    }

    // Eventos para activar el filtro
    categoryFilter.addEventListener('change', filterTours);
    searchBar.addEventListener('input', filterTours);
});
