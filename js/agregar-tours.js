// Zona de arrastrar y soltar para el archivo
const dropZone = document.getElementById('drop-zone');
const fileInput = document.querySelector('#drop-zone input');
const previewContainer = document.getElementById('preview-container');
const imagePreview = document.getElementById('image-preview');
const fileNameDisplay = document.getElementById('file-name');

// Evento para simular clic al hacer clic en la zona de drop
dropZone.addEventListener('click', () => fileInput.click());

// Eventos para manejar el drag and drop
dropZone.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropZone.classList.add('drag-over');
});

dropZone.addEventListener('dragleave', () => {
    dropZone.classList.remove('drag-over');
});

dropZone.addEventListener('drop', (e) => {
    e.preventDefault();
    dropZone.classList.remove('drag-over');

    const files = e.dataTransfer.files;
    if (files.length) {
        fileInput.files = files;
        handleFileUpload(files[0]); // Llamar a la función de manejo de archivo
    }
});

// Evento para manejar el cambio en el input file
fileInput.addEventListener('change', (e) => {
    const file = e.target.files[0];
    if (file) {
        handleFileUpload(file);
    }
});

// Función para manejar la subida y previsualización del archivo
function handleFileUpload(file) {
    const allowedExtensions = ['image/jpeg', 'image/png', 'image/gif']; // Extensiones permitidas
    if (!allowedExtensions.includes(file.type)) {
        alert('Formato no permitido. Solo se aceptan JPG, PNG o GIF.');
        fileInput.value = ''; // Limpiar el campo si el archivo no es válido
        return;
    }

    const maxSize = 2 * 1024 * 1024; // Tamaño máximo permitido (2 MB)
    if (file.size > maxSize) {
        alert('El archivo es demasiado grande. Tamaño máximo permitido: 2 MB.');
        fileInput.value = ''; // Limpiar el campo si el archivo es muy grande
        return;
    }

    const reader = new FileReader();
    reader.onload = (e) => {
        imagePreview.src = e.target.result; // Mostrar la imagen en el contenedor
        imagePreview.style.display = 'block'; // Asegurarse de que sea visible
        fileNameDisplay.textContent = file.name; // Mostrar el nombre del archivo
        fileNameDisplay.style.display = 'block'; // Asegurarse de que sea visible
    };
    reader.readAsDataURL(file); // Leer el archivo como DataURL
}

// Formatear el precio como pesos colombianos en tiempo real
const precioInput = document.getElementById('precio');

precioInput.addEventListener('input', (e) => {
    const rawValue = e.target.value.replace(/\D/g, ''); // Remover caracteres no numéricos
    const formattedValue = new Intl.NumberFormat('es-CO').format(rawValue); // Formatear como moneda local
    e.target.value = formattedValue; // Actualizar el valor en tiempo real
});

// Limpiar el formato del precio antes de enviar el formulario
const form = document.querySelector('form');
form.addEventListener('submit', (e) => {
    const rawValue = precioInput.value.replace(/\./g, '').replace(/,/g, ''); // Quitar puntos y comas
    precioInput.value = rawValue; // Actualizar el valor en el input antes de enviarlo
});
