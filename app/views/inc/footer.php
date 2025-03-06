<!-- views/inc/footer.php -->
<footer class="bg-gray-900 text-white relative overflow-hidden">
    <!-- Éléments décoratifs -->
    <div class="absolute inset-0 opacity-5">
        <?php for ($i = 0; $i < 12; $i++): ?>
            <div class="absolute animate-float-slow"
                style="left: <?= rand(0, 100) ?>%; top: <?= rand(0, 100) ?>%; animation-delay: <?= rand(0, 3000) ?>ms">
                <?= ['🍺', '🌾', '🍻', '🪔'][rand(0, 3)] ?>
            </div>
        <?php endfor; ?>
    </div>

    <div class="container mx-auto px-4 py-12 relative z-10">
        <!-- Grille principale -->
        <div class="grid md:grid-cols-3 gap-12 mb-8">
            <!-- À propos -->
            <div class="space-y-4">
                <h3 class="text-2xl font-bold text-yellow-400 flex items-center">
                    <span class="mr-2">🍺</span> BeerCraft
                </h3>
                <p class="text-amber-100">
                    Votre destination pour découvrir et partager les meilleures bières artisanales du monde.
                </p>
            </div>

            <!-- Navigation rapide -->
            <div class="space-y-4">
                <h4 class="text-xl font-semibold text-yellow-400">Navigation</h4>
                <nav class="flex flex-col space-y-2">
                    <a href="index.php" class="text-amber-100 hover:text-yellow-400 transition-colors duration-200">
                        Accueil
                    </a>
                    <a href="index.php?action=add_beer" class="text-amber-100 hover:text-yellow-400 transition-colors duration-200">
                        Ajouter une bière
                    </a>
                    <a href="#" class="text-amber-100 hover:text-yellow-400 transition-colors duration-200">
                        À propos
                    </a>
                    <a href="#" class="text-amber-100 hover:text-yellow-400 transition-colors duration-200">
                        Contact
                    </a>
                </nav>
            </div>

            <!-- Contact -->
            <div class="space-y-4">
                <h4 class="text-xl font-semibold text-yellow-400">Contactez-nous</h4>
                <div class="space-y-2 text-amber-100">
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                            <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                        </svg>
                        contact@beercraft.com
                    </p>
                    <p class="flex items-center">
                        <svg class="w-5 h-5 mr-2" fill="currentColor" viewBox="0 0 20 20">
                            <path d="M2 3a1 1 0 011-1h2.153a1 1 0 01.986.836l.74 4.435a1 1 0 01-.54 1.06l-1.548.773a11.037 11.037 0 006.105 6.105l.774-1.548a1 1 0 011.059-.54l4.435.74a1 1 0 01.836.986V17a1 1 0 01-1 1h-2C7.82 18 2 12.18 2 5V3z" />
                        </svg>
                        +33 1 23 45 67 89
                    </p>
                </div>
            </div>
        </div>

        <!-- Séparateur -->
        <div class="h-px bg-gradient-to-r from-transparent via-amber-500 to-transparent my-8 opacity-30"></div>

        <!-- Copyright -->
        <div class="text-center text-amber-200/80 text-sm">
            <p>&copy; <?= date('Y') ?> BeerCraft. Tous droits réservés.
                <span class="text-amber-400">🍺</span>
                Buvez avec modération.
            </p>
        </div>
    </div>
</footer>

<style>
    @keyframes float-slow {

        0%,
        100% {
            transform: translateY(0) rotate(0);
            opacity: 0.7;
        }

        50% {
            transform: translateY(-15px) rotate(5deg);
            opacity: 0.3;
        }
    }

    .animate-float-slow {
        animation: float-slow 8s ease-in-out infinite;
        font-size: 1.5rem;
    }
</style>