# Guide de Déploiement - Travel Express sur Hostinger

## Prérequis sur Hostinger

1. **Plan d'hébergement**: Premium ou Business (PHP + MySQL)
2. **Version PHP**: 8.1 ou supérieure
3. **Base de données MySQL**
4. **Accès SSH** (recommandé) ou **File Manager**

---

## ÉTAPE 1: Préparer le projet en local

### 1.1 Optimiser pour la production

```bash
# Dans le dossier du projet
cd c:\Projet_laravel\travel_express

# Installer les dépendances de production uniquement
composer install --optimize-autoloader --no-dev

# Compiler les assets pour la production
npm run build

# Générer la clé d'application (si pas déjà fait)
php artisan key:generate

# Optimiser Laravel
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

### 1.2 Fichier .env pour production

Créer un fichier `.env.production` avec ces paramètres:

```env
APP_NAME="Travel Express"
APP_ENV=production
APP_KEY=base64:VOTRE_CLE_GENEREE
APP_DEBUG=false
APP_URL=https://votre-domaine.com

LOG_CHANNEL=stack
LOG_LEVEL=error

DB_CONNECTION=mysql
DB_HOST=localhost
DB_PORT=3306
DB_DATABASE=votre_database_hostinger
DB_USERNAME=votre_username_hostinger
DB_PASSWORD=votre_password_hostinger

BROADCAST_DRIVER=log
CACHE_DRIVER=file
FILESYSTEM_DISK=local
QUEUE_CONNECTION=sync
SESSION_DRIVER=file
SESSION_LIFETIME=120

SANCTUM_STATEFUL_DOMAINS=votre-domaine.com
SESSION_DOMAIN=.votre-domaine.com
```

---

## ÉTAPE 2: Créer la base de données sur Hostinger

### 2.1 Via le hPanel Hostinger

1. Connectez-vous à **hPanel Hostinger**
2. Allez dans **Bases de données** → **MySQL Databases**
3. Créez une nouvelle base de données:
   - Nom de la base: `u123456789_travelexpress`
   - Utilisateur: `u123456789_admin`
   - Mot de passe: (générez un mot de passe fort)
4. **Notez ces informations** pour le fichier `.env`

---

## ÉTAPE 3: Transférer les fichiers

### Option A: Via File Manager (Simple)

1. **Compresser le projet** en .zip (sans `node_modules` et `vendor`)
2. Dans hPanel → **File Manager**
3. Naviguer vers `public_html`
4. **Uploader le .zip** et l'extraire

### Option B: Via FTP/SFTP (Recommandé)

1. Télécharger **FileZilla** ou utiliser un client FTP
2. Informations de connexion (dans hPanel → Fichiers → Comptes FTP):
   - Hôte: `ftp.votre-domaine.com`
   - Utilisateur: votre username FTP
   - Mot de passe: votre mot de passe FTP
   - Port: 21 (FTP) ou 22 (SFTP)

3. **Transférer les fichiers**:
   - Tout le projet → `public_html/`

### Option C: Via SSH + Git (Pro)

```bash
# Se connecter en SSH
ssh u123456789@votre-domaine.com

# Aller dans le dossier
cd public_html

# Cloner le repo (si sur GitHub/GitLab)
git clone https://github.com/votre-repo/travel_express.git .

# Installer les dépendances
composer install --optimize-autoloader --no-dev
```

---

## ÉTAPE 4: Structure des dossiers sur Hostinger

### Structure IMPORTANTE:

```
public_html/
├── app/
├── bootstrap/
├── config/
├── database/
├── public/          ← Contenu à déplacer à la racine
│   ├── index.php   ← MODIFIER ce fichier
│   ├── .htaccess
│   └── build/
├── resources/
├── routes/
├── storage/
├── vendor/
├── .env             ← Créer avec les infos Hostinger
└── ...
```

### 4.1 Modifier le fichier index.php

Le fichier `public/index.php` doit être à la **racine** de `public_html`.

**Méthode 1: Déplacer le contenu de public/**

1. Déplacer tout le contenu de `public/` vers `public_html/`
2. Modifier `index.php`:

```php
<?php

use Illuminate\Contracts\Http\Kernel;
use Illuminate\Http\Request;

define('LARAVEL_START', microtime(true));

// Modifier ces chemins
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';

$kernel = $app->make(Kernel::class);

$response = $kernel->handle(
    $request = Request::capture()
)->send();

$kernel->terminate($request, $response);
```

**Méthode 2: Utiliser un sous-dossier (Recommandé)**

Structure:
```
public_html/
├── travel_express/     ← Tout le projet Laravel
│   ├── app/
│   ├── bootstrap/
│   ├── ...
│   └── public/
├── index.php           ← Nouveau fichier
└── .htaccess           ← Nouveau fichier
```

Créer `public_html/index.php`:
```php
<?php
require __DIR__.'/travel_express/public/index.php';
```

---

## ÉTAPE 5: Configurer .htaccess

### 5.1 Fichier .htaccess à la racine de public_html

```apache
<IfModule mod_rewrite.c>
    RewriteEngine On

    # Rediriger vers HTTPS
    RewriteCond %{HTTPS} off
    RewriteRule ^(.*)$ https://%{HTTP_HOST}%{REQUEST_URI} [L,R=301]

    # Rediriger vers le dossier public
    RewriteCond %{REQUEST_URI} !^/public/
    RewriteRule ^(.*)$ /public/$1 [L]
</IfModule>
```

### 5.2 Fichier .htaccess dans public/

```apache
<IfModule mod_rewrite.c>
    <IfModule mod_negotiation.c>
        Options -MultiViews -Indexes
    </IfModule>

    RewriteEngine On

    # Handle Authorization Header
    RewriteCond %{HTTP:Authorization} .
    RewriteRule .* - [E=HTTP_AUTHORIZATION:%{HTTP:Authorization}]

    # Redirect Trailing Slashes If Not A Folder...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_URI} (.+)/$
    RewriteRule ^ %1 [L,R=301]

    # Send Requests To Front Controller...
    RewriteCond %{REQUEST_FILENAME} !-d
    RewriteCond %{REQUEST_FILENAME} !-f
    RewriteRule ^ index.php [L]
</IfModule>
```

---

## ÉTAPE 6: Configuration finale

### 6.1 Permissions des dossiers

Via SSH ou File Manager, définir les permissions:

```bash
# Permissions des dossiers
chmod -R 755 storage
chmod -R 755 bootstrap/cache

# Créer le lien symbolique storage
php artisan storage:link
```

### 6.2 Exécuter les migrations

Via SSH:
```bash
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder --force
```

Ou via le **Terminal Hostinger** dans hPanel.

### 6.3 Vider les caches

```bash
php artisan config:clear
php artisan cache:clear
php artisan view:clear
php artisan route:clear

# Puis recréer les caches de production
php artisan config:cache
php artisan route:cache
php artisan view:cache
```

---

## ÉTAPE 7: Configurer le domaine SSL

1. Dans hPanel → **SSL**
2. Activer **Let's Encrypt SSL** (gratuit)
3. Attendre la propagation (quelques minutes)

---

## ÉTAPE 8: Vérifications finales

### Checklist:

- [ ] Site accessible via `https://votre-domaine.com`
- [ ] Page d'accueil s'affiche correctement
- [ ] Inscription fonctionne
- [ ] Connexion fonctionne
- [ ] Dashboard admin accessible (`/admin/dashboard`)
- [ ] Images et assets chargent correctement
- [ ] API fonctionne (`/api/testimonials`)

---

## 🚨 Résolution des problèmes courants

### Erreur 500:
```bash
# Vérifier les logs
cat storage/logs/laravel.log

# Permissions
chmod -R 775 storage bootstrap/cache
```

### Page blanche:
```bash
# Vérifier APP_DEBUG temporairement
# Dans .env: APP_DEBUG=true
# Puis voir l'erreur

# Vérifier les extensions PHP
php -m | grep -E "(pdo|mbstring|openssl|tokenizer|xml|ctype|json|bcmath)"
```

### Assets non chargés (CSS/JS):
```bash
# Vérifier APP_URL dans .env
# Doit correspondre à votre domaine exact

# Régénérer les assets
npm run build
```

### Base de données:
```bash
# Tester la connexion
php artisan tinker
>>> DB::connection()->getPdo();
```

---

## 📋 Récapitulatif des commandes

```bash
# En local - Préparation
composer install --optimize-autoloader --no-dev
npm run build
php artisan key:generate

# Sur Hostinger - Après upload
php artisan migrate --force
php artisan db:seed --class=AdminUserSeeder --force
php artisan storage:link
php artisan config:cache
php artisan route:cache
php artisan view:cache
chmod -R 775 storage bootstrap/cache
```

---

## 🎯 URLs après déploiement

- **Site public**: `https://votre-domaine.com`
- **Connexion**: `https://votre-domaine.com/login`
- **Inscription**: `https://votre-domaine.com/register`
- **Dashboard Admin**: `https://votre-domaine.com/admin/dashboard`
- **API**: `https://votre-domaine.com/api/testimonials`

---

## 📞 Support Hostinger

- **Chat en direct**: Disponible 24/7 dans hPanel
- **Documentation**: https://support.hostinger.com
- **Tutoriels Laravel**: https://www.hostinger.com/tutorials/how-to-deploy-laravel

---

## ⚠️ Notes importantes

1. **Backup régulier**: Activez les backups automatiques dans hPanel
2. **Mises à jour**: Gardez Laravel et les packages à jour
3. **Monitoring**: Vérifiez régulièrement les logs d'erreurs
4. **Sécurité**: Ne jamais exposer `.env` ou les fichiers sensibles
