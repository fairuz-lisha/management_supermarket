<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - FreshMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <style>
        .btn-primary {
            background: linear-gradient(135deg, #A8E6CF 0%, #6FCF97 100%);
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(111, 207, 151, 0.3);
        }
    </style>
    @stack('styles')
</head>
<body class="bg-gray-50">
    @include('layouts.sidebar')
    
    <div class="ml-64 min-h-screen">
        <header class="bg-white shadow-sm sticky top-0 z-40">
            <div class="flex justify-between items-center px-8 py-4">
                <h1 class="text-2xl font-bold text-gray-800">@yield('page-title')</h1>
                <div class="flex items-center space-x-4">
                    <span class="text-gray-600">{{ Auth::guard('admin')->user()->name }}</span>
                    <form action="{{ route('admin.logout') }}" method="POST" class="inline">
                        @csrf
                        <button class="text-red-600 hover:text-red-700">
                            <i class="fas fa-sign-out-alt"></i>
                        </button>
                    </form>
                </div>
            </div>
        </header>
        
        <main class="p-8">
            @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-6 py-4 rounded-lg mb-6 flex items-center">
                <i class="fas fa-check-circle mr-3 text-xl"></i>
                <span>{{ session('success') }}</span>
            </div>
            @endif
            
            @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-6 py-4 rounded-lg mb-6 flex items-center">
                <i class="fas fa-exclamation-circle mr-3 text-xl"></i>
                <span>{{ session('error') }}</span>
            </div>
            @endif
            
            @yield('content')
        </main>
    </div>
    
    @stack('scripts')
</body>
</html>
