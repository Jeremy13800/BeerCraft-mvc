<!-- views/add_beer.php -->

<div class="min-h-screen bg-gradient-to-br from-amber-100 via-yellow-50 to-orange-50 py-12 relative overflow-hidden">
    <!-- Éléments décoratifs d'arrière-plan -->
    <div class="absolute inset-0 overflow-hidden opacity-10">
        <?php for ($i = 0; $i < 20; $i++): ?>
            <div class="absolute animate-float"
                style="left: <?= rand(0, 100) ?>%; top: <?= rand(0, 100) ?>%; animation-delay: <?= rand(0, 5000) ?>ms">
                🍺
            </div>
        <?php endfor; ?>
    </div>

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl relative">
        <!-- En-tête stylisé -->
        <div class="text-center mb-12 transform hover:scale-105 transition-transform duration-300">
            <h1 class="text-5xl font-extrabold text-amber-900 mb-4 relative inline-block">
                <span class="relative z-10">🍺 Nouvelle Bière</span>
                <div class="absolute inset-x-0 bottom-0 h-3 bg-yellow-300 transform -skew-x-12"></div>
            </h1>
            <p class="text-amber-800 text-xl mt-4 font-medium">Partagez votre découverte houblonnée</p>
        </div>

        <!-- Messages d'erreur améliorés -->
        <?php if (!empty($errors)): ?>
            <div class="mb-8 bg-red-50 border-2 border-red-200 p-6 rounded-lg shadow-lg animate-shake">
                <div class="flex items-center">
                    <svg class="h-8 w-8 text-red-400 mr-4" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" />
                    </svg>
                    <div>
                        <h3 class="text-lg font-bold text-red-800">Oups ! Quelques ajustements nécessaires :</h3>
                        <ul class="mt-2 text-red-700 list-disc list-inside">
                            <?php foreach ($errors as $error): ?>
                                <li><?= $error ?></li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </div>
        <?php endif; ?>

        <!-- Formulaire stylisé -->
        <form action="index.php?action=add_beer" method="POST"
            class="bg-white/80 backdrop-blur-md shadow-2xl rounded-xl p-8 space-y-8 border-t border-white/60">

            <!-- Grille 2 colonnes pour les champs courts -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Nom de la bière -->
                <div class="space-y-2 group">
                    <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                        <span class="inline-block mr-2">🏷️</span> Nom de la bière
                    </label>
                    <input type="text" name="name" required
                        class="form-input block w-full rounded-lg border-2 border-amber-200 focus:border-amber-400 focus:ring focus:ring-amber-200 transition-all duration-200 bg-white/50 backdrop-blur"
                        value="<?= $formData['name'] ?? '' ?>"
                        placeholder="Ex: La Triple Mystérieuse">
                </div>

                <!-- Origine -->
                <div class="space-y-2 group">
                    <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                        <span class="inline-block mr-2">🌍</span> Origine
                    </label>
                    <input type="text" name="origin" required
                        class="form-input block w-full rounded-lg border-2 border-amber-200 focus:border-amber-400 focus:ring focus:ring-amber-200 transition-all duration-200 bg-white/50 backdrop-blur"
                        value="<?= $formData['origin'] ?? '' ?>"
                        placeholder="Ex: Belgique">
                </div>
            </div>

            <!-- Degré d'alcool -->
            <div class="space-y-2 group">
                <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                    <span class="inline-block mr-2">🌡️</span> Degré d'alcool
                </label>
                <div class="relative">
                    <input type="number" name="alcohol" step="0.1" required
                        class="form-input block w-full rounded-lg border-2 border-amber-200 focus:border-amber-400 focus:ring focus:ring-amber-200 transition-all duration-200 bg-white/50 backdrop-blur pr-12"
                        value="<?= $formData['alcohol'] ?? '' ?>"
                        placeholder="8.5">
                    <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-amber-600 font-bold">%</span>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2 group">
                <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                    <span class="inline-block mr-2">📝</span> Description
                </label>
                <textarea name="description" required rows="4"
                    class="form-textarea block w-full rounded-lg border-2 border-amber-200 focus:border-amber-400 focus:ring focus:ring-amber-200 transition-all duration-200 bg-white/50 backdrop-blur resize-y"
                    placeholder="Décrivez les arômes, la texture, le goût..."><?= $formData['description'] ?? '' ?></textarea>
            </div>

            <!-- Image de la bière -->
            <div class="space-y-2 group">
                <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                    <span class="inline-block mr-2">📸</span> Photo de la bière
                </label>
                <div class="flex items-center space-x-4">
                    <label class="flex-1 cursor-pointer">
                        <div class="relative group">
                            <input type="file" name="image" accept="image/*"
                                class="hidden"
                                onchange="updateImagePreview(this)">
                            <div class="w-full px-4 py-3 rounded-lg border-2 border-dashed border-amber-200 
                                      hover:border-amber-400 focus:border-amber-400 
                                      transition-all duration-200 bg-white/50 backdrop-blur
                                      flex items-center justify-center">
                                <span id="fileName" class="text-amber-800">Choisir une image</span>
                            </div>
                        </div>
                    </label>
                    <!-- Prévisualisation de l'image -->
                    <div id="imagePreview" class="hidden w-16 h-16 rounded-lg overflow-hidden bg-amber-100">
                        <img src="" alt="Prévisualisation" class="w-full h-full object-cover">
                    </div>
                </div>
                <p class="text-sm text-amber-700 mt-1">Formats acceptés : JPG, PNG, GIF (max 5MB)</p>
            </div>

            <script>
                function updateImagePreview(input) {
                    const preview = document.getElementById('imagePreview');
                    const fileName = document.getElementById('fileName');
                    const img = preview.querySelector('img');

                    if (input.files && input.files[0]) {
                        const reader = new FileReader();

                        reader.onload = function(e) {
                            img.src = e.target.result;
                            preview.classList.remove('hidden');
                            fileName.textContent = input.files[0].name;

                        }

                        reader.readAsDataURL(input.files[0]);
                    } else {
                        preview.classList.add('hidden');
                        fileName.textContent = 'Choisir une image';
                    }
                }
            </script>

            <!-- Bouton de soumission -->
            <div class="pt-6">
                <button type="submit"
                    class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 text-white text-xl font-bold py-4 px-8 rounded-xl
                           hover:from-amber-600 hover:to-yellow-600 
                           transform hover:scale-[1.02] active:scale-[0.98] 
                           transition-all duration-200 
                           focus:outline-none focus:ring-2 focus:ring-amber-500 focus:ring-offset-2
                           shadow-lg hover:shadow-xl
                           relative overflow-hidden group">
                    <span class="relative z-10 flex items-center justify-center">
                        <span class="mr-2">Ajouter cette bière</span>
                        <span class="text-2xl">🍺</span>
                    </span>
                    <div class="absolute inset-0 bg-gradient-to-r from-yellow-400 to-amber-400 transform scale-x-0 group-hover:scale-x-100 transition-transform origin-left"></div>
                </button>
            </div>
        </form>

        <!-- Lien de retour stylisé -->
        <div class="mt-8 text-center">
            <a href="index.php"
                class="inline-flex items-center text-amber-800 hover:text-amber-600 font-medium text-lg transition-colors duration-200">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Retour à la cave
            </a>
        </div>
    </div>
</div>

<style>
    @keyframes float {

        0%,
        100% {
            transform: translateY(0) rotate(0);
        }

        50% {
            transform: translateY(-20px) rotate(10deg);
        }
    }

    .animate-float {
        animation: float 6s ease-in-out infinite;
        font-size: 2rem;
    }

    @keyframes shake {

        0%,
        100% {
            transform: translateX(0);
        }

        25% {
            transform: translateX(-10px);
        }

        75% {
            transform: translateX(10px);
        }
    }

    .animate-shake {
        animation: shake 0.5s ease-in-out;
    }
</style>

<script>
    document.querySelectorAll('input, textarea').forEach(input => {
        input.addEventListener('focus', () => {
            input.closest('.group').classList.add('scale-105');
            input.classList.add('shadow-lg');
        });

        input.addEventListener('blur', () => {
            input.closest('.group').classList.remove('scale-105');
            input.classList.remove('shadow-lg');
        });

        // Animation de remplissage
        input.addEventListener('input', function() {
            if (this.value) {
                this.classList.add('bg-white/80');
            } else {
                this.classList.remove('bg-white/80');
            }
        });
    });
</script>