// Seleccionar todas las tarjetas
document.querySelectorAll('.promo-tour').forEach(tarjeta => {
    const cursorCircle = tarjeta.querySelector('.cursor-circle');
    const reserveButton = tarjeta.querySelector('.btn-reservar-promo');
    let isOverButton = false;

    // Movimiento del mouse en la tarjeta
    tarjeta.addEventListener('mousemove', (e) => {
        if (isOverButton) return;
        const rect = tarjeta.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const y = e.clientY - rect.top;
        cursorCircle.style.left = `${x}px`;
        cursorCircle.style.top = `${y}px`;
        cursorCircle.style.opacity = 1;
    });

    // Ocultar círculo al salir
    tarjeta.addEventListener('mouseleave', () => {
        cursorCircle.style.opacity = 0;
    });

    // Detectar entrada/salida en el botón
    reserveButton.addEventListener('mouseenter', () => {
        isOverButton = true;
        cursorCircle.style.opacity = 0;
    });

    reserveButton.addEventListener('mouseleave', () => {
        isOverButton = false;
    });
});