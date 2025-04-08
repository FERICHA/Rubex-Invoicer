# 🧾 Rubex Invoicer - Système de Gestion de Factures

<img src="https://github.com/user-attachments/assets/54d6ffe1-4959-4837-a0af-279a79c9a1e0" alt="Bannière Rubex Invoicer" width="300"/>

## Présentation du Projet 
Rubex Invoicer est une Solution complète de gestion de factures pour TPE/PME et travailleurs indépendants. Elle simplifie la création et le suivi des factures, la gestion des paiements, des utilisateurs ainsi que l’accès à des analyses financières claires. Facile à déployer grâce à Docker, c’est l’outil idéal pour garder le contrôle sur votre activité en toute simplicité.



## ✨ Fonctionnalités Principales

| Fonctionnalité               | Description                                                                 |
|------------------------------|-----------------------------------------------------------------------------|
| 📝 **Gestion complète de factures** | <ul><li>Création de factures détaillées</li><li>Modification des factures existantes</li><li>Suppression sécurisée des factures</li><li>Recherche et filtrage avancé</li></ul> |
| 💶 **Suivi des paiements** | <ul><li>Marquage des statuts : <code>Payé</code>/<code>Non payé</code>/<code>Partiellement payé</code></li><li>Gestion des échéances et dates de paiement</li><li>Historique complet des transactions</li></ul> |
| 🗂 **Organisation intelligente** | <ul><li>Classement par catégories personnalisables</li><li>Système de tags pour un filtrage rapide</li><li>Sections dédiées par type de produit/service</li></ul> |
| 👨‍💼 **Contrôle d'accès granulaire** | <ul><li><strong>Administrateurs</strong> : Accès complet à toutes les fonctionnalités</li><li><strong>Membres normaux</strong> : Restrictions sur les données sensibles</li><li>Gestion fine des permissions</li></ul> |
| 📈 **Tableau de bord analytique** | <ul><li>Statistiques financières en temps réel</li><li>Graphiques des revenus/dépenses</li><li>Indicateurs de performance clés</li></ul> |
| 🤖 **Automatisation intelligente** | <ul><li>Notifications en temps réel pour les actions clés</li></ul> |

## Technologies utilisées 
**Backend**

- PHP : Langage principal utilisé par Laravel.

- Laravel : Framework MVC (Modèle-Vue-Contrôleur).

- Blade : Moteur de templates de Laravel (pour les vues HTML).

- Eloquent ORM : Pour les interactions avec la base de données.

- Artisan : Interface CLI de Laravel (pour les migrations, tests, etc.).

- MySQLL : Base de données.

- Composer : Gestionnaire de dépendances PHP.

**Frontend**
- HTML/CSS : Pour la structure et le style des pages.

- Blade : Utilisé pour intégrer du PHP dans les vues HTML.

- JavaScript / jQuery : beaucoup de logique côté client.







## 🚀 Démarrage Rapide - Déploiement avec Docker
### Prérequis

- Docker 20.10+
- Docker Compose 2.0+
- Git

### 1. Cloner le dépôt
```bash
git clone https://github.com/FERICHA/Rubex-Invoicer.git
cd Rubex-Invoicer 
```

### 2. Configuration 
#### Initialiser le fichier .env

```bash
cp .env.example .env
```

#### Créer le fichier .htaccess
```bash
New-Item .htaccess -ItemType File
```
#### .htaccess
```bash
<IfModule mod_rewrite.c>
    RewriteEngine On 
    RewriteBase /
    RewriteRule ^$ public/index.php [L]
    RewriteRule ^((?!public/).*)$ public/$1 [L,NC]
</IfModule>
```

#### Créer le fichier docker-compose.yml et le Dossier docker :

```powershell
mkdir -Force docker | Out-Null
```
```powershell
New-Item docker-compose.yml -ItemType File
```

#### Éditer avec Notepad (ou VS Code si installé)
```powershell
notepad docker-compose.yml
```
#### docker-compose.yml
```bash
version: '3.8'

services:
  app:
    build:
      context: .
      dockerfile: docker/php/Dockerfile
    container_name: app
    restart: unless-stopped
    working_dir: /var/www
    volumes:
      - .:/var/www
    environment:
      - DB_HOST=db
      - DB_PORT=3306  
      - DB_DATABASE=invoices
      - DB_USERNAME=root
      - DB_PASSWORD=root12345@
      - REDIS_HOST=redis
    networks:
      - laravel-network

  webserver:
    image: nginx:alpine
    container_name: webserver
    restart: unless-stopped
    ports:
      - "80:80"
    volumes:
      - .:/var/www
      - ./docker/nginx:/etc/nginx/conf.d
    networks:
      - laravel-network
    depends_on:
      - app

  db:
    image: mysql:8.0
    container_name: db
    restart: unless-stopped
    environment:
      MYSQL_DATABASE: invoices
      MYSQL_ROOT_PASSWORD: root12345@
      MYSQL_ROOT_HOST: '%'
    volumes:
      - dbdata:/var/lib/mysql
    ports:
      - "3308:3306"  
    networks:
      - laravel-network
    healthcheck:
      test: ["CMD", "mysqladmin", "ping", "-h", "localhost"]
      timeout: 20s
      retries: 10

  redis:
    image: redis:alpine
    container_name: redis
    ports:
      - "6379:6379"
    networks:
      - laravel-network
    volumes:
      - redisdata:/data

  phpmyadmin:
    image: phpmyadmin/phpmyadmin
    container_name: phpmyadmin
    restart: unless-stopped
    ports:
      - "8080:80"
    environment:
      PMA_HOST: db  # Matches your MySQL container name
      PMA_PORT: 3306
      UPLOAD_LIMIT: 128M
    depends_on:
      - db
    networks:
      - laravel-network

volumes:
  dbdata:
    driver: local
  redisdata:
    driver: local

networks:
  laravel-network:
    driver: bridge
```
#### Créer le Dockerfile PHP
```powershell
mkdir -Force docker\php | Out-Null
New-Item docker\php\Dockerfile -ItemType File
notepad docker\php\Dockerfile
```
#### php/Dockerfile
```bash
# Use official PHP image with FPM
FROM php:8.1-fpm  

# Install dependencies
RUN apt-get update && apt-get install -y \
    git \
    curl \
    libpng-dev \
    libonig-dev \
    libxml2-dev \
    zip \
    unzip \
    libzip-dev

# Clear cache
RUN apt-get clean && rm -rf /var/lib/apt/lists/*

# Install PHP extensions
RUN docker-php-ext-install pdo_mysql mbstring exif pcntl bcmath gd zip

# Install Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

# Copy existing application directory contents
COPY . .

# Install PHP dependencies
RUN composer install --no-interaction --optimize-autoloader --no-dev

# Set permissions
RUN chown -R www-data:www-data /var/www/storage
RUN chown -R www-data:www-data /var/www/bootstrap/cache
RUN chmod -R 775 /var/www/storage
RUN chmod -R 775 /var/www/bootstrap/cache

# Expose port 9000 for PHP-FPM
EXPOSE 9000

# Start PHP-FPM server
CMD ["php-fpm"]
```
#### Créer la config Nginx
```powershell
mkdir -Force docker\nginx | Out-Null
New-Item docker\nginx\default.conf -ItemType File
notepad docker\nginx\default.conf
```
#### nginx/default.conf
```bash
server {
    listen 80;
    index index.php index.html;
    server_name localhost;
    error_log  /var/log/nginx/error.log;
    access_log /var/log/nginx/access.log;
    root /var/www/public;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location ~ \.php$ {
        try_files $uri =404;
        fastcgi_split_path_info ^(.+\.php)(/.+)$;
        fastcgi_pass app:9000;
        fastcgi_index index.php;
        include fastcgi_params;
        fastcgi_param SCRIPT_FILENAME $document_root$fastcgi_script_name;
        fastcgi_param PATH_INFO $fastcgi_path_info;
    }
}
```





### 3. Éditez le .env avec vos paramètres :
```bash
APP_NAME="Rubex Invoicer"
APP_URL=http://localhost

DB_HOST=db
DB_DATABASE=invoices
DB_USERNAME=root
DB_PASSWORD=securepassword
```
### 4. Structure de Projet 
![Capture d’écran 2025-04-01 224853](https://github.com/user-attachments/assets/3b7e3e33-b185-4cd8-9e4c-59afd32c1ee0)

### 5. Structure de dossier docker
![Capture d’écran 2025-04-01 225113](https://github.com/user-attachments/assets/7fe3c557-1f3a-45d6-9329-13eed127470e)

### 6 . Lancement et Construction des Containers en Arrière-plan
```bash
docker-compose up -d --build
```
| Option               | Rôle                                                                 |
|------------------------------|-----------------------------------------------------------------------------|
| docker-compose       | Orchestre les containers via le fichier docker-compose.yml |
| up                   | Crée et démarre les services (containers, réseaux, volumes) |
| -d                   | Détaché : Lance en arrière-plan (pas de blocage du terminal) |
| --build              | Reconstruit les images si les Dockerfile ont été modifiés |

![Capture d’écran 2025-03-31 041343](https://github.com/user-attachments/assets/61e1c570-1de8-42e8-a73a-96fe8c77158d)


### 7. Vérifier l'état des containers
```bash
docker-compose ps
```
![Capture d’écran 2025-03-31 043231](https://github.com/user-attachments/assets/c65b302c-52de-454b-bf77-31079d2c046c)

### 8. Générer et exécuter une migration de tables avec Laravel 
```bash
docker-compose exec app php artisan migrate
```

![Capture d’écran 2025-03-31 043359](https://github.com/user-attachments/assets/18f6be56-6014-4a64-affb-248c035907c8)

### 9. Résultats après la migration 
![Capture d’écran 2025-04-02 001807](https://github.com/user-attachments/assets/b8831369-d05a-4858-8486-b8cada4c0512)

### 10. Tester et valider le bon fonctionnement de l’application après déploiement 
![Capture d’écran 2025-04-02 002355](https://github.com/user-attachments/assets/aba0ded9-83f5-4262-99f6-67ea56ee49ea)


![screencapture-localhost-dashboard-2025-04-02-00_24_31](https://github.com/user-attachments/assets/624e236b-d9bd-4546-a16e-9c78cc8b1d4d)

### 11. Tagger l'image invoices-app 
![Capture d’écran 2025-04-01 215112](https://github.com/user-attachments/assets/a7eac47f-6727-4fc5-9238-8b34dc9d0c9b)

### 12. Pousser sur Docker Hub
![Capture d’écran 2025-04-01 215140](https://github.com/user-attachments/assets/05b52be0-b8cf-4128-aaa0-6af197b76e1d)

### 13. Image disponible 
https://hub.docker.com/r/ferichahoussam/invoices

## ✨ Auteurs
@FERICHA



























