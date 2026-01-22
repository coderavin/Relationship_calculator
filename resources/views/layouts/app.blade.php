<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Love Meter - Relationship Calculator')</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Dancing+Script:wght@400;700&display=swap" rel="stylesheet">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        :root {
            --primary: #ff4081;
            --secondary: #536dfe;
            --light-bg: #f8f9fa;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(135deg, #ece1f3 0%, #c3cfe2 100%);
            min-height: 100vh;
            color: #0b0d2b;
        }

        /* Soft glass effect */
        .glass-card {
            background: rgba(255, 255, 255, 0.92);
            backdrop-filter: blur(10px);
            border-radius: 16px;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
        }

        .btn-primary {
            background: linear-gradient(45deg, #ff4081, #ff6b9d);
            color: white;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-primary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(255, 64, 129, 0.3);
        }

        .btn-secondary {
            background: linear-gradient(45deg, #536dfe, #7986cb);
            color: white;
            padding: 12px 28px;
            border-radius: 10px;
            font-weight: 600;
            transition: all 0.3s ease;
            border: none;
        }

        .btn-secondary:hover {
            transform: translateY(-3px);
            box-shadow: 0 10px 20px rgba(83, 109, 254, 0.3);
        }

        /* Heart animation */
        .heart-beat {
            animation: heartbeat 1.5s ease-in-out infinite;
        }

        @keyframes heartbeat {
            0%, 100% { transform: scale(1); }
            50% { transform: scale(1.1); }
        }

        /* Floating animation */
        .floating {
            animation: floating 3s ease-in-out infinite;
        }

        @keyframes floating {
            0%, 100% { transform: translateY(0px); }
            50% { transform: translateY(-15px); }
        }

        /* Input styles */
        .input-field {
            background: #ffffff;
            border: 2px solid #e0e0e0;
            border-radius: 10px;
            padding: 14px 18px;
            font-size: 16px;
            transition: all 0.3s ease;
        }

        .input-field:focus {
            border-color: #ff4081;
            box-shadow: 0 0 0 3px rgba(255, 64, 129, 0.1);
            outline: none;
        }

        /* Gender button styles */
        .gender-btn {
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }

        .gender-btn.active {
            border-color: #536dfe;
            background: #f0f3ff;
        }

        /* Type card styles */
        .type-card {
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .type-card.selected {
            border-color: #ff4081;
            background: linear-gradient(135deg, #363652, #fff);
            transform: scale(1.02);
        }

        /* Responsive */
        @media (max-width: 768px) {
            .glass-card {
                margin: 10px;
                padding: 20px;
            }
        }
    </style>

    @yield('styles')
</head>
<body class="min-h-screen">
    <!-- Simple floating hearts -->
    <div class="fixed inset-0 overflow-hidden pointer-events-none z-0">
        @for($i = 0; $i < 8; $i++)
        <div class="absolute text-pink-200 opacity-30 floating"
             style="left: {{ rand(0, 100) }}%; top: {{ rand(0, 100) }}%;
                    font-size: {{ rand(20, 30) }}px;
                    animation-delay: {{ $i * 0.3 }}s;
                    animation-duration: {{ rand(3, 5) }}s;">
            <i class="fas fa-heart"></i>
        </div>
        @endfor
    </div>

    <!-- Navigation -->
    <nav class="py-4 px-6 bg-white shadow-sm">
        <div class="container mx-auto">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="w-10 h-10 rounded-full bg-gradient-to-r from-pink-500 to-purple-500 flex items-center justify-center">
                        <i class="fas fa-heart text-white text-xl heart-beat"></i>
                    </div>
                    <div>
                        <h1 class="text-xl font-bold text-gray-800">Love Meter</h1>
                        <p class="text-xs text-gray-600">Relationship Calculator</p>
                    </div>
                </div>

                <div class="flex items-center space-x-4">
                    <a href="{{ route('home') }}" class="text-gray-700 hover:text-pink-600 transition">
                        <i class="fas fa-home"></i>
                        <span class="hidden md:inline ml-1">Home</span>
                    </a>
                    <a href="{{ route('recent') }}" class="text-gray-700 hover:text-pink-600 transition">
                        <i class="fas fa-history"></i>
                        <span class="hidden md:inline ml-1">Recent</span>
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="py-8 px-4">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="py-6 bg-gray-800 text-white">
        <div class="container mx-auto text-center">
            <p>&copy; 2024 Love Meter. All calculations are for entertainment purposes.</p>
            <p class="mt-2 text-sm text-gray-400">Made with <i class="fas fa-heart text-pink-400 mx-1"></i></p>
        </div>
    </footer>

    @yield('scripts')
</body>
</html>
