<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Furniture | @yield('title', 'Home')</title>
    
    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        'wood': '#D4B996',
                        'light-wood': '#F5DEB3',
                        'navy': '#0A192F',
                        'light-navy': '#172a45',
                    },
                    fontFamily: {
                        'playfair': ['"Playfair Display"', 'serif'],
                        'raleway': ['"Raleway"', 'sans-serif'],
                    }
                }
            }
        }
    </script>
    
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;500;600;700&family=Raleway:wght@300;400;500;600&display=swap" rel="stylesheet">
    
    <!-- AOS Animation Library -->
    <link href="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.css" rel="stylesheet">
    
    <!-- Alpine.js (for Livewire) -->
    {{-- <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.12.0/dist/cdn.min.js"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/alpinejs/2.3.0/alpine-ie11.js" integrity="sha512-6m6AtgVSg7JzStQBuIpqoVuGPVSAK5Sp/ti6ySu6AjRDa1pX8mIl1TwP9QmKXU+4Mhq/73SzOk6mbNvyj9MPzQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    
    <!-- Livewire Styles -->
    @livewireStyles
    
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Inconsolata:wght@200..900&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Playwrite+AU+SA:wght@100..400&display=swap');
        @import url('https://fonts.googleapis.com/css2?family=Gidole&display=swap');
        *
        {
            font-family: "Gidole", sans-serif;
            /* font-optical-sizing: auto; */
            font-weight: 400;
            font-style: normal;
        }
        body {
            /* font-family: 'Raleway', sans-serif; */
        }
        .font-heading {
            /* font-family: 'Playfair Display', serif; */
        }
        
        /* Custom Clip Path for Hero Section */
        .clip-path-hero {
            clip-path: polygon(0 0, 100% 0, 100% 85%, 0 100%);
        }
    </style>
</head>
<body class="bg-white ">
    <!-- Header -->
    @livewire('frontend.nav')
    
    <!-- Main Content -->
    <main class="">
        {{$slot}}
    </main>
    
    <!-- Footer -->
    @livewire('frontend.footer-component')
    
    <!-- Livewire Scripts -->
    @livewireScripts
    
    <!-- AOS Animation Library -->
    <script src="https://cdn.jsdelivr.net/npm/aos@2.3.4/dist/aos.js"></script>
    
    <!-- TypedJS -->
    <script src="https://cdn.jsdelivr.net/npm/typed.js@2.0.12/lib/typed.min.js"></script>
    
    <!-- VantaJS for Footer Background -->
    <script src="https://cdn.jsdelivr.net/npm/three@0.132.2/build/three.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/vanta@0.5.22/dist/vanta.net.min.js"></script>
    
    <!-- Initialize AOS -->
    <script>
        AOS.init({
            duration: 800,
            easing: 'ease-in-out',
            once: true
        });
    </script>
</body>
</html>