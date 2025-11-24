<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>NOSOTROS - TAXI EXPRESS PAMPLONA S.A.S</title>

    @vite(['resources/css/app.css', 'resources/css/nosotros.css', 'resources/js/app.js'])
</head>
<body class="landing-body">
    <!-- Header/Navbar -->
    <header class="header-landing">
        <div class="container-landing">
            <nav class="navbar-landing">
                <div class="logo-landing">
                    <img src="{{ asset('imagenes/logo.png') }}" alt="TAXI EXPRESS PAMPLONA">
                </div>
                <ul class="nav-menu-landing" id="navMenu">
                    <li><a href="/" class="nav-link-landing">INICIO</a></li>
                    <li><a href="{{ route('nosotros') }}" class="nav-link-landing">NOSOTROS</a></li>
                    <li><a href="{{ route('servicios') }}" class="nav-link-landing">NUESTROS SERVICIOS</a></li>
                    <li><a href="{{ route('corporativo') }}" class="nav-link-landing">CORPORATIVO</a></li>
                    <li class="dropdown-landing">
                        <a href="#" class="nav-link-landing dropdown-toggle" id="plataformaDropdown">
                            PLATAFORMA
                            <svg class="dropdown-arrow" width="12" height="8" viewBox="0 0 12 8" fill="none">
                                <path d="M1 1L6 6L11 1" stroke="currentColor" stroke-width="2" stroke-linecap="round"/>
                            </svg>
                        </a>
                        <ul class="dropdown-menu-landing" id="dropdownMenu">
                        @auth
                            <li>
                                <a href="{{ 
                                    auth()->user()->esAdministrador() ? route('admin.dashboard') : 
                                    (auth()->user()->esOperadora() ? route('operadora.dashboard') : 
                                    (auth()->user()->esConductor() ? route('conductor.dashboard') : 
                                    route('dashboard.user'))) 
                                }}" class="dropdown-item-landing">Dashboard</a>
                            </li>
                        @else
                            <li>
                                <a href="{{ route('login') }}" class="dropdown-item-landing">Iniciar Sesión</a>
                            </li>
                        @endauth
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
        <!-- Hero Section NOSOTROS con imagen de fondo -->
        <section class="nosotros-hero">
            <div class="nosotros-content-wrapper">
                <h1 class="nosotros-title">NOSOTROS</h1>
            </div>
        </section>

        <!-- Contenido NOSOTROS - Misión y Visión -->
        <section class="nosotros-content">
            <div class="nosotros-card">
                <h2 class="nosotros-subtitle">MISIÓN</h2>
                <p class="nosotros-text">
                    mision Ser una empresa competitiva en el servicio público de transporte innovando con plataformas 
                    tecnológicas, servicio las 24 horas a fin de fidelizar a nuestros clientes a traves de la estrategia 
                    organizacional, parque automotor renovado, tecnologia de vanguardia y sustentabilidad con 
                    el medio ambiente, exaltando la excelencia y calidad del servicio para el desarrollo economico 
                    y social para la ciudad de Pamplona.
                </p>
            </div>

            <div class="nosotros-card">
                <h2 class="nosotros-subtitle">VISIÓN</h2>
                <p class="nosotros-text">
                    VISION Ser una empresa líder en el transporte público de Pamplona, para
                    mejorar el servicio y la seguridad para nuestros pasajeros y comunidad
                    en general de la mano de los organismos de seguridad en el estado.
                </p>
            </div>
        </section>
    </main>

    <!-- Footer -->
    <footer class="footer-landing">
        <div class="footer-content-landing">
            <div class="footer-logo-container">
                <img src="{{ asset('imagenes/st.jpeg') }}" alt="S&T" class="footer-logo">
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
</html>