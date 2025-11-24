<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Servicios - TAXI EXPRESS PAMPLONA S.A.S</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/css/servicios.css', 'resources/js/app.js']); ?>
</head>

<body class="landing-body">
    <!-- Header/Navbar -->
    <header class="header-landing">
        <div class="container-landing">
            <nav class="navbar-landing">
                <div class="logo-landing">
                    <img src="<?php echo e(asset('imagenes/logo.png')); ?>" alt="TAXI EXPRESS PAMPLONA">
                </div>
                <ul class="nav-menu-landing" id="navMenu">
                    <li><a href="/" class="nav-link-landing">INICIO</a></li>
                    <li><a href="<?php echo e(route('nosotros')); ?>" class="nav-link-landing">NOSOTROS</a></li>
                    <li><a href="<?php echo e(route('servicios')); ?>" class="nav-link-landing">NUESTROS SERVICIOS</a></li>
                    <li><a href="<?php echo e(route('corporativo')); ?>" class="nav-link-landing">CORPORATIVO</a></li>
                    <li class="dropdown-landing">
                        <a href="#" class="nav-link-landing dropdown-toggle" id="plataformaDropdown">
                            PLATAFORMA
                            <svg class="dropdown-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none">
                                <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu-landing" id="dropdownMenu">
                        <?php if(auth()->guard()->check()): ?>
                            <li>
                                <a href="<?php echo e(auth()->user()->esAdministrador() ? route('admin.dashboard') : 
                                    (auth()->user()->esOperadora() ? route('operadora.dashboard') : 
                                    (auth()->user()->esConductor() ? route('conductor.dashboard') : 
                                    route('dashboard.user')))); ?>" class="dropdown-item-landing">Dashboard</a>
                            </li>
                        <?php else: ?>
                            <li>
                                <a href="<?php echo e(route('login')); ?>" class="dropdown-item-landing">Iniciar Sesión</a>
                            </li>
                        <?php endif; ?>
                        </ul>
                    </li>
                </ul>
                <div class="hamburger-landing" id="hamburger">
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </nav>
        </div>
    </header>

    <!-- Main Content -->
    <main class="main-landing">
        <!-- Hero Section -->
        <section class="servicios-hero">
            <div class="servicios-content-wrapper">
                <h1 class="servicios-title">NUESTROS SERVICIOS</h1>
            </div>
        </section>

        <!-- Servicios Content -->
        <section class="servicios-content">
            
            <!-- Transporte de Pasajeros -->
            <div class="servicio-card">
                <h2 class="servicio-title">TRANSPORTE DE PASAJEROS</h2>
                <div class="servicio-image-container">
                    <img src="<?php echo e(asset('imagenes/TAXI3.jpg')); ?>" alt="Transporte de Pasajeros">
                </div>
                <div class="servicio-text">
                    <p>
                        En Taxi Express, ofrecemos un servicio especializado de transporte de pasajeros orientado
                        a la comodidad, puntualidad y seguridad. Nuestra flota moderna y en óptimas condiciones,
                        junto con conductores capacitados y con amplia experiencia, garantiza traslados eficientes
                        y confiables dentro y fuera de la ciudad. Nos caracterizamos por brindar atención amable,
                        cumplimiento en los horarios y vehículos equipados para asegurar el bienestar de cada
                        pasajero.
                    </p>
                    <p class="servicio-highlight">Tu destino es nuestra prioridad.</p>
                </div>
            </div>

            <!-- Radiotaxi -->
            <div class="servicio-card">
                <h2 class="servicio-title">RADIOTAXI</h2>
                <div class="servicio-image-container">
                    <img src="<?php echo e(asset('imagenes/RADIO.jpg')); ?>" alt="Radiotaxi">
                </div>
                <div class="servicio-text">
                    <p>
                        Taxi Express es una empresa líder en servicios de radiotaxi, ofreciendo atención inmediata y
                        desplazamientos rápidos con solo una llamada o solicitud digital. Contamos con una red amplia de
                        vehículos disponibles las 24 horas, listos para atender tus necesidades de movilidad con seguridad,
                        rapidez y eficiencia.
                    </p>
                    <p>
                        Cada unidad está equipada con sistemas de comunicación modernos que garantizan un servicio ágil
                        y coordinado, pensado para tu comodidad y tranquilidad.
                    </p>
                </div>
            </div>

            <!-- Mantenimiento -->
            <div class="servicio-card">
                <h2 class="servicio-title">MANTENIMIENTO</h2>
                <div class="servicio-image-container">
                    <img src="<?php echo e(asset('imagenes/MANTENIMIENTO.jpg')); ?>" alt="Mantenimiento">
                </div>
                <div class="servicio-text">
                    <p>
                        En Taxi Express, entendemos que el mantenimiento regular es clave para prolongar la vida útil de tu vehículo
                        y garantizar su máximo rendimiento. Por eso ofrecemos servicios de mantenimiento preventivo y correctivo,
                        diseñados para evitar fallas, optimizar el consumo y mantener la seguridad de cada viaje.
                    </p>
                    <p>
                        Nuestro objetivo es ofrecerte un servicio rápido, confiable y transparente, con técnicos calificados y
                        repuestos de la mejor calidad.
                    </p>
                    <p class="servicio-highlight">En Taxi Express, cuidamos tu vehículo como si fuera nuestro.</p>
                </div>
            </div>

            <!-- Venta de Autopartes -->
            <div class="servicio-card">
                <h2 class="servicio-title">VENTA DE AUTOPARTES</h2>
                <div class="servicio-image-container">
                    <img src="<?php echo e(asset('imagenes/AUTOPARTES.jpg')); ?>" alt="Venta de Autopartes">
                </div>
                <div class="servicio-text">
                    <p>
                        En Taxi Express también encuentras una amplia gama de repuestos y autopartes originales y garantizadas,
                        con atención personalizada y asesoría técnica.
                    </p>
                    <p>
                        Proveemos soluciones confiables para todas las marcas de vehículos, ofreciendo productos duraderos,
                        precios competitivos y disponibilidad inmediata.
                    </p>
                    <p class="servicio-highlight">
                        Somos tu aliado integral para mantener tu vehículo en óptimo estado, con el respaldo y la confianza
                        que solo Taxi Express puede ofrecer.
                    </p>
                </div>
            </div>

            <!-- Por qué elegirnos -->
            
                
                <div class="porque-content">
                    <h2 class="porque-title">¿POR QUÉ ELEGIRNOS?</h2>
                    <ul class="porque-list">
                        <li><span class="highlight-red">• Experiencia y confianza:</span> años de servicio respaldan nuestro compromiso con la seguridad y la calidad.</li>
                        <li><span class="highlight-red">• Flota moderna y segura:</span> vehículos cómodos, limpios y en perfecto estado para tu tranquilidad.</li>
                        <li><span class="highlight-red">• Atención personalizada:</span> nuestro equipo humano está enfocado en ofrecerte soluciones rápidas y efectivas.</li>
                        <li><span class="highlight-red">• Servicios integrales:</span> transporte, mantenimiento y autopartes en un solo lugar.</li>
                        <li><span class="highlight-red">• Compromiso con la región:</span> impulsamos el desarrollo económico y social, priorizando el bienestar, el talento y la innovación.</li>
                    </ul>
                    <p class="porque-footer">
                        En Taxi Express, trabajamos para que cada cliente experimente un servicio eficiente, ágil y de calidad, con la
                        confianza de estar en las mejores manos.
                    </p>
                </div>
            

        </section>
    </main>

    <!-- Footer -->
    <footer class="footer-landing">
        <div class="footer-content-landing">
            <div class="footer-logo-container">
                <img src="<?php echo e(asset('imagenes/st.jpeg')); ?>" alt="syt" class="footer-logo">
            </div>
            
            <div class="footer-info">
                <h3 class="footer-title">CONTACTO</h3>
                <div class="contact-info">
                    <div class="contact-item">
                        <span class="contact-icon">📍</span>
                        <span class="contact-text">Calle 2 #6-72, Barrio el Humilladero, Pamplona Norte de Santander</span>
                    </div>
                    <div class="contact-item">
                        <span class="contact-icon">📞</span>
                        <span class="contact-text">314 238 1850 - 314 238 1851 - 314 238 1852 - 314 238 5832</span>
                    </div>
                    <div class="contact-text">
                        <span class="contact-text">copyright 2025  Sitio hecho por Brayan Capacho-Nathalia Vega</span>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <script>
        // Header scroll effect
        const header = document.querySelector('.header-landing');
        
        window.addEventListener('scroll', () => {
            if (window.scrollY > 50) {
                header.classList.add('scrolled');
            } else {
                header.classList.remove('scrolled');
            }
        });

        // Hamburger menu
        const hamburger = document.getElementById('hamburger');
        const navMenu = document.getElementById('navMenu');
        
        if (hamburger && navMenu) {
            hamburger.addEventListener('click', () => {
                hamburger.classList.toggle('active');
                navMenu.classList.toggle('active');
            });
        }

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    const headerOffset = 80;
                    const elementPosition = target.getBoundingClientRect().top;
                    const offsetPosition = elementPosition + window.pageYOffset - headerOffset;

                    window.scrollTo({
                        top: offsetPosition,
                        behavior: 'smooth'
                    });
                    
                    if (navMenu) {
                        navMenu.classList.remove('active');
                    }
                    if (hamburger) {
                        hamburger.classList.remove('active');
                    }
                }
            });
        });
    </script>
</body>
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views/servicios.blade.php ENDPATH**/ ?>