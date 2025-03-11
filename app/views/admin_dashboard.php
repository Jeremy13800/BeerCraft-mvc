<div class="minecraft-background min-h-screen py-12 relative">
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
    <div class="container mx-auto px-4 relative z-10">
        <h1 class="minecraft-title text-4xl text-yellow-300 mb-8">Panel Administrateur</h1>

        <!-- Tabs de navigation -->
        <div class="flex gap-4 mb-8">
            <button onclick="switchTab('beers')"
                class="minecraft-tab active"
                id="beers-tab">
                🍺 Gestion des Bières
            </button>
            <button onclick="switchTab('comments')"
                class="minecraft-tab"
                id="comments-tab">
                💬 Modération Commentaires
            </button>
        </div>

        <!-- Section Bières -->
        <div id="beers-section" class="tab-content">
            <div class="minecraft-window bg-[#2b1508]/95 p-6 rounded-lg border-2">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b-2 border-amber-900">
                                <th class="text-yellow-200 p-3 text-left">Nom</th>
                                <th class="text-yellow-200 p-3 text-left">Origine</th>
                                <th class="text-yellow-200 p-3 text-left">Alcool</th>
                                <th class="text-yellow-200 p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($beers as $beer): ?>
                                <tr class="border-b border-amber-900/30 hover:bg-amber-900/20">
                                    <td class="p-3 text-yellow-200"><?= htmlspecialchars($beer['name']) ?></td>
                                    <td class="p-3 text-yellow-200"><?= htmlspecialchars($beer['origin']) ?></td>
                                    <td class="p-3 text-yellow-200"><?= htmlspecialchars($beer['alcohol']) ?>%</td>
                                    <td class="p-3">
                                        <div class="flex gap-2">
                                            <a href="index.php?action=edit_beer&id=<?= $beer['id'] ?>"
                                                class="minecraft-button-small edit">
                                                ✏️
                                            </a>
                                            <a href="index.php?action=delete_beer&id=<?= $beer['id'] ?>"
                                                onclick="return confirm('Confirmer la suppression ?')"
                                                class="minecraft-button-small delete">
                                                🗑️
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <!-- Section Commentaires -->
        <div id="comments-section" class="tab-content hidden">
            <div class="minecraft-window bg-[#2b1508]/95 p-6 rounded-lg border-2">
                <div class="overflow-x-auto">
                    <table class="min-w-full">
                        <thead>
                            <tr class="border-b-2 border-amber-900">
                                <th class="text-yellow-200 p-3 text-left">Utilisateur</th>
                                <th class="text-yellow-200 p-3 text-left">Bière</th>
                                <th class="text-yellow-200 p-3 text-left">Note</th>
                                <th class="text-yellow-200 p-3 text-left">Commentaire</th>
                                <th class="text-yellow-200 p-3 text-left">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($allComments as $comment): ?>
                                <tr class="border-b border-amber-900/30 hover:bg-amber-900/20">
                                    <td class="p-3 text-yellow-200"><?= htmlspecialchars($comment['first_name']) ?></td>
                                    <td class="p-3 text-yellow-200"><?= htmlspecialchars($comment['beer_name']) ?></td>
                                    <td class="p-3 text-yellow-200"><?= str_repeat('🍺', $comment['rating']) ?></td>
                                    <td class="p-3 text-yellow-200"><?= htmlspecialchars($comment['content']) ?></td>
                                    <td class="p-3">
                                        <a href="index.php?action=delete_comment&comment_id=<?= $comment['id'] ?>&beer_id=<?= $comment['beer_id'] ?>"
                                            onclick="return confirm('Confirmer la suppression ?')"
                                            class="minecraft-button-small delete">
                                            🗑️
                                        </a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .minecraft-background {
        background-color: #2b1508;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='32' height='32' viewBox='0 0 32 32'%3E%3Cpath fill='%23422006' fill-opacity='0.4' d='M0 0h8v8H0V0zm8 8h8v8H8V8zm16-8h8v8h-8V0zm8 8h8v8h-8V8zm-8 0h8v8h-8V8zM8 16h8v8H8v-8zm16 0h8v8h-8v-8zM0 16h8v8H0v-8zM24 0h8v8h-8V0z'/%3E%3C/svg%3E");
    }

    .minecraft-tab {
        @apply px-6 py-3 text-yellow-200 font-bold relative;
        background: linear-gradient(to bottom, #8B4513, #713f12);
        border: 3px solid;
        border-color: #594131 #2b1508 #2b1508 #594131;
    }

    .minecraft-tab.active {
        background: linear-gradient(to bottom, #9B5523, #814f22);
        transform: translateY(2px);
    }

    .minecraft-button-small {
        @apply p-2 rounded inline-flex items-center justify-center;
        border: 2px solid;
        min-width: 36px;
    }

    .minecraft-button-small.edit {
        background: #2b5329;
        border-color: #367140 #1a3118 #1a3118 #367140;
    }

    .minecraft-button-small.delete {
        background: #8B0000;
        border-color: #a52a2a #4a0404 #4a0404 #a52a2a;
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

<script>
    function switchTab(tabName) {
        // Cache toutes les sections
        document.querySelectorAll('.tab-content').forEach(tab => {
            tab.classList.add('hidden');
        });

        // Désactive tous les onglets
        document.querySelectorAll('.minecraft-tab').forEach(tab => {
            tab.classList.remove('active');
        });

        // Affiche la section sélectionnée
        document.getElementById(`${tabName}-section`).classList.remove('hidden');
        document.getElementById(`${tabName}-tab`).classList.add('active');
    }
</script>