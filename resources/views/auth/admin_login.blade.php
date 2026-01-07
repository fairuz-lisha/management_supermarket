<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Admin - FreshMart</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
</head>
<body class="bg-gradient-to-br from-green-100 via-green-50 to-green-100 min-h-screen flex items-center justify-center">
    <div class="container mx-auto px-4">
        <div class="max-w-md mx-auto">
            <div class="bg-white rounded-2xl shadow-2xl overflow-hidden">
                <div class="bg-gradient-to-r from-green-500 to-green-600 p-8 text-center">
                    <i class="fas fa-user-shield text-6xl text-white mb-4"></i>
                    <h2 class="text-3xl font-bold text-white">Admin Login</h2>
                    <p class="text-green-100 mt-2">FreshMart Management</p>
                </div>
                
                <div class="p-8">
                    @if($errors->any())
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6">
                        <i class="fas fa-exclamation-circle mr-2"></i>
                        {{ $errors->first() }}
                    </div>
                    @endif
                    
                    <form action="{{ route('admin.login.post') }}" method="POST">
                        @csrf
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-envelope mr-2 text-green-600"></i>Email
                            </label>
                            <input type="email" name="email" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                placeholder="admin@freshmart.com">
                        </div>
                        
                        <div class="mb-6">
                            <label class="block text-gray-700 font-semibold mb-2">
                                <i class="fas fa-lock mr-2 text-green-600"></i>Password
                            </label>
                            <input type="password" name="password" required
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-green-500 focus:border-transparent transition"
                                placeholder="••••••••">
                        </div>
                        
                        <button type="submit" class="w-full bg-gradient-to-r from-green-500 to-green-600 text-white py-3 rounded-lg font-semibold hover:from-green-600 hover:to-green-700 transition transform hover:scale-105">
                            <i class="fas fa-sign-in-alt mr-2"></i>Login
                        </button>
                    </form>
                    
                    <div class="mt-6 text-center">
                        <a href="{{ route('shop.index') }}" class="text-green-600 hover:text-green-700 transition">
                            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Toko
                        </a>
                    </div>
                </div>
            </div>
            
            <div class="mt-6 text-center text-gray-600">
                <p class="text-sm">Demo Login:</p>
                <p class="text-xs">Admin: admin@supermarket.com / admin123</p>
                <p class="text-xs">Kasir: kasir@supermarket.com / kasir123</p>
            </div>
        </div>
    </div>
</body>
</html>