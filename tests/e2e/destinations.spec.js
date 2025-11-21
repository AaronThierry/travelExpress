import { test, expect } from '@playwright/test';

test.describe('Section Destinations - Chine & Espagne', () => {

  test.beforeEach(async ({ page }) => {
    await page.goto('/');
    // Naviguer vers la section destinations
    await page.locator('a:has-text("Destinations")').click();
  });

  test('devrait afficher la section destinations', async ({ page }) => {
    // Vérifier le titre de la section
    await expect(page.locator('text=Destinations Phares')).toBeVisible();
    await expect(page.locator('text=Nous Vous Accompagnons Vers')).toBeVisible();
  });

  test('Chine - devrait afficher toutes les informations', async ({ page }) => {
    // Scroll vers la section Chine
    await page.locator('text=Chine').first().scrollIntoViewIfNeeded();

    // Vérifier le drapeau et titre
    await expect(page.locator('text=🇨🇳')).toBeVisible();
    await expect(page.locator('text=中国 - Zhōngguó')).toBeVisible();

    // Vérifier les avantages
    await expect(page.locator('text=Bourses CSC Complètes')).toBeVisible();
    await expect(page.locator('text=Universités de Renommée Mondiale')).toBeVisible();
    await expect(page.locator('text=Programmes en Anglais')).toBeVisible();
    await expect(page.locator('text=Coût de Vie Très Abordable')).toBeVisible();

    // Vérifier les universités mentionnées
    await expect(page.locator('text=Tsinghua')).toBeVisible();
    await expect(page.locator('text=Peking University')).toBeVisible();
  });

  test('Chine - statistiques', async ({ page }) => {
    await page.locator('text=Chine').first().scrollIntoViewIfNeeded();

    // Vérifier les statistiques
    await expect(page.locator('text=350+')).toBeVisible();
    await expect(page.locator('text=Étudiants en Chine')).toBeVisible();
    await expect(page.locator('text=95%')).toBeVisible();
    await expect(page.locator('text=Taux d\'Admission')).toBeVisible();
  });

  test('Chine - témoignages', async ({ page }) => {
    await page.locator('text=Ce Que Disent Nos Étudiants en Chine').scrollIntoViewIfNeeded();

    // Vérifier les témoignages
    await expect(page.locator('text=Fatima Ouédraogo')).toBeVisible();
    await expect(page.locator('text=Abdoulaye Sawadogo')).toBeVisible();
  });

  test('Chine - CTA buttons', async ({ page }) => {
    await page.locator('text=Prêt à Étudier en Chine').scrollIntoViewIfNeeded();

    // Vérifier les boutons d'action
    await expect(page.locator('button:has-text("Contactez-nous")')).toBeVisible();
    await expect(page.locator('button:has-text("Télécharger la Brochure")')).toBeVisible();
  });

  test('Espagne - devrait afficher toutes les informations', async ({ page }) => {
    // Scroll vers la section Espagne
    await page.locator('text=Espagne').first().scrollIntoViewIfNeeded();

    // Vérifier le drapeau et titre
    await expect(page.locator('text=🇪🇸')).toBeVisible();
    await expect(page.locator('text=España')).toBeVisible();

    // Vérifier les avantages
    await expect(page.locator('text=Diplômes Reconnus dans toute l\'UE')).toBeVisible();
    await expect(page.locator('text=Universités d\'Excellence')).toBeVisible();
    await expect(page.locator('text=Bourses et Aides Financières')).toBeVisible();
    await expect(page.locator('text=Permis de Travail Post-Études')).toBeVisible();
  });

  test('Espagne - universités mentionnées', async ({ page }) => {
    await page.locator('text=Espagne').first().scrollIntoViewIfNeeded();

    // Vérifier les universités
    await expect(page.locator('text=Universitat de Barcelona')).toBeVisible();
    await expect(page.locator('text=Complutense')).toBeVisible();
    await expect(page.locator('text=IE Business School')).toBeVisible();
  });

  test('Espagne - statistiques', async ({ page }) => {
    await page.locator('text=Espagne').first().scrollIntoViewIfNeeded();

    // Vérifier les statistiques
    await expect(page.locator('text=200+')).toBeVisible();
    await expect(page.locator('text=Étudiants en Espagne')).toBeVisible();
    await expect(page.locator('text=92%')).toBeVisible();
  });

  test('Espagne - témoignages', async ({ page }) => {
    await page.locator('text=Témoignages de Nos Étudiants en Espagne').scrollIntoViewIfNeeded();

    // Vérifier les témoignages
    await expect(page.locator('text=Kadidia Traoré')).toBeVisible();
    await expect(page.locator('text=Souleymane Koné')).toBeVisible();
  });

  test('devrait afficher le banner des conseillers spécialisés', async ({ page }) => {
    await page.locator('text=Nos Conseillers Spécialisés').scrollIntoViewIfNeeded();

    // Vérifier le contenu du banner
    await expect(page.locator('text=Accompagnement en français')).toBeVisible();
    await expect(page.locator('text=Support visa garanti')).toBeVisible();
    await expect(page.locator('text=Réseau d\'anciens étudiants')).toBeVisible();
  });

  test('images - devrait charger les galeries photo', async ({ page }) => {
    // Vérifier que les images de galerie sont chargées
    const images = page.locator('img[alt*="Campus"]');
    await expect(images.first()).toBeVisible();
  });

  test('hover effects - cartes avantages', async ({ page }) => {
    await page.locator('text=Bourses CSC Complètes').scrollIntoViewIfNeeded();

    // Vérifier qu'on peut hover sur une carte
    const card = page.locator('text=Bourses CSC Complètes').locator('..');
    await card.hover();

    // La carte devrait toujours être visible après hover
    await expect(card).toBeVisible();
  });
});
