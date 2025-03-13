#🔹 Bonnes pratiques supplémentaires

### ✅ \*\*Toujours utiliser `prepare()` et `execute()`

Évite l’utilisation directe de variables dans une requête (`$pdo->query("SELECT * FROM users WHERE id = " . $_GET['id']")` ❌).

### ✅ Utiliser `password_hash()` pour stocker les mots de passe

Ne jamais stocker un mot de passe en clair !

### ✅ Limiter les permissions en base de données\*\*

L’utilisateur MySQL utilisé par l’application ne doit pas avoir de droits excessifs.
