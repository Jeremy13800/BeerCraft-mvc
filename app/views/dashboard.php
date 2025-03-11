<div class="min-h-screen minecraft-background py-12 relative">
    <!-- Éléments décoratifs -->
    <div class="absolute inset-0 overflow-hidden pointer-events-none">
        <?php
        $pixels = ['⬜', '🟫', '🟨'];
        for ($i = 0; $i < 150; $i++): ?>
            <div class="absolute pixel-float"
                style="left: <?= rand(0, 100) ?>%; 
                       top: <?= rand(-20, 120) ?>%; 
                       animation-delay: <?= rand(0, 3000) ?>ms;
                       opacity: <?= rand(2, 5) / 10 ?>;">
                <?= $pixels[array_rand($pixels)] ?>
            </div>
        <?php endfor; ?>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 relative z-10">
        <!-- En-tête -->
        <div class="bg-white/80 backdrop-blur-md rounded-xl p-8 shadow-xl mb-8">
            <h1 class="text-3xl font-bold text-amber-900 mb-4">
                Bienvenue <?= htmlspecialchars($_SESSION['user']['first_name'] . ' ' . $_SESSION['user']['last_name']) ?> !
            </h1>
            <h2 class="text-2xl font-bold text-amber-700 mb-4">Vous êtes connecté en tant que <?= $_SESSION['user']['role'] === 'member' ? 'Membre' : 'Administrateur' ?></h2>
            <p class="text-amber-800">Voici votre espace personnel BeerCraft.</p>
        </div>

        <!-- Statistiques -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
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

            <!-- Activité récente si l'utilisateur est admin -->
            <?php if ($_SESSION['user']['role'] === 'admin'): ?>
                <div class="bg-white/80 backdrop-blur-md rounded-xl p-6 shadow-lg hover:shadow-xl transition-shadow">
                    <div class="flex items-center">
                        <span class="text-4xl mr-4">⚡</span>
                        <div>
                            <h3 class="text-lg font-semibold text-amber-900">Status</h3>
                            <p class="text-2xl font-bold text-amber-600">Administrateur</p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <!-- Derniers commentaires -->
        <?php if (!empty($userStats['recent_comments'])): ?>
            <div class="bg-white/80 backdrop-blur-md rounded-xl p-6 shadow-lg mt-8">
                <h3 class="text-xl font-bold text-amber-900 mb-4">Mes derniers avis</h3>
                <div class="space-y-4">
                    <?php foreach ($userStats['recent_comments'] as $comment): ?>
                        <div class="flex items-start justify-between p-4 bg-white/50 rounded-lg">
                            <div>
                                <h4 class="font-medium text-amber-900"><?= htmlspecialchars($comment['beer_name']) ?></h4>
                                <p class="text-amber-700"><?= htmlspecialchars($comment['content']) ?></p>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class="text-amber-600"><?= str_repeat('🍺', $comment['rating']) ?></span>
                                <span class="text-sm text-amber-500"><?= date('d/m/Y', strtotime($comment['created_at'])) ?></span>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
        <?php endif; ?>
        <!-- Actions rapides -->
        <div class="flex gap-4 justify-center mt-8">
            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                <a href="index.php?action=add_beer"
                    class="inline-flex items-center px-6 py-3 bg-amber-500 text-white rounded-lg
                          hover:bg-amber-600 transition-all duration-300 shadow-md hover:shadow-lg">
                    <span class="mr-2">Ajouter une bière</span>
                    <span>🍺</span>
                </a>
            <?php endif; ?>
            <a href="index.php?action=logout"
                class="inline-flex items-center px-6 py-3 bg-amber-500 text-white rounded-lg
            hover:bg-amber-600 transition-all duration-300 shadow-md hover:shadow-lg">
                <span class="mr-2">Déconnexion</span>
                <span>👋</span>
            </a>
        </div>
    </div>
</div>

<style>
    .minecraft-background {
        background-color: #2b1508;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Cpath fill='%23422006' fill-opacity='0.4' d='M0 0h8v8H0V0zm8 8h8v8H8V8zm16-8h8v8h-8V0zm8 8h8v8h-8V8zm-8 0h8v8h-8V8zM8 16h8v8H8v-8zm16 0h8v8h-8v-8zM0 16h8v8H0v-8zM24 0h8v8h-8V0z'/%3E%3C/svg%3E");
    }

    @keyframes pixel-float {

        0%,
        100% {
            transform: translate(0, 0) rotate(0deg);
        }

        50% {
            transform: translate(-5px, -10px) rotate(5deg);
        }
    }

    .pixel-float {
        animation: pixel-float 3s ease-in-out infinite;
        font-size: 1.5rem;
    }
</style>