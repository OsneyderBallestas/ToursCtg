<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tours Ctg</title>
    <link href='https://unpkg.com/boxicons@2.1.1/css/boxicons.min.css' rel='stylesheet'>
    <link rel="stylesheet" href="css/style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,100..900;1,100..900&family=Parkinsans:wght@300..800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
<body>
  <!-- HEADER DE ESCRITORIO -->
  <header class="header">
          <div class="contenedor">
              <nav class="navegacion">
                  <ul>
                      <li><a href="index.php">Inicio</a></li>
                      <li><a href="#tours">Tours</a></li>
                      <li><a href="#nosotros">Nosotros</a></li>
                      <li><a href="#contacto">Contacto</a></li>
                  </ul>
              </nav>
              <a href="index.php" class="logo">
                  <img src="img/logo-azul.svg" alt="Logotipo">
              </a>
              <div class="login">
                  <a href="inicio_sesion.php">
                      <i class="bi bi-person-circle"></i>
                      Iniciar sesión
                  </a>
              </div>
              <div class="contacto-header">
                  <a href="">Contacto</a>
              </div>
          </div>
      </header>
<!-- FIN HEADER DE ESCRITORIO -->

    <!-- Header para la versión móvil -->
    <div class="header-movil">
        <div class="logo-movil">
            <a href="index.php" class="logo-link">
                <img src="img/logo-azul.svg" alt="Logotipo Tours CTG">
            </a>
        </div>
        <div class="menu-icon-movil" id="btn-menu-movil">
            <i class='bx bx-menu'></i> <!-- Icono de menú hamburguesa -->
        </div>
    </div>
    <nav class="menu-desplegable-movil" id="menu-movil">
        <div class="close-icon-movil" id="btn-close-movil">
          <i class='bx bx-x'></i>
        </div>
        <ul>
            <li><a href="index.php">Inicio</a></li>
            <li><a href="#tours">Tours</a></li>
            <li><a href="#nosotros">Nosotros</a></li>
            <li><a href="#contacto">Contacto</a></li>
            <li><a href="inicio_sesion.php">iniciar sesión</a></li>
        </ul>
    </nav>

    <!-- SECCION 1 -->
    <main class="fondo">
        <div class="capa-oscura"></div>
        <div class="contenido">
            <h1>Explora Cartagena con Nosotros</h1>
            <p>Adéntrate en la belleza de Cartagena con experiencias diseñadas para <br> conectar, sorprender y enamorar.</p>
            <div class="explorar-tours">
              <a href="">Explorar Tours</a>
            </div>
        </div>
    </main>

  <!-- seccion 2 de descuentos -->
    <div class="seccion-descuentos">
      <h2>Momentos Únicos, Precios Especiales</h2>
      <p>Aprovecha oportunidades exclusivas para descubrir Cartagena. Descubre <br> experiencias únicas con ofertas que hacen cada momento aún más especial.</p>
    </div>


    <div class="contenedor-promo-tours">
    <div class="tarjeta1 promo-tour">
        <div class="info-promo">
            <p class="precio-promo">$500,000 COP/pers.</p>
            <h3>Ciudad Amurallada</h3>
            <p>Historia viva en calles coloniales y plazas encantadoras.</p>
            <a href="reservacion.php?tour_id=1" class="btn-reservar-promo">Reservar</a>
        </div>
    </div>
    <div class="tarjeta2 promo-tour">
        <div class="info-promo">
            <p class="precio-promo">$250,000 COP/pers.</p>
            <h3>Mercado de Bazurto</h3>
            <p>Explora el mercado más icónico de Cartagena.</p>
            <a href="reservacion.php?tour_id=10" class="btn-reservar-promo">Reservar</a>
        </div>
    </div>
    <div class="tarjeta3 promo-tour">
        <div class="info-promo">
            <p class="precio-promo">$300,000 COP/pers.</p>
            <h3>Playa Blanca</h3>
            <p>Disfruta de aguas cristalinas y arenas blancas.</p>
            <a href="reservacion.php?tour_id=19" class="btn-reservar-promo">Reservar</a>
        </div>
    </div>
    <div class="tarjeta4 promo-tour">
        <div class="info-promo">
            <p class="precio-promo">$200,000 COP/pers.</p>
            <h3>Volcán del Totumo</h3>
            <p>Relájate en un baño de lodo volcánico natural.</p>
            <a href="reservacion.php?tour_id=16" class="btn-reservar-promo">Reservar</a>
        </div>
    </div>
</div>


      <!-- SECCION 3 Todos los Tours -->

    <section class="intro-tours" id="tours">
        <h2>Descubre Todas Nuestras Experiencias</h2>
        <p>Desde recorridos históricos hasta escapadas privadas, tenemos el tour <br> perfecto para ti</p>
    </section>


  <!-- CATEGORIAS TABS -->
    <div class="categories">
  <button class="category-button active" data-category-id="all">
    <div class="icon-wrapper">
      <img src="img/icono-btn-tours.svg" alt="Todos" class="button-icon">
    </div>
    <span>Todos</span>
  </button>
  <button class="category-button" data-category-id="1">
    <div class="icon-wrapper">
      <img src="img/icono-btn-tours.svg" alt="Históricos" class="button-icon">
    </div>
    <span>Históricos</span>
  </button>
  <button class="category-button" data-category-id="2">
    <div class="icon-wrapper">
      <img src="img/icono-btn-tours.svg" alt="Gastronómicos" class="button-icon">
    </div>
    <span>Gastronómicos</span>
  </button>
  <button class="category-button" data-category-id="3">
    <div class="icon-wrapper">
      <img src="img/icono-btn-tours.svg" alt="Naturaleza" class="button-icon">
    </div>
    <span>Naturaleza</span>
  </button>
  <button class="category-button" data-category-id="4">
    <div class="icon-wrapper">
      <img src="img/icono-btn-tours.svg" alt="Playas" class="button-icon">
    </div>
    <span>Playas</span>
  </button>
  <button class="category-button" data-category-id="5">
    <div class="icon-wrapper">
      <img src="img/icono-btn-tours.svg" alt="Náuticos" class="button-icon">
    </div>
    <span>Náuticos</span>
  </button>
</div>

  <!-- TARJETAS DE TODOS LOS TOURS -->
<div class="tours-container">
  <?php
  include 'db.php';
  $tours = $conn->query("SELECT * FROM tours WHERE estado = 1");
  while ($tour = $tours->fetch_assoc()): ?>
    <div class="tour-card" data-category-id="<?= $tour['categoria_id']; ?>">
      <img src="<?= $tour['imagen']; ?>" alt="<?= $tour['titulo']; ?>" class="tour-image">
      <div class="tour-details">
        <h3><?= $tour['titulo']; ?></h3>
        <p><?= $tour['descripcion']; ?></p>
        <div class="tour-footer">
          <span class="tour-price">$<?= number_format($tour['precio'], 0, ',', '.'); ?> COP</span>
          <!-- Botón de reserva -->
          <a href="reservacion.php?tour_id=<?= $tour['id']; ?>" class="reserve-button">Reservar</a>
        </div>
      </div>
    </div>
  <?php endwhile; ?>
</div>


<!-- seccion 4 Nosotros -->
<section class="contenedor-nosotros" id="nosotros">
    <div class="titulo-nosotros">
        <h2>Explora la Magia con <br> Expertos Locales</h2>
    </div>
    <div class="descripcion-nosotros">
        <p>En Tours CTG, transformamos cada recorrido en una experiencia única e inolvidable. Somos más que un servicio de tours; somos apasionados por Cartagena y su riqueza histórica, cultural y natural.</p>
        <p>Nuestro compromiso es brindarte momentos exclusivos, cuidadosamente diseñados para que descubras la ciudad desde una perspectiva auténtica, confiable y personalizada.</p>
    </div>
</section>

    <!-- TARJETAS DE ESTADISTICAS NOSOTROS-->
<section class="contenedor-estadisticas">
    <div class="tarjeta-estadisticas">
      <div class="icono-estadisticas">
        <img src="img/clientes.svg" alt="Clientes Satisfechos">
      </div>
      <div class="contenido-estadisticas">
        <h3>+5,000</h3>
        <p>Clientes Satisfechos</p>
      </div>
    </div>
    <div class="tarjeta-estadisticas">
      <div class="icono-estadisticas">
        <img src="img/tours-completados.svg" alt="Tours Completados">
      </div>
      <div class="contenido-estadisticas">
        <h3>+1,000</h3>
        <p>Tours Completados</p>
      </div>
    </div>
    <div class="tarjeta-estadisticas">
      <div class="icono-estadisticas">
        <img src="img/reviews.svg" alt="Calificación en Reviews">
      </div>
      <div class="contenido-estadisticas">
        <h3>4.9/5</h3>
        <p>Calificación en Reviews</p>
      </div>
    </div>
  </section>

    <!-- SECCION DE VIDEO DE NOSOTROS -->
  <div class="video-container">
    <div class="overlay-video">
      <i class="bi bi-play-circle play-icon" onclick="playVideo()"></i>
    </div>
  </div>

  <!-- Modal para reproducir el video -->
<div id="video-modal" class="modal" onclick="handleModalClick(event)">
  <div class="modal-content">
    <span class="close" onclick="closeVideo()">&times;</span>
    <iframe
      id="youtube-video"
      src=""
      allow="autoplay; encrypted-media"
      allowfullscreen>
    </iframe>
  </div>
</div>
<!-- FOOTER -->
<footer>
  <div class="footer-container">
    <div class="footer-column">
      <img src="img/logo-azul.svg" alt="Tours CTG Logo" class="footer-logo">
      <p>Adéntrate en la belleza de Cartagena <br> con experiencias diseñadas para <br> conectar, sorprender y enamorar.</p>
    </div>
    <div class="footer-column">
      <h4>Enlaces Rápidos</h4>
      <ul>
        <li><a href="#inicio">Inicio</a></li>
        <li><a href="#tours">Tours</a></li>
        <li><a href="#nosotros">Nosotros</a></li>
        <li><a href="#contacto">Contacto</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>Nuestras Políticas</h4>
      <ul>
        <li><a href="#privacidad">Políticas de privacidad</a></li>
        <li><a href="#cookies">Políticas de cookies</a></li>
        <li><a href="#terminos">Términos y condiciones</a></li>
        <li><a href="#devolucion">Políticas de devolución</a></li>
      </ul>
    </div>
    <div class="footer-column">
      <h4>Newsletter</h4>
        <form action="#" method="post" class="newsletter-form">
    <div class="input-wrapper">
        <i class="bi bi-envelope"></i>
        <input type="email" id="email" name="email" placeholder="Correo electrónico" required>
    </div>
    <div class="policy-wrapper">
        <input type="checkbox" id="policy" name="policy" required>
        <label for="policy">Estoy de acuerdo con la <a href="#privacidad">política de privacidad</a>.</label>
    </div>
    <button type="submit" class="subscribe-btn">
        <i class="bi bi-send"></i> Suscribirse
    </button>
    </form>
    </div>
  </div>
  <div class="footer-bottom">
    <p>© Copyright 2024 Tours CTG | Desarrollado por Osneyder Ballestas.</p>
  </div>
</footer>
    <!-- JAVASCRIPT -->
    <script src="js/menuMovil.js"></script>
    <script src="js/stickyMenu.js"></script>
    <script src="js/script.js"></script>
    <script src="js/video.js"></script>
</body>
</html>