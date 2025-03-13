# BeerCraft MVC 🍺

![GitHub repo](https://img.shields.io/badge/GitHub-Jeremy13800/BeerCraft--mvc-blue?style=flat-square&logo=github)
![PHP](https://img.shields.io/badge/PHP-8.0-blue?style=flat-square&logo=php)
![MySQL](https://img.shields.io/badge/MySQL-8.0-blue?style=flat-square&logo=mysql)
![Apache](https://img.shields.io/badge/Apache-2.4-orange?style=flat-square&logo=apache)
![Docker](https://img.shields.io/badge/Docker-Compose-2496ED?style=flat-square&logo=docker)

## 🚀 Introduction
**BeerCraft** is a web application based on **PHP (MVC)** that manages a beer database, including users and comments. The project is designed with **Docker, MySQL, PHP, and Apache**, and features an administration interface.

## 📂 Features
- Beer management (CRUD)
- User authentication system (login/registration)
- Admin interface
- Comment management

## 🛠️ Installation
### 1️⃣ Prerequisites
- [Docker & Docker Compose](https://www.docker.com/)
- [Git](https://git-scm.com/)

### 2️⃣ Clone the project
```bash
git clone https://github.com/Jeremy13800/BeerCraft-mvc.git
cd BeerCraft-mvc
```

### 3️⃣ Run with Docker
```bash
docker-compose up -d
```

The application will be available at **http://localhost**, and **phpMyAdmin at http://localhost:8081**

### 4️⃣ Import the database
Import the **`beercraft.sql`** file into MySQL using phpMyAdmin or via command line:
```bash
docker exec -i mysql-db mysql -u root -proot test < beercraft.sql
```

## ⚙️ Complete Project Structure
```
BeerCraft-mvc/
├── .db/               # Database
│   ├── beercraft.sql  # Database dump
├── .documention/      # Documentation folder
├── app/               # Contains all business logic of the project
│   ├── controllers/   # Controllers (BeerController.php, CommentController.php, UserController.php)
│   ├── models/        # Models (Beer.php, Category.php, Comment.php, Database.php, User.php)
│   ├── views/         # View files
│   │   ├── inc/       # Common includes
│   │   ├── add_beer.php
│   │   ├── admin_dashboard.php
│   │   ├── beer_detail.php
│   │   ├── beerList.php
│   │   ├── dashboard.php
│   │   ├── edit_beer.php
│   │   ├── layout.php
│   │   ├── login.php
│   │   ├── register.php
├── config/            # General project configuration (config.php)
├── public/            # Publicly accessible files (index.php, assets...)
│   ├── uploads/       # Directory for uploaded files
├── .env               # Environment variables
├── .gitignore         # Git ignored files management
├── index.php          # Main entry point
└── docker-compose.yml # Docker configuration
```

## 🎨 Interface & User Experience
- Clean and intuitive design for smooth navigation.
- Admin dashboard to easily manage beers and comments.
- Secure forms for adding and editing beers.

## 🐞 Debugging & Development
- **Xdebug** is enabled in Docker for debugging.
- Log files accessible in `/logs/`
- Unit and integration tests available in `/tests/`

## ✨ Conventions & Best Practices
- **MVC architecture** compliance
- Routes defined via **Apache & PHP files**
- **PDO-secured queries**
- **PSR-4 conventions** for autoloading
- **Docker usage** for containerization and easy setup

## 👥 Contribute
1. Fork the project 🍴
2. Create a branch `feature/my_feature`
3. Make a **commit** and a **push**
4. Open a **Pull Request** ✅

## 📜 License
This project is under the **MIT license**. You are free to use and modify it as you like!

---
**🚀 BeerCraft MVC - Developed by [Jérémy](https://github.com/Jeremy13800) 🍻**
