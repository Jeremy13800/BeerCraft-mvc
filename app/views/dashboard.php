<div class="min-h-screen bg-gradient-to-br from-amber-100 via-yellow-50 to-orange-50 py-12 relative">
    <!-- Éléments décoratifs -->
    <div class="absolute inset-0 overflow-hidden opacity-10">
        <?php for ($i = 0; $i < 15; $i++): ?>
            <div class="absolute animate-float-slow"
                style="left: <?= rand(0, 100) ?>%; top: <?= rand(0, 100) ?>%; animation-delay: <?= rand(0, 5000) ?>ms">
                <?= ['🍺', '🌾', '🍻'][rand(0, 2)] ?>
            </div>
        <?php endfor; ?>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- En-tête -->
        <div class="bg-white/80 backdrop-blur-md rounded-xl p-8 shadow-xl mb-8">
            <h1 class="text-3xl font-bold text-amber-900 mb-4">
                Bienvenue <?= htmlspecialchars($_SESSION['user']['first_name']) ?> !
            </h1>
            <p class="text-amber-800">Voici votre espace personnel BeerCraft.</p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white/80 backdrop-blur-md rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <span class="text-4xl mr-4">🍺</span>
                    <div>
                        <h3 class="text-lg font-semibold text-amber-900">Mes Bières</h3>
                        <p class="text-2xl font-bold text-amber-600"><?= $userStats['beer_count'] ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <span class="text-4xl mr-4">💭</span>
                    <div>
                        <h3 class="text-lg font-semibold text-amber-900">Mes Commentaires</h3>
                        <p class="text-2xl font-bold text-amber-600"><?= $userStats['comment_count'] ?></p>
                    </div>
                </div>
            </div>

            <div class="bg-white/80 backdrop-blur-md rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                <div class="flex items-center">
                    <span class="text-4xl mr-4">⭐</span>
                    <div>
                        <h3 class="text-lg font-semibold text-amber-900">Note moyenne</h3>
                        <p class="text-2xl font-bold text-amber-600">
                            <?= $userStats['average_rating'] > 0 ? $userStats['average_rating'] . '/5' : '-' ?>
                        </p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions rapides -->
        <div class="flex gap-4 justify-center">
            <a href="index.php?action=add_beer"
                class="inline-flex items-center px-6 py-3 bg-amber-500 text-white rounded-lg
                      hover:bg-amber-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <span class="mr-2">Ajouter une bière</span>
                <span>🍺</span>
            </a>
            <a href="index.php?action=logout"
                class="inline-flex items-center px-6 py-3 border-2 border-amber-500 text-amber-700 rounded-lg
                      hover:bg-amber-500 hover:text-white transition-all duration-300">
                <span class="mr-2">Déconnexion</span>
                <span>👋</span>
            </a>
        </div>
    </div>
</div>

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