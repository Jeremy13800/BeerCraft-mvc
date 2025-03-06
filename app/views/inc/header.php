<header class="bg-gray-900 text-white relative overflow-hidden">
    <!-- Éléments décoratifs -->
    <div class="absolute inset-0 opacity-5">
        <?php for ($i = 0; $i < 8; $i++): ?>
            <div class="absolute animate-float-slow"
                style="left: <?= rand(0, 100) ?>%; top: <?= rand(-20, 100) ?>%; animation-delay: <?= rand(0, 3000) ?>ms">
                <?= ['🍺', '🌾', '🍻'][rand(0, 2)] ?>
            </div>
        <?php endfor; ?>
    </div>

    <div class="container mx-auto px-4 py-4 relative z-10">
        <div class="flex justify-between items-center">
            <!-- Logo avec animation -->
            <a href="index.php" class="group flex items-center space-x-2 transform hover:scale-105 transition-all duration-300">
                <span class="text-3xl group-hover:rotate-12 transition-transform duration-300">🍺</span>
                <span class="text-2xl font-bold bg-gradient-to-r from-yellow-300 to-amber-300 text-transparent bg-clip-text">
                    BeerCraft
                </span>
            </a>

            <!-- Menu Desktop -->
            <nav class="hidden md:flex items-center space-x-4">
                <?php if (isset($_SESSION['user'])): ?>
                    <!-- Bouton Ajouter une Bière (visible uniquement si connecté) -->
                    <a href="index.php?action=add_beer"
                        class="bg-gradient-to-r from-yellow-500 to-amber-500 px-4 py-2 rounded-lg 
                              hover:from-yellow-600 hover:to-amber-600 transform hover:scale-105
                              transition-all duration-200 shadow-lg hover:shadow-xl">
                        <span class="flex items-center">
                            <span class="mr-2">Ajouter une Bière</span>
                            <span class="text-xl">🍺</span>
                        </span>
                    </a>

                    <!-- Menu utilisateur connecté -->
                    <a href="index.php?action=dashboard"
                        class="flex items-center px-4 py-2 border-2 border-yellow-400 rounded-lg
                              hover:bg-yellow-400 hover:text-gray-900
                              transition-all duration-200 group">
                        <span class="mr-2">👋</span>
                        <span><?= htmlspecialchars($_SESSION['user']['first_name']) ?></span>
                    </a>

                    <!-- Bouton Déconnexion -->
                    <a href="index.php?action=logout"
                        class="flex items-center px-4 py-2 border-2 border-red-400 rounded-lg
                              hover:bg-red-400 hover:text-white
                              transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        <span>Déconnexion</span>
                    </a>
                <?php else: ?>
                    <!-- Boutons pour utilisateur non connecté -->
                    <a href="index.php?action=register"
                        class="flex items-center px-4 py-2 border-2 border-yellow-400 rounded-lg
                              hover:bg-yellow-400 hover:text-gray-900
                              transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        <span>Inscription</span>
                    </a>

                    <!-- Bouton Connexion -->
                    <a href="index.php?action=login"
                        class="flex items-center px-4 py-2 border-2 border-amber-400 rounded-lg
                              hover:bg-amber-400 hover:text-gray-900
                              transition-all duration-200 group">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        <span>Connexion</span>
                    </a>
                <?php endif; ?>
            </nav>

            <!-- Bouton Menu Mobile -->
            <button id="menu-toggle" class="md:hidden p-2 rounded-lg hover:bg-amber-700 transition-colors duration-200">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                </svg>
            </button>
        </div>

        <!-- Menu Mobile -->
        <nav id="mobile-menu" class="hidden md:hidden mt-4 bg-amber-800/50 backdrop-blur-md rounded-lg overflow-hidden">
            <?php if (isset($_SESSION['user'])): ?>
                <a href="index.php?action=add_beer" class="mobile-nav-link bg-yellow-500/20 font-semibold">
                    <span class="flex items-center">Ajouter une Bière 🍺</span>
                </a>
                <a href="index.php?action=dashboard" class="mobile-nav-link border-t border-amber-700/50">
                    <span class="flex items-center">
                        <span class="mr-2">👋</span>
                        <?= htmlspecialchars($_SESSION['user']['first_name']) ?>
                    </span>
                </a>
                <a href="index.php?action=logout" class="mobile-nav-link border-t border-amber-700/50">
                    <span class="flex items-center text-red-300 hover:text-red-100">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                        Déconnexion
                    </span>
                </a>
            <?php else: ?>
                <a href="index.php?action=register" class="mobile-nav-link border-t border-amber-700/50">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                        </svg>
                        Inscription
                    </span>
                </a>
                <a href="index.php?action=login" class="mobile-nav-link border-t border-amber-700/50">
                    <span class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M11 16l-4-4m0 0l4-4m-4 4h14m-5 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h7a3 3 0 013 3v1" />
                        </svg>
                        Connexion
                    </span>
                </a>
            <?php endif; ?>
        </nav>
    </div>
</header>

<style>
    .mobile-nav-link {
        @apply block py-3 px-4 text-amber-100 hover:bg-amber-700/50 transition-all duration-200;
    }

    @keyframes float-slow {

        0%,
        100% {
            transform: translateY(0) rotate(0);
            opacity: 0.7;
        }
    }
</style>