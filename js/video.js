function playVideo() {
    const modal = document.getElementById('video-modal');
    const video = document.getElementById('youtube-video');
    
    // URL del video de YouTube
  const videoUrl = 'https://www.youtube.com/embed/X6KJRSFjHYg?autoplay=1';

  
    // Mostrar el modal
    modal.style.display = 'flex';
    video.src = videoUrl;
  
    // Deshabilitar el scroll en el cuerpo
    document.body.style.overflow = 'hidden';
  }
  
  function closeVideo() {
    const modal = document.getElementById('video-modal');
    const video = document.getElementById('youtube-video');
    
    // Ocultar el modal
    modal.style.display = 'none';
    video.src = ''; // Detener el video
  
    // Habilitar el scroll en el cuerpo
    document.body.style.overflow = 'auto';
  }
  
  function handleModalClick(event) {
    const modalContent = document.querySelector('.modal-content');
    
    // Si el clic no está dentro del contenido del modal, cierra el modal
    if (!modalContent.contains(event.target)) {
      closeVideo();
    }
  }
  