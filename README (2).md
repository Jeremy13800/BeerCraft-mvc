# BeerCraft MVC 🍺

![GitHub repo](https://img.shields.io/badge/GitHub-Jeremy13800/BeerCraft--mvc-blue?style=flat-square&logo=github)
![PHP](https://img.shields.io/badge/PHP-8.0-blue?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue?style=flat-square&logo=mysql)
![Apache](https://img.shields.io/badge/Apache-2.4-orange?style=flat-square&logo=apache)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=flat-square&logo=docker)

## 🚀 Introduction
**BeerCraft** est une application web basée sur **PHP (MVC)** permettant de gérer une base de données de bières, incluant les utilisateurs et commentaires. Le projet est conçu avec **Docker, MySQL, PHP et Apache**, et propose une interface d'administration.

## 📂 Fonctionnalités
- Gestion des bières (CRUD)
- Système d'authentification (connexion/inscription)
- Interface administrateur
- Gestion des commentaires

## 🛠️ Installation
### 1️⃣ Prérequis
- [Docker & Docker Compose](https://www.docker.com/)
- [Git](https://git-scm.com/)

### 2️⃣ Cloner le projet
```bash
git clone https://github.com/Jeremy13800/BeerCraft-mvc.git
cd BeerCraft-mvc
```

### 3️⃣ Lancer avec Docker
```bash
docker-compose up -d
```

L'application sera disponible sur **http://localhost** et **phpMyAdmin sur http://localhost:8081**

### 4️⃣ Importer la base de données
Importer le fichier **`beercraft.sql`** dans MySQL via phpMyAdmin ou en ligne de commande :
```bash
docker exec -i mysql-db mysql -u root -proot test < beercraft.sql
```

## ⚙️ Structure complète du projet
```
BeerCraft-mvc/
├── .db/               # Base de données
│   ├── beercraft.sql  # Dump de la base de données
├── .documention/      # Dossier de documentation
├── app/               # Contient toute la logique métier du projet
│   ├── controllers/   # Contrôleurs (BeerController.php, CommentController.php, UserController.php)
│   ├── models/        # Modèles (Beer.php, Category.php, Comment.php, Database.php, User.php)
│   ├── views/         # Fichiers de vues
│   │   ├── inc/       # Inclusions communes
│   │   ├── add_beer.php
│   │   ├── admin_dashboard.php
│   │   ├── beer_detail.php
│   │   ├── beerList.php
│   │   ├── dashboard.php
│   │   ├── edit_beer.php
│   │   ├── layout.php
│   │   ├── login.php
│   │   ├── register.php
├── config/            # Configuration générale du projet (config.php)
├── public/            # Fichiers accessibles publiquement (index.php, assets...)
│   ├── uploads/       # Répertoire pour stocker les fichiers uploadés
├── .env               # Variables d'environnement
├── .gitignore         # Fichier de gestion des fichiers ignorés par Git
├── index.php          # Point d'entrée principal
└── docker-compose.yml # Configuration Docker
```

## 🎨 Interface & Expérience Utilisateur
- Design épuré et intuitif pour une navigation fluide.
- Dashboard administrateur pour gérer facilement les bières et les commentaires.
- Formulaires sécurisés pour l'ajout et la modification des bières.

## 🐞 Debugging & Développement
- **Xdebug** est activé dans Docker pour le debugging.
- Fichiers de logs accessibles dans `/logs/`
- Tests unitaires et d'intégration disponibles dans `/tests/`

## ✨ Conventions & Bonnes Pratiques
- Respect de l’architecture **MVC**
- Routes définies via **Apache & fichiers PHP**
- Sécurisation des requêtes avec **PDO**
- Conventions PSR-4 pour l’autoloading
- Utilisation de **Docker** pour la conteneurisation et simplification du setup

## 👥 Contribuer
1. Fork le projet 🍴
2. Crée une branche `feature/ma_fonctionnalite`
3. Fais un **commit** et un **push**
4. Ouvre une **Pull Request** ✅

## 📜 Licence
Ce projet est sous **licence MIT**. Tu es libre de l'utiliser et de le modifier comme bon te semble !

---
**🚀 BeerCraft MVC - Développé par [Jérémy](https://github.com/Jeremy13800) 🍻**
