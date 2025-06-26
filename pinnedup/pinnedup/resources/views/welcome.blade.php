<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="assets/logo.png">

    <title>Pinned Up</title>

    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#00a1b5',
                        primaryLight: '#00c0d8',
                        primaryDark: '#008095',
                        secondary: '#de0050',
                    },
                    fontFamily: {
                        poppins: ['Poppins', 'sans-serif'],
                    },
                },
            },
            darkMode: 'class',
        };
    </script>

    <!-- Font Awesome -->
    <link
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
            rel="stylesheet"
    />
</head>
<body class="bg-gray-100 text-gray-800 font-poppins dark:bg-gray-900 dark:text-gray-100">

<!-- NAVBAR -->
<nav class="bg-gray-800 text-white p-4 shadow-lg sticky  top-0 z-50">
    <div class="max-w-screen-xl mx-auto flex justify-between items-center">
        <!-- Logo -->
        <a href="#" class="flex items-center space-x-2">
            <img src="assets/logo.png" alt="Pinned Up Logo" class="h-8 w-8">
            <span class="text-xl font-bold">Pinned Up
        <p class="text-gray-300 text-xs">Freelance Business Management</p></span>
        </a>

        <!-- Links -->
        <div id="navLinks" class="hidden md:flex items-center space-x-6">
            <a href="#hero" class="hover:text-primary">Home</a>
            <a href="#features" class="hover:text-primary">Features</a>
            <a href="#about" class="hover:text-primary">About Us</a>
            <a href="#contact" class="hover:text-primary">Contact</a>
        </div>

        <!-- Right Section: Login, Sign-Up, and Theme Toggle -->
        <div class="flex items-center space-x-4">
            <!-- Login -->
            <a
                    href= "{{ route('login') }}"
          class="hidden md:inline-block px-4 py-2 bg-secondary text-white rounded-lg hover:bg-secondary/90 transition"
            >
            Log In
            </a>
            <!-- Sign-Up -->
            <a
                    href="{{ route('register') }}"
          class="hidden md:inline-block px-4 py-2 bg-primary text-white rounded-lg hover:bg-primaryLight transition"
            >
            Sign Up
            </a>
            <!-- Theme Toggle -->
            <button id="themeToggle" class="text-gray-300 hover:text-primary text-xl" onclick="toggleTheme()">
                <i id="themeIcon" class="fas fa-sun"></i>
            </button>
            <!-- Hamburger Menu -->
            <button id="hamburger" class="md:hidden text-gray-300 text-xl">
                <i class="fas fa-bars"></i>
            </button>
        </div>
    </div>
    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden flex-col space-y-4 mt-4 md:hidden">
        <a href="#hero" class="block text-center py-2 text-primary hover:bg-gray-700 rounded-lg">Home</a>
        <a href="#features" class="block text-center py-2 text-primary hover:bg-gray-700 rounded-lg">Features</a>
        <a href="#about" class="block text-center py-2 text-primary hover:bg-gray-700 rounded-lg">About Us</a>
        <a href="#why-love" class="block text-center py-2 text-primary hover:bg-gray-700 rounded-lg">Why Love Us</a>
        <a href="#contact" class="block text-center py-2 text-primary hover:bg-gray-700 rounded-lg">Contact</a>
        <a href="/login" class="block text-center py-2 bg-secondary text-white rounded-lg hover:bg-secondary/90">Log In</a>
        <a href="/sign-up" class="block text-center py-2 bg-primary text-white rounded-lg hover:bg-primaryLight">Sign Up</a>
    </div>
</nav>

<!-- HERO SECTION -->
<section id="hero" class="h-[70vh] bg-cover bg-center relative" style="background-image: url('assets/hero.png'); background-position: center top;">
    <div class="absolute inset-0 bg-black/60"></div>
    <div class="relative z-10 flex flex-col items-center justify-center h-full text-center text-white px-4">
        <h1 class="text-4xl font-bold">Streamline Your Freelance Workflow</h1>
        <p class="mt-4 text-lg">An all-in-one platform to manage tasks, clients, and invoices.</p>
        <a href="#about" class="mt-6 bg-secondary px-6 py-3 rounded-lg hover:bg-secondary/90">
            Learn More
        </a>
    </div>
</section>


<!-- FEATURES SECTION -->
<section id="features" class="py-16 bg-gray-100 dark:bg-gray-800">
    <div class="max-w-screen-xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-12">Our Features</h2>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                <i class="fas fa-tasks text-primary text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Task Management</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">Organize and prioritize your work seamlessly.</p>
            </div>
            <!-- Feature 2 -->
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                <i class="fas fa-file-invoice text-primary text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Invoicing</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">Create and manage professional invoices effortlessly.</p>
            </div>
            <!-- Feature 3 -->
            <div class="bg-white dark:bg-gray-700 rounded-lg shadow p-6">
                <i class="fas fa-chart-line text-primary text-3xl mb-4"></i>
                <h3 class="text-xl font-bold">Analytics</h3>
                <p class="mt-2 text-gray-600 dark:text-gray-300">Gain insights into your business performance.</p>
            </div>
        </div>
    </div>
</section>

<!-- WHY LOVE OUR FEATURES SECTION -->
<section id="why-love" class="py-16 bg-primary text-white">
    <div class="max-w-screen-xl mx-auto text-center px-4">
        <h2 class="text-3xl font-bold mb-8">Why You'll Love Our Features</h2>
        <p class="text-lg mb-6">We designed our platform to empower freelancers with features that truly matter:</p>
        <div class="grid md:grid-cols-3 gap-8">
            <!-- Card 1: Efficiency -->
            <div class="p-6 bg-white text-gray-900 rounded-lg shadow-lg flex flex-col items-center">
                <i class="fas fa-clock text-primary text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-4">Efficiency</h3>
                <p>Save time and stay organized with seamless task tracking and management.</p>
            </div>
            <!-- Card 2: Flexibility -->
            <div class="p-6 bg-white text-gray-900 rounded-lg shadow-lg flex flex-col items-center">
                <i class="fas fa-sliders-h text-secondary text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-4">Flexibility</h3>
                <p>Customizable tools that adapt to your unique workflow.</p>
            </div>
            <!-- Card 3: Support -->
            <div class="p-6 bg-white text-gray-900 rounded-lg shadow-lg flex flex-col items-center">
                <i class="fas fa-headset text-primary text-4xl mb-4"></i>
                <h3 class="text-xl font-bold mb-4">Support</h3>
                <p>Get help whenever you need it with 24/7 customer support.</p>
            </div>
        </div>
    </div>
</section>


<!-- ABOUT US SECTION -->
<section id="about" class="py-16">
    <div class="max-w-screen-xl mx-auto flex flex-col md:flex-row items-center gap-8 px-4">
        <!-- Image -->
        <img src="assets/about-image.png" alt="About Us" class="w-full md:w-1/2 rounded-lg border-4 border-primary shadow-lg">
        <!-- Text -->
        <div>
            <h2 class="text-3xl font-bold mb-4">About Us</h2>
            <p class="text-gray-600 dark:text-gray-300">
                We empower freelancers worldwide by simplifying workflows, enhancing productivity, and providing top-notch tools to manage their business effectively.
            </p>
            <ul class="mt-6 space-y-2">
                <li><i class="fas fa-check text-primary mr-2"></i> Client-Centric Design</li>
                <li><i class="fas fa-check text-primary mr-2"></i> Scalable Solutions</li>
                <li><i class="fas fa-check text-primary mr-2"></i> Global Impact</li>
            </ul>
        </div>
    </div>
</section>

<!-- CONTACT US SECTION -->
<section id="contact" class="py-16 bg-gray-100 dark:bg-gray-800">
    <div class="max-w-screen-md mx-auto px-4">
        <h2 class="text-3xl font-bold text-center mb-8">Contact Us</h2>
        <form class="space-y-6">
            <div>
                <label for="email" class="block mb-2 text-gray-600 dark:text-gray-300">Email</label>
                <input type="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600" required>
            </div>
            <div>
                <label for="message" class="block mb-2 text-gray-600 dark:text-gray-300">Message</label>
                <textarea id="message" rows="4" class="w-full px-4 py-2 border border-gray-300 rounded-lg dark:bg-gray-700 dark:border-gray-600" required></textarea>
            </div>
            <button class="bg-primary px-6 py-2 text-white rounded-lg hover:bg-primaryLight">Send Message</button>
        </form>
    </div>
</section>

<!-- FOOTER -->
<footer class="bg-gray-800 text-gray-400 py-8">
    <div class="max-w-screen-xl mx-auto px-4">
        <div class="flex flex-col md:flex-row justify-between items-center">
            <!-- Logo and Name -->
            <div class="flex items-center mb-6 md:mb-0">
                <img src="assets/logo.png" alt="Pinned Up Logo" class="h-12 w-12 mr-4">
                <div>
                    <p class="text-white text-lg font-bold">Pinned Up</p>
                    <p class="text-gray-300 text-sm">Freelance Business Management</p>
                </div>
            </div>

            <!-- Social Links -->
            <div class="flex space-x-6">
                <!-- Facebook -->
                <a href="https://facebook.com" target="_blank" class="hover:text-primary">
                    <i class="fab fa-facebook-f text-gray-400 text-2xl"></i>
                </a>
                <!-- Twitter -->
                <a href="https://twitter.com" target="_blank" class="hover:text-primary">
                    <i class="fab fa-twitter text-gray-400 text-2xl"></i>
                </a>
                <!-- Instagram -->
                <a href="https://instagram.com" target="_blank" class="hover:text-primary">
                    <i class="fab fa-instagram text-gray-400 text-2xl"></i>
                </a>
            </div>
        </div>

        <!-- Footer Bottom -->
        <div class="mt-6 border-t border-gray-700 pt-4 text-center">
            <p class="text-sm">&copy; 2025 Pinned Up. All Rights Reserved.</p>
        </div>
    </div>
</footer>



<script>
    // Dark/Light Mode Toggle
    const themeToggle = document.getElementById('themeToggle');
    const themeIcon = document.getElementById('themeIcon');
    const hamburger = document.getElementById('hamburger');
    const mobileMenu = document.getElementById('mobileMenu');
    const root = document.documentElement;

    function toggleTheme() {
        const isDark = root.classList.toggle('dark');
        localStorage.setItem('theme', isDark ? 'dark' : 'light');
        themeIcon.className = isDark ? 'fas fa-moon' : 'fas fa-sun';
    }

    // Toggle mobile menu visibility
    hamburger.addEventListener('click', () => {
        mobileMenu.classList.toggle('hidden');
    });

    // Load theme from localStorage
    document.addEventListener('DOMContentLoaded', () => {
        const savedTheme = localStorage.getItem('theme');
        if (savedTheme === 'dark') {
            root.classList.add('dark');
            themeIcon.className = 'fas fa-moon';
        }
    });
</script>
</body>
</html>
