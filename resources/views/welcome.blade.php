
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sewa Barang - Modern Rental Platform</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" rel="stylesheet">
</head>
<body class="antialiased bg-gradient-to-br from-gray-900 to-gray-800 min-h-screen">
    <div class="relative sm:flex sm:justify-center sm:items-center min-h-screen">
        <!-- Navigation -->
        <div class="fixed top-0 right-0 p-6 text-right z-10">
            @if (Route::has('login'))
                <div class="space-x-4">
                    @auth
                        <a href="{{ url('/dashboard') }}" class="font-semibold text-white hover:text-gray-300 transition duration-300">Dashboard</a>
                    @else
                        <a href="{{ route('login') }}" class="font-semibold text-white bg-gradient-to-r from-purple-500 to-indigo-600 px-6 py-2 rounded-full hover:opacity-90 transition duration-300">Log in</a>
                        @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-white border-2 border-purple-500 px-6 py-2 rounded-full hover:bg-purple-500 transition duration-300">Register</a>
                        @endif
                    @endauth
                </div>
            @endif
        </div>

        <!-- Main Content -->
        <div class="max-w-7xl mx-auto p-6 lg:p-8">
            <div class="text-center mb-16">
                <h1 class="text-5xl font-bold text-white mb-4 animate__animated animate__fadeInDown">Sewa Barang Platform</h1>
                <p class="text-gray-400 text-xl animate__animated animate__fadeInUp">Your Modern Rental Solution</p>
            </div>

            <!-- Items Grid -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-8">
                @foreach($items ?? [] as $item)
                <div class="bg-white/10 backdrop-blur-lg rounded-xl p-6 transform hover:scale-105 transition duration-300 border border-gray-700">
                    <div class="aspect-w-16 aspect-h-9 mb-4">
                    @if($item->image)
                                        <img src="{{ asset('storage/'.$item->image) }}" 
                                             alt="{{ $item->name }}" 
                                             class="rounded-3 shadow-sm img-preview">
                                    @else
                                        <div class="no-image-placeholder">
                                            <!-- <i class="fas fa-image text-muted"></i> -->
                                             <img src="https://via.placeholder.com/300" class="object-cover rounded-lg w-full h-48" alt="Item">
                                        </div>
                    @endif
                        <!-- <img src="{{ $item->image_url ?? 'https://via.placeholder.com/300' }}" class="object-cover rounded-lg w-full h-48" alt="Item"> -->
                    </div>
                    <h3 class="text-xl font-semibold text-white mb-2">{{ $item->name ?? 'Item Name' }}</h3>
                    <p class="text-gray-400 mb-4">{{ $item->description ?? 'Item description goes here' }}</p>
                    <div class="flex justify-between items-center">
                        <span class="text-purple-400 font-bold">Rp {{ number_format($item->price ?? 0, 0, ',', '.') }}/day</span>
                        <button class="bg-gradient-to-r from-purple-500 to-indigo-600 text-white px-4 py-2 rounded-full hover:opacity-90 transition duration-300">
                            Rent Now
                        </button>
                    </div>
                </div>
                @endforeach
            </div>

            <!-- Features Section -->
            <div class="mt-16 grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="text-center p-6 rounded-xl bg-white/5 backdrop-blur-lg">
                    <div class="text-purple-400 text-4xl mb-4">
                        <i class="fas fa-bolt"></i>
                    </div>
                    <h3 class="text-white text-xl font-semibold mb-2">Quick Rental</h3>
                    <p class="text-gray-400">Instant booking process</p>
                </div>
                <div class="text-center p-6 rounded-xl bg-white/5 backdrop-blur-lg">
                    <div class="text-purple-400 text-4xl mb-4">
                        <i class="fas fa-shield-alt"></i>
                    </div>
                    <h3 class="text-white text-xl font-semibold mb-2">Secure Payment</h3>
                    <p class="text-gray-400">Safe transaction guaranteed</p>
                </div>
                <div class="text-center p-6 rounded-xl bg-white/5 backdrop-blur-lg">
                    <div class="text-purple-400 text-4xl mb-4">
                        <i class="fas fa-headset"></i>
                    </div>
                    <h3 class="text-white text-xl font-semibold mb-2">24/7 Support</h3>
                    <p class="text-gray-400">Always here to help</p>
                </div>
            </div>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/your-font-awesome-kit.js"></script>
</body>
</html>
