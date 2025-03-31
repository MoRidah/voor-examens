<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Items Beheer') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
        
        <!-- FontAwesome -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        
        <!-- Custom Styles -->
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
            .auth-card {
                border-radius: 1rem;
                box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
                overflow: hidden;
                border: none;
            }
            .auth-header {
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                color: white;
                padding: 2rem;
                text-align: center;
            }
            .auth-body {
                padding: 2rem;
            }
            .btn-primary {
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                border: none;
            }
            .btn-primary:hover {
                background: linear-gradient(135deg, #5910b0 0%, #1e68e0 100%);
            }
            .footer {
                flex-shrink: 0;
                background-color: #343a40;
                color: white;
                padding: 30px 0;
                width: 100%;
            }
        </style>
        
        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
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
                        </div>
                    </div>
                </nav>

                <!-- Auth Content -->
                <div class="container py-5">
                    <div class="row justify-content-center">
                        <div class="col-md-6">
                            <div class="card auth-card">
                                <div class="auth-header">
                                    <a href="/" class="d-block mb-3">
                                        <i class="fas fa-box-open text-white" style="font-size: 3rem;"></i>
                                    </a>
                                    <h4 class="mb-0">{{ config('app.name', 'Items Beheer') }}</h4>
                                </div>
                                <div class="auth-body">
                                    {{ $slot }}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
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
