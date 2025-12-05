# Guide de Déploiement - Travel Express

## Informations du serveur

| Élément | Valeur |
|---------|--------|
| **Domaine** | srv1176393.hstgr.cloud |
| **URL Production** | https://srv1176393.hstgr.cloud |
| **Hébergeur** | Hostinger VPS |
| **OS** | Ubuntu Server |
| **Chemin projet** | /var/www/travel_express |
| **Repository** | https://github.com/AaronThierry/travelExpress.git |

---

## 1. Configuration initiale du VPS

### 1.1 Connexion au VPS

```bash
ssh root@srv1176393.hstgr.cloud
```

### 1.2 Mise à jour du système

```bash
sudo apt update && sudo apt upgrade -y
```

### 1.3 Installation des dépendances

```bash
# PHP 8.2 et extensions
sudo apt install -y software-properties-common
sudo add-apt-repository ppa:ondrej/php -y
sudo apt update
sudo apt install -y php8.2 php8.2-fpm php8.2-mysql php8.2-xml php8.2-mbstring php8.2-curl php8.2-zip php8.2-gd php8.2-bcmath

# Nginx
sudo apt install -y nginx

# MySQL
sudo apt install -y mysql-server

# Git
sudo apt install -y git

# Composer
curl -sS https://getcomposer.org/installer | php
sudo mv composer.phar /usr/local/bin/composer

# Node.js 20.x
curl -fsSL https://deb.nodesource.com/setup_20.x | sudo -E bash -
sudo apt install -y nodejs
```

---

## 2. Configuration de la base de données

### 2.1 Sécuriser MySQL

```bash
sudo mysql_secure_installation
```

### 2.2 Créer la base de données

```bash
sudo mysql -u root -p
```

```sql
CREATE DATABASE travel_express;
CREATE USER 'travel_user'@'localhost' IDENTIFIED BY 'votre_mot_de_passe';
GRANT ALL PRIVILEGES ON travel_express.* TO 'travel_user'@'localhost';
FLUSH PRIVILEGES;
EXIT;







```

---

## 3. Clonage et configuration du projet

### 3.1 Cloner le repository

```bash
cd /var/www
sudo git clone https://github.com/AaronThierry/travelExpress.git travel_express
cd travel_express
```

### 3.2 Permissions

```bash
sudo chown -R www-data:www-data /var/www/travel_express
sudo chmod -R 755 /var/www/travel_express
sudo chmod -R 775 storage bootstrap/cache
```

### 3.3 Installer les dépendances

```bash
sudo -u www-data composer install --optimize-autoloader --no-dev
npm install
npm run build
```

### 3.4 Configuration de l'environnement

```bash
sudo cp .env.example .env
sudo nano .env
```

Contenu du fichier `.env` :

```env
APP_NAME="Travel Express"
APP_ENV=production
APP_KEY=
APP_DEBUG=false
APP_URL=https://srv1176393.hstgr.cloud

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=travel_express
DB_USERNAME=travel_user
DB_PASSWORD=votre_mot_de_passe

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120
```

### 3.5 Finaliser l'installation Laravel

```bash
sudo chown www-data:www-data .env
sudo -u www-data php artisan key:generate
sudo -u www-data php artisan migrate --force
sudo -u www-data php artisan storage:link
sudo -u www-data php artisan config:cache
sudo -u www-data php artisan route:cache
sudo -u www-data php artisan view:cache
```

---

## 4. Configuration de Nginx

### 4.1 Créer le fichier de configuration

```bash
sudo nano /etc/nginx/sites-available/travel_express
```

Contenu :

```nginx
server {
    listen 80;
    listen [::]:80;
    server_name srv1176393.hstgr.cloud;
    root /var/www/travel_express/public;

    add_header X-Frame-Options "SAMEORIGIN";
    add_header X-Content-Type-Options "nosniff";

    index index.php;
    charset utf-8;

    location / {
        try_files $uri $uri/ /index.php?$query_string;
    }

    location = /favicon.ico { access_log off; log_not_found off; }
    location = /robots.txt  { access_log off; log_not_found off; }

    error_page 404 /index.php;

    location ~ \.php$ {
        fastcgi_pass unix:/var/run/php/php8.2-fpm.sock;
        fastcgi_param SCRIPT_FILENAME $realpath_root$fastcgi_script_name;
        include fastcgi_params;
    }

    location ~ /\.(?!well-known).* {
        deny all;
    }
}
```

### 4.2 Activer le site

```bash
sudo ln -s /etc/nginx/sites-available/travel_express /etc/nginx/sites-enabled/
sudo rm /etc/nginx/sites-enabled/default
sudo nginx -t
sudo systemctl restart nginx
```

---

## 5. Configuration SSL (Let's Encrypt)

### 5.1 Installer Certbot

```bash
sudo apt install -y certbot python3-certbot-nginx
```

### 5.2 Générer le certificat

```bash
sudo certbot --nginx -d srv1176393.hstgr.cloud
```

### 5.3 Vérifier le renouvellement automatique

```bash
sudo certbot renew --dry-run
```

---

## 6. Configuration du pare-feu

```bash
sudo ufw allow 22
sudo ufw allow 80
sudo ufw allow 443
sudo ufw allow 'Nginx Full'
sudo ufw enable
sudo ufw reload
```

---

## 7. Script de déploiement automatisé

### 7.1 Créer le script

```bash
sudo nano /var/www/travel_express/deploy.sh
```

Contenu :

```bash
#!/bin/bash
cd /var/www/travel_express
echo "📥 Récupération des modifications..."
git pull origin main
echo "📦 Installation des dépendances PHP..."
composer install --optimize-autoloader --no-dev
echo "🗄️ Migration base de données..."
php artisan migrate --force
echo "🎨 Build des assets..."
npm run build
echo "🚀 Optimisation Laravel..."
php artisan config:cache
php artisan route:cache
php artisan view:cache
echo "✅ Déploiement terminé !"
```

### 7.2 Rendre le script exécutable

```bash
sudo chmod +x /var/www/travel_express/deploy.sh
```

---

## 8. Workflow de mise à jour

### Sur le PC local (Windows)

```bash
# 1. Faire les modifications dans le code

# 2. Commiter et pousser
git add -A
git commit -m "Description des modifications"
git push origin main
```

### Sur le VPS

```bash
# 3. Se connecter
ssh root@srv1176393.hstgr.cloud

# 4. Déployer
cd /var/www/travel_express
./deploy.sh
```

---

## 9. Commandes utiles

### Logs Laravel

```bash
tail -50 /var/www/travel_express/storage/logs/laravel.log
```

### Logs Nginx

```bash
sudo tail -20 /var/log/nginx/error.log
sudo tail -20 /var/log/nginx/access.log
```

### Redémarrer les services

```bash
sudo systemctl restart nginx
sudo systemctl restart php8.2-fpm
```

### Vider les caches Laravel

```bash
cd /var/www/travel_express
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear
```

### Activer le mode debug (temporaire)

```bash
sed -i 's/APP_DEBUG=false/APP_DEBUG=true/' .env
php artisan config:clear
# Après résolution du problème :
sed -i 's/APP_DEBUG=true/APP_DEBUG=false/' .env
php artisan config:clear
```

### Vérifier l'état des services

```bash
sudo systemctl status nginx
sudo systemctl status php8.2-fpm
sudo systemctl status mysql
```

---

## 10. Dépannage

### Erreur 500

1. Vérifier les logs Laravel
2. Activer APP_DEBUG=true temporairement
3. Vérifier les permissions sur storage et bootstrap/cache

### Erreur "Vite manifest not found"

```bash
npm install
npm run build
```

### Erreur de permissions

```bash
sudo chown -R www-data:www-data /var/www/travel_express
sudo chmod -R 775 storage bootstrap/cache
```

### Erreur .env invalide

```bash
sudo rm .env
sudo cp .env.example .env
sudo nano .env
# Reconfigurer les variables
sudo chown www-data:www-data .env
php artisan key:generate
```

---

## 11. Sauvegardes

### Sauvegarder la base de données

```bash
mysqldump -u travel_user -p travel_express > backup_$(date +%Y%m%d).sql
```

### Restaurer la base de données

```bash
mysql -u travel_user -p travel_express < backup_YYYYMMDD.sql
```

---

## Résumé rapide

| Action | Commande |
|--------|----------|
| Connexion VPS | `ssh root@srv1176393.hstgr.cloud` |
| Déployer | `./deploy.sh` |
| Logs Laravel | `tail -50 storage/logs/laravel.log` |
| Redémarrer Nginx | `sudo systemctl restart nginx` |
| Vider cache | `php artisan cache:clear` |

---

*Document créé le 5 décembre 2025*
