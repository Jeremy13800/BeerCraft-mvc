<div class="relative min-h-screen bg-gradient-to-br from-amber-900 via-amber-800 to-amber-700">
    <!-- Effet de mousse animée -->
    <div class="absolute inset-0 overflow-hidden">
        <div class="foam-layer"></div>
        <div class="bubbles-layer"></div>
    </div>

    <div class="relative z-10 pt-8 pb-16 px-4">
        <!-- Navigation stylisée -->
        <div class="container mx-auto mb-8">
            <a href="index.php" class="inline-flex items-center gap-2 text-amber-100 hover:text-white group">
                <svg class="w-6 h-6 transition-transform group-hover:-translate-x-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                <span class="text-lg">Retour au bar</span>
            </a>
        </div>

        <!-- Carte principale de la bière -->
        <div class="container mx-auto max-w-7xl">
            <div class="bg-[rgba(255,255,255,0.95)] backdrop-blur-md rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.3)]">
                <div class="flex flex-col lg:flex-row">
                    <!-- Section image -->
                    <div class="lg:w-1/2 relative overflow-hidden">
                        <?php if (!empty($beer['image'])): ?>
                            <div class="aspect-square">
                                <img src="<?= $beer['image'] ?>"
                                    alt="<?= htmlspecialchars($beer['name']) ?>"
                                    class="w-full h-full object-cover transition-transform hover:scale-110 duration-700">
                            </div>
                        <?php else: ?>
                            <div class="aspect-square bg-gradient-to-br from-amber-300 to-amber-500 flex items-center justify-center">
                                <div class="beer-mug"></div>
                            </div>
                        <?php endif; ?>
                    </div>

                    <!-- Section informations -->
                    <div class="lg:w-1/2 p-8 lg:p-12 flex flex-col">
                        <div class="flex-1">
                            <h1 class="text-5xl font-bold text-amber-900 mb-6"><?= htmlspecialchars($beer['name']) ?></h1>

                            <!-- Stats de la bière -->
                            <div class="grid grid-cols-2 gap-6 mb-8">
                                <div class="stat-card">
                                    <span class="stat-icon">🌍</span>
                                    <span class="stat-value"><?= htmlspecialchars($beer['origin']) ?></span>
                                    <span class="stat-label">Origine</span>
                                </div>
                                <div class="stat-card">
                                    <span class="stat-icon">🍺</span>
                                    <span class="stat-value"><?= htmlspecialchars($beer['alcohol']) ?>%</span>
                                    <span class="stat-label">Alcool</span>
                                </div>
                                <?php if (isset($beer['average_price'])): ?>
                                    <div class="stat-card">
                                        <span class="stat-icon">💰</span>
                                        <span class="stat-value"><?= number_format($beer['average_price'], 2) ?>€</span>
                                        <span class="stat-label">Prix moyen</span>
                                    </div>
                                <?php endif; ?>
                                <?php if (!empty($comments)): ?>
                                    <div class="stat-card">
                                        <span class="stat-icon">⭐</span>
                                        <span class="stat-value"><?= number_format(array_sum(array_column($comments, 'rating')) / count($comments), 1) ?>/5</span>
                                        <span class="stat-label"><?= count($comments) ?> avis</span>
                                    </div>
                                <?php endif; ?>
                            </div>

                            <!-- Description -->
                            <div class="prose prose-lg prose-amber max-w-none mb-8">
                                <h2 class="text-2xl font-bold text-amber-800 mb-4">Description</h2>
                                <p class="text-amber-900 leading-relaxed">
                                    <?= htmlspecialchars($beer['description'] ?? 'Aucune description disponible.') ?>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Section commentaires avec style amélioré -->
            <div class="mt-12">
                <div class="bg-[rgba(255,255,255,0.95)] backdrop-blur-md rounded-3xl overflow-hidden shadow-[0_20px_50px_rgba(0,0,0,0.3)] p-8 lg:p-12">
                    <h2 class="text-3xl font-bold text-amber-900 mb-8 flex items-center gap-3">
                        Avis des connaisseurs
                        <span class="text-2xl">🍻</span>
                    </h2>

                    <?php if (isset($_SESSION['user'])): ?>
                        <!-- Formulaire d'avis stylé -->
                        <form action="index.php?action=add_comment" method="POST" class="mb-12">
                            <input type="hidden" name="beer_id" value="<?= $beer['id'] ?>">

                            <div class="mb-6">
                                <label class="block text-amber-800 mb-3 text-lg font-medium">Votre note</label>
                                <div class="flex gap-4 items-center">
                                    <?php for ($i = 1; $i <= 5; $i++): ?>
                                        <input type="radio" id="star<?= $i ?>" name="rating" value="<?= $i ?>" class="hidden peer" required>
                                        <label for="star<?= $i ?>"
                                            class="text-4xl cursor-pointer opacity-50 hover:opacity-100 transition-opacity duration-200 peer-checked:opacity-100">
                                            🍺
                                        </label>
                                    <?php endfor; ?>
                                </div>
                            </div>

                            <div class="mb-6">
                                <label class="block text-amber-800 mb-3 text-lg font-medium">Votre commentaire</label>
                                <textarea name="content" required rows="4"
                                    class="w-full rounded-xl border-amber-200 bg-white/50 backdrop-blur-sm
                                           focus:border-amber-500 focus:ring focus:ring-amber-200
                                           placeholder:text-amber-300 resize-none"
                                    placeholder="Partagez votre expérience avec cette bière..."></textarea>
                            </div>

                            <button type="submit"
                                class="w-full md:w-auto px-8 py-3 bg-gradient-to-r from-amber-500 to-amber-600 
                                       text-white rounded-xl font-medium shadow-lg
                                       hover:from-amber-600 hover:to-amber-700 
                                       transform hover:-translate-y-0.5 transition-all duration-200">
                                Partager mon avis
                            </button>
                        </form>
                    <?php else: ?>
                        <div class="bg-amber-50/50 rounded-xl p-8 text-center mb-12">
                            <p class="text-amber-800 mb-4 text-lg">Connectez-vous pour partager votre avis sur cette bière !</p>
                            <a href="index.php?action=login"
                                class="inline-block px-8 py-3 bg-amber-500 text-white rounded-xl font-medium
                                      hover:bg-amber-600 transform hover:-translate-y-0.5 transition-all duration-200">
                                Se connecter
                            </a>
                        </div>
                    <?php endif; ?>

                    <!-- Liste des commentaires -->
                    <?php if (!empty($comments)): ?>
                        <div class="grid md:grid-cols-2 gap-6">
                            <?php foreach ($comments as $comment): ?>
                                <div class="bg-white/70 backdrop-blur-sm rounded-xl p-6 shadow-lg 
                                            hover:shadow-xl transition-all duration-300 border border-amber-100">
                                    <div class="flex items-center justify-between mb-4">
                                        <div class="flex items-center gap-3">
                                            <div class="w-10 h-10 rounded-full bg-amber-500 flex items-center justify-center text-white font-bold">
                                                <?= strtoupper(substr($comment['first_name'], 0, 1)) ?>
                                            </div>
                                            <div>
                                                <div class="font-medium text-amber-900">
                                                    <?= htmlspecialchars($comment['first_name']) ?>
                                                </div>
                                                <div class="text-sm text-amber-600">
                                                    <?= date('d/m/Y', strtotime($comment['created_at'])) ?>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-4">
                                            <div class="flex gap-1">
                                                <?= str_repeat('🍺', $comment['rating']) ?>
                                            </div>
                                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['id'] == $comment['user_id']): ?>
                                                <div class="flex gap-2">
                                                    <button onclick="editComment(<?= htmlspecialchars(json_encode($comment)) ?>)"
                                                        class="text-amber-600 hover:text-amber-800 transition-colors">
                                                        <span class="sr-only">Modifier</span>
                                                        ✏️
                                                    </button>
                                                    <a href="index.php?action=delete_comment&comment_id=<?= $comment['id'] ?>&beer_id=<?= $beer['id'] ?>"
                                                        onclick="return confirm('Voulez-vous vraiment supprimer ce commentaire ?')"
                                                        class="text-red-600 hover:text-red-800 transition-colors">
                                                        <span class="sr-only">Supprimer</span>
                                                        🗑️
                                                    </a>
                                                </div>
                                            <?php endif; ?>
                                        </div>
                                    </div>
                                    <p class="text-amber-800 leading-relaxed">
                                        <?= htmlspecialchars($comment['content']) ?>
                                    </p>
                                </div>
                            <?php endforeach; ?>
                        </div>
                    <?php else: ?>
                        <p class="text-center text-amber-700 italic text-lg">
                            Soyez le premier à donner votre avis sur cette bière !
                        </p>
                    <?php endif; ?>

                    <!-- Modal de modification -->
                    <div id="editModal" class="fixed inset-0 bg-black bg-opacity-50 hidden items-center justify-center z-50">
                        <div class="bg-white rounded-xl p-6 w-full max-w-md mx-4">
                            <h3 class="text-xl font-bold text-amber-900 mb-4">Modifier mon commentaire</h3>
                            <form action="index.php?action=edit_comment" method="POST">
                                <input type="hidden" name="comment_id" id="editCommentId">
                                <input type="hidden" name="beer_id" value="<?= $beer['id'] ?>">

                                <div class="space-y-4">
                                    <div>
                                        <label class="block text-amber-800 mb-2">Note</label>
                                        <div class="flex gap-4">
                                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                                <input type="radio" id="editStar<?= $i ?>"
                                                    name="rating" value="<?= $i ?>"
                                                    class="hidden peer">
                                                <label for="editStar<?= $i ?>"
                                                    class="text-4xl cursor-pointer opacity-50 hover:opacity-100 
                                                           transition-opacity peer-checked:opacity-100">
                                                    🍺
                                                </label>
                                            <?php endfor; ?>
                                        </div>
                                    </div>
                                    <div>
                                        <label class="block text-amber-800 mb-2">Votre avis</label>
                                        <textarea name="content" id="editContent" rows="4" required
                                            class="w-full rounded-xl border-amber-200 focus:border-amber-400 
                                                   focus:ring focus:ring-amber-200"></textarea>
                                    </div>
                                    <div class="flex justify-end gap-2 mt-4">
                                        <button type="button" onclick="closeEditModal()"
                                            class="px-4 py-2 text-amber-700 hover:text-amber-800">
                                            Annuler
                                        </button>
                                        <button type="submit"
                                            class="px-6 py-2 bg-amber-500 text-white rounded-lg 
                                                   hover:bg-amber-600 transition-colors">
                                            Enregistrer
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <script>
                        function editComment(comment) {
                            document.getElementById('editCommentId').value = comment.id;
                            document.getElementById('editContent').value = comment.content;
                            document.querySelector(`input[name="rating"][value="${comment.rating}"]`).checked = true;
                            document.getElementById('editModal').classList.remove('hidden');
                            document.getElementById('editModal').classList.add('flex');
                        }

                        function closeEditModal() {
                            document.getElementById('editModal').classList.add('hidden');
                            document.getElementById('editModal').classList.remove('flex');
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .foam-layer {
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 100%;
        background:
            radial-gradient(circle at 50% 0%, rgba(255, 250, 240, 0.5) 0%, transparent 75%),
            repeating-linear-gradient(45deg,
                rgba(255, 250, 240, 0.12) 0%,
                rgba(255, 250, 240, 0.12) 2%,
                transparent 2%,
                transparent 4%);
    }

    .bubbles-layer {
        position: absolute;
        inset: 0;
        background-image: radial-gradient(circle at center, rgba(255, 255, 255, 0.1) 0%, transparent 50%);
        animation: bubble-rise 20s linear infinite;
    }

    .beer-mug {
        width: 200px;
        height: 200px;
        background: url('data:image/svg+xml,...') center/contain no-repeat;
        animation: tilt 2s ease-in-out infinite;
    }

    .stat-card {
        @apply bg-amber-50 rounded-xl p-4 flex flex-col items-center text-center;
    }

    .stat-icon {
        @apply text-3xl mb-2;
    }

    .stat-value {
        @apply text-xl font-bold text-amber-900;
    }

    .stat-label {
        @apply text-sm text-amber-600;
    }

    .review-button,
    .login-button {
        @apply w-full py-4 px-6 rounded-xl text-center font-semibold transition-all duration-300;
        @apply bg-gradient-to-r from-amber-500 to-amber-600 text-white;
        @apply hover:from-amber-600 hover:to-amber-700 hover:shadow-lg;
        @apply transform hover:-translate-y-1;
    }

    .review-card {
        @apply bg-white/90 backdrop-blur-sm rounded-xl p-6 shadow-lg;
        @apply hover:shadow-xl transition-all duration-300;
    }

    @keyframes bubble-rise {
        from {
            transform: translateY(100%) rotate(0deg);
        }

        to {
            transform: translateY(-100%) rotate(360deg);
        }
    }

    @keyframes tilt {

        0%,
        100% {
            transform: rotate(-5deg);
        }

        50% {
            transform: rotate(5deg);
        }
    }
</style>