<?php
// define('ROOT_DIR', $_SERVER['DOCUMENT_ROOT'] . '/beercraft/');
// var_dump(ROOT_DIR);
?>

<div class="minecraft-background min-h-screen py-12 relative">
    <!-- Particules flottantes style Minecraft -->
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

    <div class="container mx-auto px-4 relative z-10">
        <!-- En-tête Minecraft -->
        <div class="text-center mb-12">
            <h1 class="minecraft-title text-5xl text-yellow-300 mb-4">
                Collection de Bières
            </h1>
            <p class="minecraft-text text-xl text-yellow-200">
                Choisissez votre breuvage, aventurier !
            </p>
        </div>

        <!-- Grille des bières -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            <?php foreach ($beers as $beer): ?>
                <div class="minecraft-card group">
                    <!-- Carte avec bordure style Minecraft -->
                    <div class="pixel-border bg-[#2b1508] relative">
                        <!-- Image avec style Minecraft -->
                        <div class="relative aspect-square minecraft-image-container">
                            <?php if (!empty($beer['image'])): ?>
                                <img src="<?= $beer['image'] ?>"
                                    alt="<?= htmlspecialchars($beer['name']) ?>"
                                    class="w-full h-full object-cover minecraft-pixelate"
                                    loading="lazy">
                            <?php else: ?>
                                <div class="w-full h-full bg-[#8B4513] minecraft-pattern flex items-center justify-center">
                                    <div class="minecraft-item-frame">
                                        <span class="text-8xl transform group-hover:scale-110 transition-transform">🍺</span>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <!-- Overlay style Minecraft -->
                            <div class="minecraft-overlay"></div>
                        </div>

                        <!-- Contenu -->
                        <div class="p-6 space-y-4">
                            <h2 class="minecraft-title text-2xl text-yellow-300 leading-tight">
                                <?= htmlspecialchars($beer['name']) ?>
                            </h2>

                            <!-- Stats avec style Minecraft UI -->
                            <div class="grid grid-cols-2 gap-3">
                                <div class="minecraft-stat-box">
                                    <span class="minecraft-icon">🌍</span>
                                    <?= htmlspecialchars($beer['origin']) ?>
                                </div>
                                <div class="minecraft-stat-box">
                                    <span class="minecraft-icon">⚔️</span>
                                    <?= htmlspecialchars($beer['alcohol']) ?>%
                                </div>
                            </div>

                            <p class="minecraft-text text-gray-300 line-clamp-3">
                                <?= htmlspecialchars($beer['description']) ?>
                            </p>

                            <a href="index.php?action=beer_detail&id=<?= $beer['id'] ?>"
                                class="minecraft-button-3d block text-center">
                                <span class="block translate-y-[-1px] group-hover:translate-y-[-2px] transition-transform">
                                    Examiner cette bière
                                </span>
                            </a>

                            <!-- Options Admin -->
                            <?php if (isset($_SESSION['user']) && $_SESSION['user']['role'] === 'admin'): ?>
                                <div class="flex gap-2 mt-4">
                                    <a href="index.php?action=edit_beer&id=<?= $beer['id'] ?>"
                                        class="minecraft-button-3d bg-emerald-700">
                                        <span class="block">✏️ Modifier</span>
                                    </a>
                                    <a href="index.php?action=delete_beer&id=<?= $beer['id'] ?>"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette bière ?')"
                                        class="minecraft-button-3d bg-red-700">
                                        <span class="block">🗑️ Supprimer</span>
                                    </a>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>

<style>
    .minecraft-background {
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Cpath fill='%23422006' fill-opacity='0.4' d='M0 0h8v8H0V0zm8 8h8v8H8V8zm16-8h8v8h-8V0zm8 8h8v8h-8V8zm-8 0h8v8h-8V8zM8 16h8v8H8v-8zm16 0h8v8h-8v-8zM0 16h8v8H0v-8zM24 0h8v8h-8V0z'/%3E%3C/svg%3E");
        background-color: #2b1508;
    }

    .minecraft-card {
        transform-style: preserve-3d;
        transition: transform 0.3s;
    }

    .minecraft-card:hover {
        transform: translateY(-4px);
    }

    .pixel-border {
        border: 4px solid;
        border-color: #594131 #2b1508 #2b1508 #594131;
        image-rendering: pixelated;
    }

    .minecraft-image-container::before {
        content: '';
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg, rgba(0, 0, 0, 0.2) 0%, transparent 100%);
        z-index: 1;
    }

    .minecraft-pixelate {
        image-rendering: pixelated;
        filter: contrast(1.1) saturate(1.2);
    }

    .minecraft-pattern {
        background-image: url("data:image/svg+xml,%3Csvg width='20' height='20' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='20' height='20' fill='%23713f12' /%3E%3Cpath d='M0 0h10v10H0V0zm10 10h10v10H10V10z' fill='%238B4513' fill-opacity='.4'/%3E%3C/svg%3E");
        background-size: 16px 16px;
    }

    .minecraft-item-frame {
        border: 4px solid #4a3422;
        padding: 1rem;
        background: rgba(0, 0, 0, 0.2);
        box-shadow: inset 0 0 0 4px rgba(255, 255, 255, 0.1);
    }

    .minecraft-stat-box {
        @apply flex items-center gap-2 px-3 py-2 rounded;
        background-color: rgba(0, 0, 0, 0.2);
        border: 2px solid;
        border-color: #594131 #2b1508 #2b1508 #594131;
        color: #fcd34d;
        font-family: 'Minecraft', system-ui;
    }

    .minecraft-button-3d {
        background: linear-gradient(to bottom, #8B4513, #713f12);
        border: 2px solid #2b1508;
        padding: 0.75rem;
        color: #fcd34d;
        font-family: 'Minecraft', system-ui;
        text-transform: uppercase;
        position: relative;
        text-shadow: 2px 2px #000;
        box-shadow:
            inset -2px -4px #2b1508,
            inset 2px 2px rgba(255, 255, 255, 0.2);
    }

    .minecraft-button-3d:hover {
        background: linear-gradient(to bottom, #9B5523, #814f22);
    }

    .minecraft-button-3d:active {
        box-shadow:
            inset 2px 4px #2b1508,
            inset -2px -2px rgba(255, 255, 255, 0.2);
    }

    .pixel-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(45deg,
                rgba(43, 21, 8, 0.7) 0%,
                transparent 40%,
                transparent 60%,
                rgba(43, 21, 8, 0.7) 100%);
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

    .minecraft-stat {
        @apply flex items-center gap-2 px-3 py-2 bg-[#1a0f05] rounded;
        border: 2px solid;
        border-color: #594131 #2b1508 #2b1508 #594131;
        color: #fcd34d;
    }

    .minecraft-button {
        @apply px-4 py-3 text-yellow-300 font-bold uppercase tracking-wide;
        background-color: #594131;
        border: 3px solid;
        border-color: #7c5a43 #2b1508 #2b1508 #7c5a43;
        text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.8);
        transition: all 0.1s;
    }

    .minecraft-button:hover {
        background-color: #7c5a43;
        transform: translateY(-2px);
    }

    .minecraft-button:active {
        transform: translateY(2px);
    }

    .pixelated {
        image-rendering: pixelated;
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