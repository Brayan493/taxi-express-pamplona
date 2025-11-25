<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TAXI EXPRESS PAMPLONA S.A.S</title>
    <?php echo app('Illuminate\Foundation\Vite')(['resources/css/app.css', 'resources/js/app.js']); ?>
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
                    <li><a href="#inicio" class="nav-link-landing">INICIO</a></li>
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

    <!-- Main Content Container -->
    <main class="main-landing">
        <!-- Hero Section CON IMAGEN DE FONDO -->
        <section id="inicio" class="hero-landing">
            <div class="hero-content-wrapper">
                <h1 class="hero-title">
                    <span class="title-red">TAXI</span> 
                    <span class="title-black">EXPRESS</span><br>
                    <span class="title-blue">PAMPLONA</span> 
                    <span class="title-yellow">S.A.S</span>
                </h1>
                
                <div class="hero-info">
                    <p class="info-subtitle">Servicio de Transporte</p>
                    <p class="info-address">📍Calle 2 #6-72, Barrio el Humilladero</p>
                    <p class="info-city">Pamplona, Norte de Santander</p>
                    <p class="info-phones">📞 314 238 1850 - 314 238 1851 - 314 238 1852 - 314 238 5832</p>
                    <p class="info-schedule">🕐 LUNES A DOMINGO: 5AM A 1AM</p>
                </div>
            </div>
        </section>

        <!-- Texto de descripción -->
        <section id="nosotros" class="description-landing">
            <p>
                Es una empresa líder en servicios de radiotaxi, transporte de 
                pasajeros, taller automotriz y venta de repuestos, comprometida
                con ofrecer soluciones integrales de movilidad y mantenimiento
                vehicular.
            </p>
            <p>
                Taxi express se distingue por su flota moderna, segura y confiable, 
                además de un equipo humano altamente capacitado, orientado
                siempre a la satisfacción y seguridad de nuestros clientes.
            </p>
            <p>
                En taxi express, trabajamos día a día con compromiso, innovación
                y responsabilidad, impulsando el desarrollo económico y social de
                nuestra región, y garantizando a cada cliente un servicio eficiente,
                ágil y de calidad.
            </p>
        </section>

        <!-- Sección Nuestra Oficina -->
        <section id="servicios" class="office-landing">
            <h2 class="office-title">NUESTRA OFICINA</h2>
            <div class="office-image-container">
                <img src="<?php echo e(asset('imagenes/OFICINA ENTRADA.jpg')); ?>" alt="Oficina">
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

        // Smooth scroll for anchor links
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
</html><?php /**PATH C:\Users\Usuario\Desktop\TRABAJO DE GRADO\proyecto-login\proyecto-login\proyecto-login\resources\views\welcome.blade.php ENDPATH**/ ?>