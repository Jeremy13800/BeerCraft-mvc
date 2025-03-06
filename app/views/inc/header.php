<header class="minecraft-header relative">
    <!-- Stone texture background -->
    <div class="stone-texture absolute inset-0"></div>

    <div class="container mx-auto px-4 relative z-10">
        <div class="flex items-center justify-between py-4">
            <!-- Logo Zone -->
            <a href="index.php" class="minecraft-logo-block group">
                <div class="crafting-table">
                    <div class="crafting-grid">
                        <span class="text-3xl transform group-hover:scale-110 transition-all duration-300">🍺</span>
                    </div>
                </div>
                <h1 class="pixel-title">
                    <span class="text-yellow-300">Beer</span>
                    <span class="text-amber-500">Craft</span>
                </h1>
            </a>

            <!-- Navigation principale -->
            <nav class="hidden md:flex items-center gap-4">
                <?php if (isset($_SESSION['user'])): ?>
                    <div class="minecraft-nameplate">
                        <span class="nameplate-icon">⛏️</span>
                        <span class="nameplate-text">
                            <?= htmlspecialchars($_SESSION['user']['first_name']) ?>
                        </span>
                    </div>
                    <div class="menu-buttons">
                        <a href="index.php?action=dashboard" class="mc-button stone">
                            <span class="button-text">Dashboard</span>
                        </a>
                        <a href="index.php?action=add_beer" class="mc-button wood">
                            <span class="button-icon">+</span>
                            <span class="button-text">Ajouter une bière</span>
                        </a>
                        <a href="index.php?action=logout" class="mc-button netherrack">
                            <span class="button-text">Déconnexion</span>
                        </a>
                    </div>
                <?php else: ?>
                    <div class="menu-buttons">
                        <a href="index.php?action=login" class="mc-button stone">
                            <span class="button-text">Connexion</span>
                        </a>
                        <a href="index.php?action=register" class="mc-button emerald">
                            <span class="button-text">Inscription</span>
                        </a>
                    </div>
                <?php endif; ?>
            </nav>
        </div>
    </div>
</header>

<style>
    .minecraft-header {
        background-color: #1A1A1A;
        border-bottom: 4px solid #2D2D2D;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.5);
    }

    .stone-texture {
        background-image: url("data:image/svg+xml,%3Csvg width='64' height='64' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.65' numOctaves='3' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='64' height='64' filter='url(%23noise)' opacity='0.15'/%3E%3C/svg%3E"),
            linear-gradient(to bottom, #2D2D2D, #1A1A1A);
        opacity: 0.9;
    }

    .minecraft-logo-block {
        display: flex;
        align-items: center;
        gap: 1rem;
    }

    .crafting-table {
        width: 3rem;
        height: 3rem;
        background: #8B4513;
        border: 3px solid #A0522D;
        box-shadow: inset -2px -2px 0 #2B1508, inset 2px 2px 0 rgba(255, 255, 255, 0.2);
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .pixel-title {
        font-size: 1.75rem;
        font-weight: bold;
        font-family: 'Minecraft', monospace;
        text-shadow: 2px 2px 0 #000;
    }

    .minecraft-nameplate {
        padding: 0.5rem 1rem;
        background-color: rgba(139, 69, 19, 0.3);
        border: 2px solid rgba(139, 69, 19, 0.6);
        border-radius: 4px;
    }

    .menu-buttons {
        display: flex;
        align-items: center;
        gap: 0.75rem;
    }

    .mc-button {
        padding: 0.5rem 1rem;
        font-family: 'Minecraft', monospace;
        border: 3px solid;
        text-shadow: 2px 2px 0 rgba(0, 0, 0, 0.5);
        transition: transform 0.1s, filter 0.1s;
    }

    .mc-button:hover {
        transform: translateY(-2px);
        filter: brightness(1.2);
    }

    .mc-button.stone {
        background-color: #707070;
        border-color: #808080;
        color: #fff;
    }

    .mc-button.wood {
        background-color: #8B4513;
        border-color: #A0522D;
        color: #FFE4C4;
    }

    .mc-button.netherrack {
        background-color: #8B0000;
        border-color: #A00000;
        color: #FFA07A;
    }

    .mc-button.emerald {
        background-color: #2E8B57;
        border-color: #3CB371;
        color: #98FB98;
    }
</style>