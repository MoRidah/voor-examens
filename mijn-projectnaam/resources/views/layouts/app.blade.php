<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>@yield('title', config('app.name', 'Items Beheer'))</title>

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
            .btn {
                border-radius: 0.375rem;
            }
            .card {
                border-radius: 0.5rem;
                overflow: hidden;
            }
            .badge {
                font-weight: 500;
            }
            .table-hover tbody tr:hover {
                background-color: rgba(0, 123, 255, 0.03);
            }
            .page-header {
                background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
                color: white;
                padding: 2rem 0;
                margin-bottom: 2rem;
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
                @include('layouts.navigation')

                <!-- Page Heading -->
                @isset($header)
                    <header class="page-header">
                        <div class="container">
                            <h1 class="h3 mb-0">{{ $header }}</h1>
                        </div>
                    </header>
                @else
                    @hasSection('header')
                        <header class="page-header">
                            <div class="container">
                                @yield('header')
                            </div>
                        </header>
                    @endif
                @endisset

                <!-- Page Content -->
                <main class="py-4">
                    @if(session('success'))
                        <div class="container">
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    
                    @if(session('error'))
                        <div class="container">
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        </div>
                    @endif
                    
                    @if(View::hasSection('content'))
                        @yield('content')
                    @else
                        {{ $slot ?? '' }}
                    @endif
                </main>
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
