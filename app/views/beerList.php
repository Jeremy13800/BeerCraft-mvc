<?php
// define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/beercraft/');
// var_dump(ROOT_DIR);
?>

<div class="min-h-screen bg-gradient-to-br from-amber-100 via-yellow-50 to-orange-50 py-12 relative">
    <!-- Éléments décoratifs d'arrière-plan -->
    <div class="absolute inset-0 overflow-hidden opacity-10">
        <?php for ($i = 0; $i < 15; $i++): ?>
            <div class="absolute animate-float-slow"
                style="left: <?= rand(0, 100) ?>%; top: <?= rand(-20, 100) ?>%; animation-delay: <?= rand(0, 3000) ?>ms">
                <?= ['🍺', '🌾', '🍻'][rand(0, 2)] ?>
            </div>
        <?php endfor; ?>
    </div>

    <div class="container mx-auto px-4 relative z-10">
        <!-- Message de succès -->
        <?php if (isset($_SESSION['success_message'])): ?>
            <div class="mb-8 bg-green-50 border-l-4 border-green-400 p-4 rounded-r shadow-sm transform transition-all duration-500">
                <div class="flex">
                    <div class="flex-shrink-0">
                        <svg class="h-5 w-5 text-green-400" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                        </svg>
                    </div>
                    <div class="ml-3">
                        <p class="text-sm text-green-700"><?= $_SESSION['success_message'] ?></p>
                    </div>
                </div>
            </div>
            <?php unset($_SESSION['success_message']); ?>
        <?php endif; ?>

        <!-- En-tête de la page -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-amber-900 mb-4 relative inline-block">
                <span class="relative z-10">Notre Collection de Bières</span>
                <div class="absolute inset-x-0 bottom-0 h-3 bg-yellow-300 transform -skew-x-12"></div>
            </h1>
            <p class="text-amber-800 text-xl">Découvrez notre sélection de bières artisanales</p>
        </div>

        <!-- Grille des bières -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($beers as $beer): ?>
                <div class="h-full transform hover:scale-[1.0] transition-all duration-300">
                    <div class="bg-white/80 backdrop-blur-md rounded-xl overflow-hidden shadow-xl border border-amber-100 h-full flex flex-col hover:shadow-2xl transition-shadow">
                        <?php if (!empty($beer['image'])): ?>
                            <img src="<?= 'uploads/chouffe.jpg' ?>"
                                alt="<?= htmlspecialchars($beer['name']); ?>"
                                class="w-full h-48 object-cover object-center">
                        <?php else: ?>
                            <div class="w-full h-48 bg-amber-100 flex items-center justify-center text-6xl">
                                🍺
                            </div>
                        <?php endif; ?>


                        <div class="p-6 flex flex-col flex-grow">
                            <h2 class="text-2xl font-bold text-amber-900 mb-2">
                                <?= htmlspecialchars($beer['name']); ?>
                            </h2>

                            <div class="space-y-2 mb-4">
                                <p class="flex items-center text-amber-800">
                                    <span class="mr-2">🌍</span>
                                    <span class="font-medium"><?= htmlspecialchars($beer['origin']); ?></span>
                                </p>
                                <p class="flex items-center text-amber-800">
                                    <span class="mr-2">🌡️</span>
                                    <span class="font-medium"><?= htmlspecialchars($beer['alcohol']); ?>%</span>
                                </p>
                            </div>

                            <p class="text-amber-700 mb-4 line-clamp-2 flex-grow">
                                <?= htmlspecialchars($beer['description'] ?? 'Aucune description disponible'); ?>
                            </p>

                            <a href="index.php?action=beer_detail&id=<?= $beer['id']; ?>"
                                class="inline-flex items-center justify-center w-full px-4 py-2 bg-gradient-to-r 
                                      from-amber-500 to-yellow-500 text-white rounded-lg
                                      hover:from-amber-600 hover:to-yellow-600 
                                      transition-all duration-300 shadow-md hover:shadow-lg
                                      font-medium mt-auto">
                                <span>Découvrir cette bière</span>
                                <span class="ml-2">→</span>
                            </a>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>

        <!-- Message si aucune bière -->
        <?php if (empty($beers)): ?>
            <div class="text-center py-12">
                <p class="text-2xl text-amber-800 mb-4">Aucune bière n'a encore été ajoutée.</p>
                <a href="index.php?action=add_beer"
                    class="inline-flex items-center px-6 py-3 bg-amber-500 text-white rounded-lg
                          hover:bg-amber-600 transition-all duration-300">
                    <span class="mr-2">Ajouter la première bière</span>
                    <span>🍺</span>
                </a>
            </div>
        <?php endif; ?>
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