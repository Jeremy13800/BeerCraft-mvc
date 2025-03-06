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

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-md relative z-10">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-amber-900 mb-4 relative inline-block">
                <span class="relative z-10">Connexion</span>
                <div class="absolute inset-x-0 bottom-0 h-3 bg-yellow-300 transform -skew-x-12"></div>
            </h1>
            <p class="text-amber-800 text-xl">Accédez à votre compte BeerCraft</p>
        </div>

        <!-- Formulaire -->
        <form action="index.php?action=login" method="POST"
            class="bg-white/80 backdrop-blur-md shadow-2xl rounded-xl p-8 space-y-6  transition-all duration-300">

            <!-- Messages d'erreur -->
            <?php if (!empty($errors)): ?>
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6">
                    <div class="flex">
                        <div class="flex-shrink-0">
                            <svg class="h-5 w-5 text-red-400" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zM8.707 7.293a1 1 0 00-1.414 1.414L8.586 10l-1.293 1.293a1 1 0 101.414 1.414L10 11.414l1.293 1.293a1 1 0 001.414-1.414L11.414 10l1.293-1.293a1 1 0 00-1.414-1.414L10 8.586 8.707 7.293z" clip-rule="evenodd" />
                            </svg>
                        </div>
                        <div class="ml-3">
                            <p class="text-sm text-red-700">
                                <?php foreach ($errors as $error): ?>
                                    <?= $error ?><br>
                                <?php endforeach; ?>
                            </p>
                        </div>
                    </div>
                </div>
            <?php endif; ?>

            <!-- Email -->
            <div class="space-y-2 group">
                <label class="block text-lg font-semibold text-amber-900">
                    <span class="inline-block mr-2">📧</span> Email
                </label>
                <input type="email" name="email" required
                    class="w-full px-4 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-400 
                              focus:ring focus:ring-amber-200 transition-all duration-200
                              group-hover:border-amber-300"
                    placeholder="votre@email.com">
            </div>

            <!-- Mot de passe -->
            <div class="space-y-2 group">
                <label class="block text-lg font-semibold text-amber-900">
                    <span class="inline-block mr-2">🔒</span> Mot de passe
                </label>
                <input type="password" name="password" required
                    class="w-full px-4 py-3 rounded-lg border-2 border-amber-200 focus:border-amber-400 
                              focus:ring focus:ring-amber-200 transition-all duration-200
                              group-hover:border-amber-300"
                    placeholder="Votre mot de passe">
            </div>

            <!-- Bouton de connexion -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 text-white text-xl 
                           font-bold py-4 px-8 rounded-xl hover:from-amber-600 hover:to-yellow-600 
                           transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200
                           shadow-lg hover:shadow-xl">
                Se connecter 🍻
            </button>

            <!-- Lien mot de passe oublié -->
            <div class="text-center">
                <a href="#" class="text-sm text-amber-700 hover:text-amber-900 transition-colors duration-200">
                    Mot de passe oublié ?
                </a>
            </div>
        </form>

        <!-- Lien inscription -->
        <div class="mt-6 text-center">
            <p class="text-amber-800">
                Pas encore de compte ?
                <a href="index.php?action=register"
                    class="text-amber-600 hover:text-amber-700 font-medium transition-colors duration-200">
                    Inscrivez-vous
                </a>
            </p>
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