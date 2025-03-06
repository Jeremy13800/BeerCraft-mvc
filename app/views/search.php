<div class="min-h-screen bg-gradient-to-br from-amber-100 via-yellow-50 to-orange-50 py-12">
    <div class="container mx-auto px-4">
        <div class="bg-white/80 backdrop-blur-md rounded-xl p-8 shadow-xl mb-8">
            <h1 class="text-3xl font-bold text-amber-900 mb-6">Rechercher des bières</h1>

            <form method="GET" action="index.php" class="mb-8">
                <input type="hidden" name="action" value="search">
                <div class="flex gap-4">
                    <select name="category" class="flex-1 rounded-lg border-amber-300 focus:border-amber-500 focus:ring focus:ring-amber-200">
                        <option value="">Sélectionnez une catégorie</option>
                        <?php foreach ($categories as $category): ?>
                            <option value="<?= $category['id'] ?>" <?= isset($_GET['category']) && $_GET['category'] == $category['id'] ? 'selected' : '' ?>>
                                <?= htmlspecialchars($category['name']) ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                    <button type="submit" class="px-6 py-2 bg-amber-500 text-white rounded-lg hover:bg-amber-600 transition-all">
                        Rechercher 🔍
                    </button>
                </div>
            </form>

            <?php if (isset($beers) && !empty($beers)): ?>
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    <?php foreach ($beers as $beer): ?>
                        <div class="bg-white rounded-lg shadow-md p-4">
                            <h3 class="text-xl font-semibold text-amber-900"><?= htmlspecialchars($beer['name']) ?></h3>
                            <p class="text-gray-600"><?= htmlspecialchars($beer['category_name']) ?></p>
                            <p class="mt-2"><?= htmlspecialchars(substr($beer['description'], 0, 100)) ?>...</p>
                        </div>
                    <?php endforeach; ?>
                </div>
            <?php elseif (isset($_GET['category'])): ?>
                <p class="text-center text-gray-600">Aucune bière trouvée dans cette catégorie.</p>
            <?php endif; ?>
        </div>
    </div>
</div>