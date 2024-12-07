document.addEventListener('DOMContentLoaded', () => {
    // Manejar los botones de Mostrar/Ocultar
    const toggleButtons = document.querySelectorAll('.btn-toggle');

    toggleButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;
            const estado = button.dataset.estado;

            fetch('admin.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded',
                },
                body: `action=toggle_tour&id=${id}&estado=${estado}`
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    button.dataset.estado = data.estado;
                    button.textContent = data.estado == 1 ? 'Ocultar' : 'Mostrar';
                    const estadoColumna = button.closest('tr').querySelector('.estado');
                    estadoColumna.textContent = data.estado == 1 ? 'Visible' : 'Oculto';
                } else {
                    alert('Error al cambiar el estado del tour.');
                }
            })
            .catch(error => console.error('Error:', error));
        });
    });

    // Manejar los botones de Eliminar
    const deleteButtons = document.querySelectorAll('.btn-delete');

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            const id = button.dataset.id;

            if (confirm('¿Estás seguro de que deseas eliminar este tour?')) {
                fetch('admin.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: `action=delete_tour&id=${id}`
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Eliminar la fila del tour en la tabla
                        const row = button.closest('tr');
                        row.remove();
                        alert('Tour eliminado con éxito.');
                    } else {
                        alert('Error al eliminar el tour.');
                    }
                })
                .catch(error => console.error('Error:', error));
            }
        });
    });
});
