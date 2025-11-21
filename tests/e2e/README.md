# Tests E2E Playwright - Travel Express

## 📋 Description

Suite de tests end-to-end pour le site Travel Express utilisant Playwright.

## 🚀 Installation

```bash
# Installer Playwright et les navigateurs
npm install -D @playwright/test
npx playwright install
```

## 🧪 Exécuter les Tests

### Tous les tests
```bash
npx playwright test
```

### Tests spécifiques
```bash
# Page d'accueil
npx playwright test homepage

# Destinations (Chine & Espagne)
npx playwright test destinations

# Navigation
npx playwright test navigation

# Animations
npx playwright test animations

# Accessibilité
npx playwright test accessibility
```

### Mode interactif (UI)
```bash
npx playwright test --ui
```

### Mode debug
```bash
npx playwright test --debug
```

### Un seul navigateur
```bash
# Chrome seulement
npx playwright test --project=chromium

# Firefox seulement
npx playwright test --project=firefox

# Mobile
npx playwright test --project="Mobile Chrome"
```

## 📊 Rapports

### Voir le rapport HTML
```bash
npx playwright show-report
```

### Traces de débogage
Les traces sont automatiquement capturées en cas d'échec.

```bash
npx playwright show-trace trace.zip
```

## 📁 Structure des Tests

```
tests/e2e/
├── homepage.spec.js       # Tests de la page d'accueil
├── destinations.spec.js   # Tests Chine & Espagne
├── navigation.spec.js     # Tests de navigation
├── animations.spec.js     # Tests des animations
├── accessibility.spec.js  # Tests d'accessibilité
└── README.md             # Ce fichier
```

## ✅ Couverture des Tests

### Homepage (`homepage.spec.js`)
- ✓ Chargement de la page
- ✓ Hero avec animations
- ✓ Boutons CTA
- ✓ Section étudiants africains
- ✓ Témoignages
- ✓ Programmes académiques
- ✓ Navigation desktop
- ✓ Indicateur de scroll
- ✓ Responsive mobile

### Destinations (`destinations.spec.js`)
- ✓ Section destinations
- ✓ Chine - informations complètes
- ✓ Chine - statistiques
- ✓ Chine - témoignages
- ✓ Chine - CTA buttons
- ✓ Espagne - informations complètes
- ✓ Espagne - universités
- ✓ Espagne - statistiques
- ✓ Espagne - témoignages
- ✓ Banner conseillers spécialisés
- ✓ Galeries photo
- ✓ Effets hover

### Navigation (`navigation.spec.js`)
- ✓ Smooth scroll vers sections
- ✓ Bouton scroll to top
- ✓ Bouton WhatsApp flottant
- ✓ Footer - tous les liens
- ✓ Footer - newsletter
- ✓ Footer - réseaux sociaux
- ✓ Mentions légales
- ✓ Copyright
- ✓ Boutons CTA
- ✓ Menu mobile

### Animations (`animations.spec.js`)
- ✓ Hero - animations au chargement
- ✓ Slide background
- ✓ Glassmorphism effect
- ✓ Photos - hover zoom
- ✓ Cards - hover effects
- ✓ Boutons - hover et scale
- ✓ Scroll indicator
- ✓ Gradient text
- ✓ Transitions smooth
- ✓ Backdrop blur
- ✓ Shadow effects
- ✓ Floating elements
- ✓ Stagger animations
- ✓ Performance

### Accessibilité (`accessibility.spec.js`)
- ✓ Balises meta
- ✓ Alt text sur images
- ✓ Structure HTML sémantique
- ✓ Hiérarchie des headings
- ✓ Liens descriptifs
- ✓ Navigation clavier
- ✓ Contraste des couleurs
- ✓ Formulaire labels
- ✓ Responsive mobile
- ✓ Responsive tablet
- ✓ Performance temps de chargement
- ✓ Aucune erreur JavaScript
- ✓ Liens externes
- ✓ Fonts Google
- ✓ Smooth scrolling

## 🎯 CI/CD

Ces tests peuvent être intégrés dans votre pipeline CI/CD:

```yaml
# .github/workflows/playwright.yml
name: Playwright Tests
on: [push, pull_request]
jobs:
  test:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v3
      - uses: actions/setup-node@v3
      - name: Install dependencies
        run: npm ci
      - name: Install Playwright
        run: npx playwright install --with-deps
      - name: Run tests
        run: npx playwright test
      - uses: actions/upload-artifact@v3
        if: always()
        with:
          name: playwright-report
          path: playwright-report/
```

## 🔧 Configuration

La configuration se trouve dans `playwright.config.js`:
- Timeout: 30 secondes par test
- Retries: 2 en CI, 0 en local
- Navigateurs: Chrome, Firefox, Safari, Mobile
- Screenshots: uniquement en cas d'échec
- Vidéos: conservées en cas d'échec
- Server: Laravel (php artisan serve)

## 📈 Métriques de Qualité

Objectifs de qualité:
- ✅ 100% des tests doivent passer
- ✅ Temps de chargement < 5 secondes
- ✅ Aucune erreur JavaScript
- ✅ Score d'accessibilité élevé
- ✅ Responsive sur tous les devices

## 🐛 Débogage

### Échec de test
1. Vérifiez les screenshots dans `test-results/`
2. Regardez la vidéo de l'échec
3. Exécutez en mode debug: `npx playwright test --debug`

### Problèmes courants
- **Server non démarré**: Vérifiez que Laravel tourne sur port 8000
- **Timeout**: Augmentez le timeout dans `playwright.config.js`
- **Sélecteur introuvable**: Vérifiez que l'élément existe avec `--debug`

## 📞 Support

Pour toute question sur les tests:
- Documentation Playwright: https://playwright.dev
- Issues GitHub: créer une issue dans le repo

---

**Dernière mise à jour**: 2025-01-09
**Version Playwright**: 1.56.1
