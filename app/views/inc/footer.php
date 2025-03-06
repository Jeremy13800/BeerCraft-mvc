<!-- views/inc/footer.php -->
<!-- Dirt block transition -->
<div class="dirt-to-bedrock">
    <!-- <div class="dirt-pattern"></div> -->
    <div class="bedrock-transition"></div>
</div>

<footer class="minecraft-footer relative">
    <div class="container mx-auto px-4 py-8 relative z-10">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
            <!-- Section Logo -->
            <div class="minecraft-block bg-stone">
                <div class="pixel-content">

                    <h3 class="mc-text-xl text-yellow-400 mb-2">BeerCraft</h3>
                    <p class="mc-text text-gray-300">Taverne de dégustation virtuelle</p>
                </div>
            </div>

            <!-- Menu principal -->
            <div class="minecraft-block bg-planks">
                <div class="pixel-content">
                    <h3 class="mc-text-xl text-yellow-400 mb-4">Commandes</h3>
                    <nav class="flex flex-col gap-2">
                        <a href="index.php" class="mc-command">/teleport home</a>
                        <a href="index.php?action=add_beer" class="mc-command">/brew beer</a>
                        <a href="index.php?action=login" class="mc-command">/connect</a>
                    </nav>
                </div>
            </div>

            <!-- Contact -->
            <div class="minecraft-block bg-dark">
                <div class="pixel-content">
                    <h3 class="mc-text-xl text-yellow-400 mb-4">Guide du voyageur</h3>
                    <div class="space-y-3">
                        <div class="mc-item text-white">
                            <span class="item-sprite">📬</span>
                            <span>contact@beercraft.be</span>
                        </div>
                        <div class="mc-item text-white">
                            <span class="item-sprite">📍</span>
                            <span>Taverne BeerCraft<br>Spawn Zone, Creative</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Barre de séparation -->
        <div class="pixel-separator my-8"></div>

        <!-- Copyright -->
        <div class="text-center">
            <p class="mc-text text-gray-400">
                BeerCraft © 2024 | Crafté avec <span class="inline-block animate-bounce">⚒️</span>
            </p>
        </div>
    </div>
</footer>

<style>
    .dirt-to-bedrock {
        height: 64px;
        background: linear-gradient(to bottom, #8B5E3C, #1A1A1A);
        position: relative;
        overflow: hidden;
    }

    .dirt-pattern {
        position: absolute;
        inset: 0;
        background-image: url("data:image/svg+xml,%3Csvg width='16' height='16' xmlns='http://www.w3.org/2000/svg'%3E%3Crect width='16' height='16' fill='%23654321'/%3E%3Cpath d='M0 0h4v4H0zm8 0h4v4H8zm4 4h4v4h-4zm-8 4h4v4H4z' fill='%23483019'/%3E%3C/svg%3E");
        background-size: 16px;
        opacity: 0.7;
    }

    .minecraft-footer {
        background-color: #1A1A1A;
        min-height: 200px;
        position: relative;
    }

    .minecraft-block {
        padding: 1.5rem;
        border: 4px solid;
        border-radius: 6px;
        box-shadow: inset -2px -2px 0 rgba(0, 0, 0, 0.6);
    }

    .minecraft-block.bg-stone {
        background-color: #707070;
        border-color: #909090;
    }

    .minecraft-block.bg-planks {
        background-color: #8B4513;
        border-color: #A0522D;
    }

    .minecraft-block.bg-dark {
        background-color: #2D2D2D;
        border-color: #505050;
    }

    .mc-command {
        display: block;
        padding: 0.75rem;
        font-family: 'Minecraft', monospace;
        color: #facc15;
        text-shadow: 2px 2px 0 #000;
    }

    .mc-command:hover {
        color: #ffeb3b;
        text-shadow: 2px 2px 4px #FFA500;
    }

    .mc-text {
        font-family: 'Minecraft', monospace;
        text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.5);
    }

    .mc-text-xl {
        font-size: 1.5rem;
        font-weight: bold;
        font-family: 'Minecraft', monospace;
        text-shadow: 3px 3px 0 rgba(0, 0, 0, 0.7);
    }

    .pixelated {
        image-rendering: pixelated;
    }

    .pixel-separator {
        height: 4px;
        background: repeating-linear-gradient(90deg,
                rgba(139, 69, 19, 0.6),
                rgba(139, 69, 19, 0.6) 4px,
                transparent 4px,
                transparent 8px);
        margin: 2rem 0;
    }
</style>