# 🐴 Gestionnaire des Poneys

![GitHub repo size](https://img.shields.io/github/repo-size/yassinebouelkheir/Gestionnaire-des-poneys)
![GitHub contributors](https://img.shields.io/github/contributors/yassinebouelkheir/Gestionnaire-des-poneys)
![GitHub stars](https://img.shields.io/github/stars/yassinebouelkheir/Gestionnaire-des-poneys?style=social)
![Laravel](https://img.shields.io/badge/Laravel-9.x-red.svg?style=flat&logo=laravel)

**Gestionnaire des Poneys** est une application web visant à moderniser la gestion des poneys et à faciliter le suivi des clients. Cette application permet :

- Une **visualisation des poneys disponibles**
- Une **gestion journalière** optimisée pour l’arrivée des clients (assignation des poneys, etc.)
- Une **gestion intelligente des factures** pour faciliter l’envoi et le suivi des paiements.

---

## 🚀 Fonctionnalités

✅ Visualisation en temps réel des poneys disponibles  
✅ Assignation des poneys aux clients de manière optimisée  
✅ Gestion des propriétaires et des soins des poneys  
✅ Gestion des réservations et planification  
✅ Facturation intelligente et envoi automatisé des factures   
✅ Authentification et rôles des utilisateurs (Admin / Employé) 

---

## 🏗️ Installation et Configuration

### 📌 Prérequis

- **PHP** (>= 8.0)
- **Composer** (gestionnaire de dépendances PHP)
- **Laravel** (9.x ou 10.x recommandé)
- **Base de données** (MySQL, PostgreSQL ou SQLite)

### 💾 Installation

1. **Cloner le projet**
   ```bash
   git clone https://github.com/yassinebouelkheir/Gestionnaire-des-poneys.git
   cd Gestionnaire-des-poneys
   ```

2. **Installer les dépendances PHP avec Composer**
   ```bash
   composer install
   ```

3. **Créer et configurer le fichier `.env`**
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. **Configurer la base de données**  
   Dans `.env`, modifier ces lignes selon votre configuration :
   ```
   DB_CONNECTION=sqlite
   DB_DATABASE=database.sqlite
   DB_USERNAME=root
   DB_PASSWORD=your_password
   ```

5. **Migrer la base de données**
   ```bash
   php artisan migrate --seed
   ```

6. **Lancer le serveur**
   ```bash
   php artisan serve
   ```

   L’application sera accessible à : [http://127.0.0.1:8000](http://127.0.0.1:8000)

---

## 🛠️ Technologies utilisées

| Technologie | Description |
|-------------|------------|
| PHP 8.x | Langage de programmation |
| Laravel 9.x | Framework backend |
| SQLite | Base de données |

---

## 📜 Structure du projet

```
Gestionnaire-des-poneys/
│── app/                      # Code principal Laravel (Controllers, Models)
│── bootstrap/                # Bootstrapping du framework
│── config/                   # Configuration de l'application
│── database/                 # Migrations, Factories et Seeds
│── public/                   # Assets publics (CSS, JS, images)
│── resources/                # Vues Blade, JS, CSS, components Vue.js
│── routes/                   # Fichiers de routage (web.php, api.php)
│── storage/                  # Stockage des logs et fichiers
│── tests/                    # Tests unitaires et fonctionnels
│── .env                      # Fichier de configuration (base de données, clés API, etc.)
│── artisan                   # CLI Laravel
│── composer.json             # Fichier de dépendances PHP
│── package.json              # Fichier de dépendances JS (si applicable)
│── README.md                 # Documentation
```

---

## 🔥 Comment contribuer ?

Les contributions sont les bienvenues ! Voici comment aider :

1. **Forker** le projet 🍴  
2. **Créer** une branche `feature-ma-fonctionnalité`  
3. **Coder** et **commiter** vos changements 💻  
4. **Pousser** la branche sur votre fork 🚀  
5. **Créer une pull request** sur le dépôt principal ✅  

---

## 📞 Support & Contact

Si vous avez des questions ou suggestions, n'hésitez pas à ouvrir une [Issue GitHub](https://github.com/yassinebouelkheir/Gestionnaire-des-poneys/issues).

📧 Email : *yassinebouelkheir@gmail.com*  
💬 Discord : *Xeon™#2851*  

---

## 📜 Licence

Ce projet est sous licence **Apache License 2.0** - voir le fichier [LICENSE](LICENSE) pour plus de détails.

---

### 🎉 Merci d'utiliser **Gestionnaire des Poneys** ! 🐎💨
