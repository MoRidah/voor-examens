<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>{{ config('app.name', 'Items Beheer') }}</title>
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <!-- Custom CSS -->
        <style>
            html, body {
                height: 100%;
                font-family: 'Nunito', sans-serif;
                background-color: #f8f9fa;
                overflow-x: hidden;
            }
            .wrapper {
                min-height: 100%;
                display: flex;
                flex-direction: column;
            }
            .content {
                flex: 1 0 auto;
            }
            .navbar {
                box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            }
            .hero-section {
                padding: 100px 0;
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                color: white;
                margin-bottom: 50px;
                position: relative;
                overflow: hidden;
            }
            .feature-box {
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 5px 15px rgba(0,0,0,0.05);
                transition: transform 0.3s ease;
                background: white;
                height: 100%;
            }
            .feature-box:hover {
                transform: translateY(-5px);
            }
            .feature-icon {
                font-size: 2.5rem;
                margin-bottom: 20px;
                color: #2575fc;
            }
            .footer {
                flex-shrink: 0;
                background-color: #343a40;
                color: white;
                padding: 30px 0;
                width: 100%;
            }
            
            /* Sticky Figure Animation */
            .sticky-figure-container {
                position: absolute;
                bottom: 0;
                width: 100%;
                height: 60px;
                overflow: hidden;
            }
            .sticky-figure {
                position: absolute;
                bottom: 10px;
                left: -50px;
                width: 40px;
                height: 50px;
                animation: walkAnimation 20s linear infinite;
            }
            .sticky-head {
                position: absolute;
                top: 0;
                left: 10px;
                width: 20px;
                height: 20px;
                background-color: rgba(255, 255, 255, 0.9);
                border-radius: 50%;
            }
            .sticky-body {
                position: absolute;
                top: 20px;
                left: 15px;
                width: 10px;
                height: 15px;
                background-color: rgba(255, 255, 255, 0.9);
            }
            .sticky-arm-left, .sticky-arm-right {
                position: absolute;
                width: 10px;
                height: 2px;
                background-color: rgba(255, 255, 255, 0.9);
            }
            .sticky-arm-left {
                top: 22px;
                left: 5px;
                transform-origin: right center;
                animation: leftArmSwing 0.5s alternate infinite;
            }
            .sticky-arm-right {
                top: 22px;
                left: 25px;
                transform-origin: left center;
                animation: rightArmSwing 0.5s alternate infinite;
            }
            .sticky-leg-left, .sticky-leg-right {
                position: absolute;
                width: 2px;
                height: 15px;
                background-color: rgba(255, 255, 255, 0.9);
            }
            .sticky-leg-left {
                top: 35px;
                left: 15px;
                transform-origin: top center;
                animation: leftLegSwing 0.5s alternate infinite;
            }
            .sticky-leg-right {
                top: 35px;
                left: 23px;
                transform-origin: top center;
                animation: rightLegSwing 0.5s alternate infinite;
            }
            
            @keyframes walkAnimation {
                0% {
                    left: -50px;
                }
                100% {
                    left: calc(100% + 50px);
                }
            }
            
            @keyframes leftArmSwing {
                0% {
                    transform: rotate(-30deg);
                }
                100% {
                    transform: rotate(30deg);
                }
            }
            
            @keyframes rightArmSwing {
                0% {
                    transform: rotate(30deg);
                }
                100% {
                    transform: rotate(-30deg);
                }
            }
            
            @keyframes leftLegSwing {
                0% {
                    transform: rotate(-20deg);
                }
                100% {
                    transform: rotate(20deg);
                }
            }
            
            @keyframes rightLegSwing {
                0% {
                    transform: rotate(20deg);
                }
                100% {
                    transform: rotate(-20deg);
                }
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="content">
                <!-- Navigation -->
                <nav class="navbar navbar-expand-lg navbar-light bg-white">
                    <div class="container">
                        <a class="navbar-brand d-flex align-items-center" href="{{ url('/') }}">
                            <i class="fas fa-box-open me-2 text-primary"></i>
                            {{ config('app.name', 'Items Beheer') }}
                        </a>
                        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                        <div class="collapse navbar-collapse" id="navbarNav">
                            <ul class="navbar-nav me-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ url('/') }}">Home</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('items.index') }}">Items</a>
                                </li>
                            </ul>
                            <div class="d-flex">
                                @if (Route::has('login'))
                                    @auth
                                        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary me-2">Dashboard</a>
                                    @else
                                        <a href="{{ route('login') }}" class="btn btn-outline-primary me-2">Login</a>
                                        @if (Route::has('register'))
                                            <a href="{{ route('register') }}" class="btn btn-primary">Register</a>
                                        @endif
                                    @endauth
                                @endif
                            </div>
                        </div>
                    </div>
                </nav>

                <!-- Hero Section -->
                <section class="hero-section">
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <h1 class="display-4 fw-bold mb-4">Welkom bij {{ config('app.name', 'Items Beheer') }}</h1>
                                <p class="lead mb-5">Een eenvoudige en krachtige applicatie voor het beheren van uw items</p>
                                <a href="{{ route('items.index') }}" class="btn btn-light btn-lg px-5">
                                    <i class="fas fa-box-open me-2"></i>Bekijk Items
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <!-- Sticky Figure Animation -->
                    <div class="sticky-figure-container">
                        <div class="sticky-figure">
                            <div class="sticky-head"></div>
                            <div class="sticky-body"></div>
                            <div class="sticky-arm-left"></div>
                            <div class="sticky-arm-right"></div>
                            <div class="sticky-leg-left"></div>
                            <div class="sticky-leg-right"></div>
                        </div>
                    </div>
                </section>

                <!-- Features Section -->
                <section class="py-5">
                    <div class="container">
                        <h2 class="text-center mb-5">Onze Functies</h2>
                        <div class="row g-4">
                            <div class="col-md-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-search"></i>
                                    </div>
                                    <h4>Zoeken & Filteren</h4>
                                    <p>Vind snel wat u zoekt met onze geavanceerde zoek- en filterfuncties.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-edit"></i>
                                    </div>
                                    <h4>Eenvoudig Beheer</h4>
                                    <p>Voeg, bewerk en verwijder items met een gebruiksvriendelijke interface.</p>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="feature-box">
                                    <div class="feature-icon">
                                        <i class="fas fa-mobile-alt"></i>
                                    </div>
                                    <h4>Responsive Design</h4>
                                    <p>Gebruik de applicatie op elk apparaat, van desktop tot mobiel.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>

            <!-- Footer -->
            <footer class="footer">
                <div class="container">
                    <div class="row">
                        <div class="col-md-6 text-center text-md-start">
                            <h5>{{ config('app.name', 'Items Beheer') }}</h5>
                            <p>Een eenvoudige en krachtige applicatie voor het beheren van uw items.</p>
                        </div>
                        <div class="col-md-6 text-center text-md-end">
                            <p>&copy; {{ date('Y') }} {{ config('app.name', 'Items Beheer') }}. Alle rechten voorbehouden.</p>
                        </div>
                    </div>
                </div>
            </footer>
        </div>

        <!-- Bootstrap JS -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    </body>
</html>
