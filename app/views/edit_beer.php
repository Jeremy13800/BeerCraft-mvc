<div class="min-h-screen minecraft-background py-12 relative overflow-hidden">
    <!-- Particules flottantes -->
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

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-4xl relative">
        <!-- En-tête stylisé -->
        <div class="text-center mb-12">
            <h1 class="minecraft-title text-5xl text-yellow-300 mb-4">
                Modifier la Bière
            </h1>
            <p class="minecraft-text text-xl text-yellow-200">
                Affinez votre recette magique, aventurier !
            </p>
        </div>

        <!-- Messages d'erreur
        <?php if (!empty($errors)): ?>
            <div class="mb-8 bg-red-50 border-2 border-red-200 p-6 rounded-lg shadow-lg animate-shake">
                <p>ERROR</p>
            </div>
        <?php endif; ?> -->

        <!-- Formulaire de modification -->
        <form action="index.php?action=edit_beer&id=<?= $beer['id'] ?>" method="POST" enctype="multipart/form-data"
            class="space-y-8 bg-white/80 backdrop-blur-sm p-8 rounded-xl shadow-xl">

            <!-- Section: Informations de base -->
            <div class="grid md:grid-cols-2 gap-6">
                <!-- Nom -->
                <div class="space-y-2 group">
                    <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                        <span class="inline-block mr-2">🏷️</span> Nom de la bière
                    </label>
                    <input type="text" name="name"
                        class="form-input block w-full rounded-lg border-2 border-amber-200 focus:border-amber-400 focus:ring focus:ring-amber-200 transition-all duration-200"
                        value="<?= htmlspecialchars($beer['name']) ?>">
                </div>

                <!-- Origine -->
                <div class="space-y-2 group">
                    <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                        <span class="inline-block mr-2">🌍</span> Origine
                    </label>
                    <input type="text" name="origin"
                        class="form-input block w-full rounded-lg border-2 border-amber-200 focus:border-amber-400 focus:ring focus:ring-amber-200 transition-all duration-200"
                        value="<?= htmlspecialchars($beer['origin']) ?>">
                </div>
            </div>

            <!-- Degré d'alcool -->
            <div class="space-y-2 group">
                <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                    <span class="inline-block mr-2">🌡️</span> Degré d'alcool
                </label>
                <div class="relative">
                    <input type="number" name="alcohol" step="0.1"
                        class="form-input block w-full rounded-lg border-2 border-amber-200 focus:border-amber-400 focus:ring focus:ring-amber-200 transition-all duration-200 pr-12"
                        value="<?= htmlspecialchars($beer['alcohol']) ?>">
                    <span class="absolute right-4 top-1/2 transform -translate-y-1/2 text-amber-600 font-bold">%</span>
                </div>
            </div>

            <!-- Description -->
            <div class="space-y-2 group">
                <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                    <span class="inline-block mr-2">📝</span> Description
                </label>
                <textarea name="description" rows="4"
                    class="form-textarea block w-full rounded-lg border-2 border-amber-200 focus:border-amber-400 focus:ring focus:ring-amber-200 transition-all duration-200 resize-y"><?= htmlspecialchars($beer['description']) ?></textarea>
            </div>

            <!-- Image -->
            <div class="space-y-4">
                <div class="space-y-2 group">
                    <label class="block text-lg font-semibold text-amber-900 group-hover:text-amber-700 transition-colors">
                        <span class="inline-block mr-2">🖼️</span> Image de la bière
                    </label>

                    <!-- Affichage de l'image actuelle -->
                    <?php if (!empty($beer['image'])): ?>
                        <div class="mb-4">
                            <p class="text-sm text-amber-700 mb-2">Image actuelle :</p>
                            <img src="<?= htmlspecialchars($beer['image']) ?>"
                                alt="Image actuelle"
                                class="w-40 h-40 object-cover rounded-lg border-2 border-amber-200">
                        </div>
                    <?php endif; ?>

                    <input type="file"
                        name="image"
                        accept="image/jpeg,image/png,image/webp"
                        class="block w-full text-amber-700
                                  file:mr-4 file:py-2 file:px-4
                                  file:rounded-full file:border-0
                                  file:text-amber-700 file:font-semibold
                                  file:bg-amber-100 file:cursor-pointer
                                  hover:file:bg-amber-200
                                  cursor-pointer">
                    <p class="text-sm text-amber-600 mt-2">
                        Formats acceptés : JPG, PNG, WEBP (max 5MB)
                    </p>
                </div>
            </div>

            <!-- Boutons d'action -->
            <div class="flex justify-end gap-4 pt-6">
                <a href="index.php"
                    class="px-6 py-3 rounded-lg border-2 border-amber-500 text-amber-700 hover:bg-amber-50 transition-colors duration-200">
                    Annuler
                </a>
                <button type="submit"
                    class="px-8 py-3 bg-gradient-to-r from-amber-500 to-amber-600 text-white rounded-lg
                               hover:from-amber-600 hover:to-amber-700
                               transform hover:scale-105 active:scale-100
                               transition-all duration-200">
                    Sauvegarder les modifications
                </button>

            </div>
        </form>
    </div>
</div>

<style>
    .minecraft-background {
        background-color: #2b1508;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Cpath fill='%23422006' fill-opacity='0.4' d='M0 0h8v8H0V0zm8 8h8v8H8V8zm16-8h8v8h-8V0zm8 8h8v8h-8V8zm-8 0h8v8h-8V8zM8 16h8v8H8v-8zm16 0h8v8h-8v-8zM0 16h8v8H0v-8zM24 0h8v8h-8V0z'/%3E%3C/svg%3E");
    }

    .minecraft-title {
        font-family: 'Press Start 2P', system-ui;
        text-shadow: 2px 2px 0 #000,
            -2px -2px 0 #000,
            2px -2px 0 #000,
            -2px 2px 0 #000,
            0 3px #000;
        letter-spacing: 2px;
    }

    .minecraft-text {
        font-family: 'Minecraft', system-ui;
        text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.8);
    }

    .minecraft-enchanting-table {
        @apply rounded-lg overflow-hidden;
        border: 4px solid;
        border-color: #594131 #2b1508 #2b1508 #594131;
        box-shadow: 0 0 20px rgba(255, 215, 0, 0.1);
    }

    .minecraft-enchanted-text {
        @apply font-bold text-yellow-300;
        font-family: 'Minecraft', system-ui;
        text-shadow: 2px 2px #2b1508,
            -2px -2px #2b1508,
            2px -2px #2b1508,
            -2px 2px #2b1508,
            0 0 15px rgba(255, 255, 128, 0.5);
        animation: enchant 2s ease-in-out infinite;
    }

    .crafting-slot {
        @apply bg-[#1a0f05]/90 p-4 rounded;
        border: 3px solid;
        border-color: #594131 #2b1508 #2b1508 #594131;
    }

    .slot-label {
        @apply block text-yellow-200 mb-2 flex items-center gap-2;
        font-family: 'Minecraft', system-ui;
        text-shadow: 2px 2px rgba(0, 0, 0, 0.5);
    }

    .minecraft-input,
    .minecraft-textarea {
        @apply w-full rounded bg-[#2b1508]/80;
        border: 3px solid;
        border-color: #594131 #2b1508 #2b1508 #594131;
        color: #fcd34d;
        font-family: 'Minecraft', system-ui;
        box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .minecraft-button {
        @apply rounded font-bold text-center transition-all duration-300;
        font-family: 'Minecraft', system-ui;
        border: 4px solid;
        text-shadow: 2px 2px rgba(0, 0, 0, 0.5);
        min-width: 200px;
    }

    .minecraft-button.confirm {
        @apply bg-[#2b1508] text-yellow-300;
        border-color: #594131 #2b1508 #2b1508 #594131;
        box-shadow: inset 0 0 15px rgba(255, 215, 0, 0.2);
    }

    .minecraft-button.cancel {
        @apply bg-[#8B0000] text-red-200;
        border-color: #a52a2a #4a0404 #4a0404 #a52a2a;
    }

    .minecraft-button:hover {
        @apply transform -translate-y-1;
        filter: brightness(1.2);
    }

    .minecraft-button:active {
        @apply transform translate-y-0;
    }

    @keyframes enchant {

        0%,
        100% {
            text-shadow: 2px 2px #2b1508,
                -2px -2px #2b1508,
                2px -2px #2b1508,
                -2px 2px #2b1508,
                0 0 15px rgba(255, 255, 128, 0.5);
        }

        50% {
            text-shadow: 2px 2px #2b1508,
                -2px -2px #2b1508,
                2px -2px #2b1508,
                -2px 2px #2b1508,
                0 0 25px rgba(255, 255, 128, 0.8);
        }
    }

    @keyframes pixel-float {

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

    .pixel-float {
        animation: pixel-float 3s ease-in-out infinite;
        font-size: 1.5rem;
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
    });
</script>