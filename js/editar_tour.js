document.addEventListener('DOMContentLoaded', () => {
    /**
     * Función que asigna la funcionalidad de arrastrar y soltar a un área específica,
     * permitiendo también la selección manual de la imagen y su previsualización.
     * 
     * @param {string} dropAreaId - ID del contenedor donde se arrastrará y soltará la imagen
     * @param {string} inputId - ID del input file donde se asignará el archivo seleccionado
     * @param {string} previewImgId - ID del elemento <img> donde se previsualizará la imagen
     * @param {string} imageNameId - ID del elemento donde se mostrará el nombre de la imagen
     */
    const setupImageDrop = (dropAreaId, inputId, previewImgId, imageNameId) => {
        const dropArea = document.getElementById(dropAreaId);
        const inputFile = document.getElementById(inputId);
        const previewImg = document.getElementById(previewImgId);
        const imageNameEl = document.getElementById(imageNameId);

        // Previsualizar la imagen al ser seleccionada o arrastrada
        const previewImage = (file) => {
            if (!file) return;
            const reader = new FileReader();
            reader.onload = (e) => {
                previewImg.src = e.target.result;
                imageNameEl.textContent = file.name;
            };
            reader.readAsDataURL(file);
        };

        // Evitar el comportamiento por defecto en eventos de arrastrar/soltar
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, (e) => {
                e.preventDefault();
                e.stopPropagation();
            }, false);
        });

        // Estilos visuales al arrastrar el archivo sobre el área
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.add('dragover'), false);
        });

        // Quitar estilos visuales al salir del área o soltar el archivo
        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, () => dropArea.classList.remove('dragover'), false);
        });

        // Al soltar el archivo dentro del área
        dropArea.addEventListener('drop', (e) => {
            const files = e.dataTransfer.files;
            if (files && files.length === 1) {
                inputFile.files = files; // Asignar el archivo al input
                previewImage(files[0]);
            }
        });

        // Cuando se selecciona una imagen manualmente desde el explorador
        inputFile.addEventListener('change', () => {
            if (inputFile.files && inputFile.files[0]) {
                previewImage(inputFile.files[0]);
            }
        });
    };

    // Configuración para la imagen principal del Tour
    setupImageDrop('drop-area-imagen', 'input-imagen', 'preview-imagen', 'image-name-imagen');

    // Configuración para el banner del Tour
    setupImageDrop('drop-area-banner', 'input-banner', 'preview-banner', 'image-name-banner');
});

/**
 * Función para formatear el valor del input como moneda (en este caso, pesos colombianos sin decimales).
 * Se asume que el campo contiene solo dígitos o que se introducen números válidos.
 * 
 * @param {HTMLInputElement} inputElement - El campo de texto a formatear
 */
function formatearMoneda(inputElement) {
    // Remover todos los caracteres que no sean dígitos
    let valor = inputElement.value.replace(/\D/g, '');

    // Si no hay valor, dejamos el input vacío
    if (!valor) {
        inputElement.value = '';
        return;
    }

    // Convertir el valor a número
    const numero = parseInt(valor, 10);

    // Formatear el número con separadores de miles.
    // Usamos Intl.NumberFormat para mayor flexibilidad y correcto formateo
    const valorFormateado = new Intl.NumberFormat('es-CO', {
        minimumFractionDigits: 0,
        maximumFractionDigits: 0
    }).format(numero);

    inputElement.value = valorFormateado;
}
