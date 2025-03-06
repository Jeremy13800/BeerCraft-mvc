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

    <div class="container mx-auto px-4 sm:px-6 lg:px-8 max-w-2xl relative z-10">
        <!-- En-tête -->
        <div class="text-center mb-12">
            <h1 class="text-4xl font-bold text-amber-900 mb-4 relative inline-block">
                <span class="relative z-10">Rejoignez la communauté</span>
                <div class="absolute inset-x-0 bottom-0 h-3 bg-yellow-300 transform -skew-x-12"></div>
            </h1>
            <p class="text-amber-800 text-xl">Créez votre compte pour partager vos découvertes</p>
        </div>

        <!-- Formulaire -->
        <form action="index.php?action=register" method="POST"
            class="bg-white/80 backdrop-blur-md shadow-2xl rounded-xl p-8 space-y-6">

            <!-- Prénom -->
            <div class="space-y-2">
                <label class="block text-lg font-semibold text-amber-900">
                    <span class="inline-block mr-2">👤</span> Prénom
                </label>
                <input type="text" name="first_name" required
                    class="w-full px-4 py-2 rounded-lg border-2 border-amber-200 focus:border-amber-400 
                              focus:ring focus:ring-amber-200 transition-all duration-200"
                    placeholder="Votre prénom">
            </div>

            <!-- Nom -->
            <div class="space-y-2">
                <label class="block text-lg font-semibold text-amber-900">
                    <span class="inline-block mr-2">📝</span> Nom
                </label>
                <input type="text" name="last_name" required
                    class="w-full px-4 py-2 rounded-lg border-2 border-amber-200 focus:border-amber-400 
                              focus:ring focus:ring-amber-200 transition-all duration-200"
                    placeholder="Votre nom">
            </div>

            <!-- Email -->
            <div class="space-y-2">
                <label class="block text-lg font-semibold text-amber-900">
                    <span class="inline-block mr-2">📧</span> Email
                </label>
                <input type="email" name="email" required
                    class="w-full px-4 py-2 rounded-lg border-2 border-amber-200 focus:border-amber-400 
                              focus:ring focus:ring-amber-200 transition-all duration-200"
                    placeholder="votre@email.com">
            </div>

            <!-- Rôle -->
            <div class="space-y-2">
                <label class="block text-lg font-semibold text-amber-900">
                    <span class="inline-block mr-2">👥</span> Rôle
                </label>
                <select name="role" required
                    class="w-full px-4 py-2 rounded-lg border-2 border-amber-200 focus:border-amber-400 
                           focus:ring focus:ring-amber-200 transition-all duration-200 bg-white">
                    <option value="member">Membre</option>
                    <option value="admin">Administrateur</option>
                </select>
            </div>

            <!-- Mot de passe -->
            <div class="space-y-2">
                <label class="block text-lg font-semibold text-amber-900">
                    <span class="inline-block mr-2">🔒</span> Mot de passe
                </label>
                <input type="password" name="password" required
                    class="w-full px-4 py-2 rounded-lg border-2 border-amber-200 focus:border-amber-400 
                              focus:ring focus:ring-amber-200 transition-all duration-200"
                    placeholder="Choisissez un mot de passe sécurisé">
            </div>

            <!-- Bouton de soumission -->
            <button type="submit"
                class="w-full bg-gradient-to-r from-amber-500 to-yellow-500 text-white text-xl 
                           font-bold py-4 px-8 rounded-xl hover:from-amber-600 hover:to-yellow-600 
                           transform hover:scale-[1.02] active:scale-[0.98] transition-all duration-200
                           shadow-lg hover:shadow-xl">
                Créer mon compte 🍻
            </button>
        </form>

        <!-- Lien connexion -->
        <div class="mt-6 text-center">
            <p class="text-amber-800">
                Déjà membre ?
                <a href="index.php?action=login"
                    class="text-amber-600 hover:text-amber-700 font-medium">
                    Connectez-vous
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