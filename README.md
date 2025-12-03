# Application Laravel - Plateforme Culturelle Béninoise

Application web Laravel pour la gestion et la diffusion de contenus culturels béninois avec système de paiement intégré via Fedapay.

## Fonctionnalités

- 📝 Gestion de contenus culturels (articles, recettes, histoire)
- 👥 Système d'authentification et de rôles
- 💳 Paiement par article via Fedapay (Mobile Money & Cartes bancaires)
- 🌍 Support multilingue
- 📍 Gestion par régions
- 🖼️ Gestion de médias
- 💬 Système de commentaires
- 🔐 Modération de contenu

## Prérequis

- PHP 8.2 ou supérieur
- Composer
- Node.js & NPM
- SQLite (ou MySQL/PostgreSQL)

## Installation locale

1. Cloner le repository
```bash
git clone <votre-repo>
cd culture
```

2. Installer les dépendances
```bash
composer install
npm install
```

3. Configurer l'environnement
```bash
cp .env.example .env
php artisan key:generate
```

4. Configurer la base de données dans `.env`
```
DB_CONNECTION=sqlite
```

5. Exécuter les migrations
```bash
php artisan migrate
```

6. Compiler les assets
```bash
npm run build
```

7. Lancer le serveur
```bash
php artisan serve
```

## Configuration Fedapay

Pour activer les paiements, ajoutez vos clés Fedapay dans `.env`:

```
FEDAPAY_PUBLIC_KEY=your_public_key
FEDAPAY_SECRET_KEY=your_secret_key
FEDAPAY_MODE=sandbox
FEDAPAY_WEBHOOK_SECRET=your_webhook_secret
```

## Déploiement sur Railway

1. Connectez votre repository GitHub à Railway
2. Configurez les variables d'environnement dans Railway
3. Railway détectera automatiquement le projet Laravel et le déploiera

Variables d'environnement requises:
- `APP_KEY`
- `APP_URL`
- `DB_CONNECTION`
- `FEDAPAY_PUBLIC_KEY`
- `FEDAPAY_SECRET_KEY`
- `FEDAPAY_MODE`

## Structure du projet

- `app/Models` - Modèles Eloquent
- `app/Http/Controllers` - Contrôleurs
- `app/Services` - Services métier (Fedapay, ContentPurchase)
- `database/migrations` - Migrations de base de données
- `resources/views` - Vues Blade
- `routes` - Fichiers de routes

## Licence

MIT
