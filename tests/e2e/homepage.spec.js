import { test, expect } from '@playwright/test';

test.describe('Page d\'accueil Travel Express', () => {

  test('devrait charger la page d\'accueil correctement', async ({ page }) => {
    await page.goto('/');

    // Vérifier le titre de la page
    await expect(page).toHaveTitle(/Travel Express/);

    // Vérifier que le logo est visible dans la navbar
    await expect(page.locator('h1:has-text("Travel Express")')).toBeVisible();
  });

  test('devrait afficher le hero avec les animations', async ({ page }) => {
    await page.goto('/');

    // Vérifier le titre principal
    await expect(page.locator('h2:has-text("Transformez Vos Rêves")')).toBeVisible();
    await expect(page.locator('text=en Diplômes Internationaux')).toBeVisible();

    // Vérifier les statistiques (use first() for duplicates)
    await expect(page.locator('.text-4xl.font-black:has-text("1000+")').first()).toBeVisible();
    await expect(page.locator('.text-4xl.font-black:has-text("98%")').first()).toBeVisible();
    await expect(page.locator('.text-4xl.font-black:has-text("35")').first()).toBeVisible();
    await expect(page.locator('.text-4xl.font-black:has-text("500+")').first()).toBeVisible();
  });

  test('devrait afficher les boutons CTA', async ({ page }) => {
    await page.goto('/');

    // Vérifier les boutons principaux (use first() since there are multiple CTA buttons)
    await expect(page.locator('button:has-text("Contactez-nous")').first()).toBeVisible();
  });

  test('devrait afficher la section des étudiants africains', async ({ page }) => {
    await page.goto('/');

    // Scroll vers la section
    await page.locator('text=Des Étudiants Africains').scrollIntoViewIfNeeded();

    // Vérifier le titre de la section
    await expect(page.locator('text=Qui Excel')).toBeVisible();

    // Vérifier les photos d'étudiants
    await expect(page.locator('text=Aminata K.')).toBeVisible();
    await expect(page.locator('text=Moussa T.')).toBeVisible();
    await expect(page.locator('text=Fatima S.')).toBeVisible();
    await expect(page.locator('text=Ibrahim D.')).toBeVisible();
  });

  test('devrait afficher le témoignage en vedette', async ({ page }) => {
    await page.goto('/');

    // Scroll vers les témoignages
    await page.locator('text=Fatima Ouédraogo').first().scrollIntoViewIfNeeded();

    // Vérifier le témoignage (use first() for duplicates)
    await expect(page.locator('text=Fatima Ouédraogo').first()).toBeVisible();
    await expect(page.locator('text=Travel Express a littéralement changé ma vie').first()).toBeVisible();
    await expect(page.locator('text=★★★★★').first()).toBeVisible();
  });

  test('devrait afficher les programmes académiques', async ({ page }) => {
    await page.goto('/');

    // Vérifier que la section destinations (qui inclut les programmes) est visible
    await page.locator('text=Destinations Phares').scrollIntoViewIfNeeded();
    await expect(page.locator('text=Destinations Phares')).toBeVisible();
  });

  test('navigation - menu desktop', async ({ page }) => {
    await page.goto('/');

    // Vérifier tous les liens du menu
    await expect(page.locator('a:has-text("Accueil")')).toBeVisible();
    await expect(page.locator('a:has-text("Programmes")')).toBeVisible();
    await expect(page.locator('a:has-text("Destinations")')).toBeVisible();
    await expect(page.locator('a:has-text("Services")')).toBeVisible();
    await expect(page.locator('a:has-text("Contact")')).toBeVisible();
  });

  test('devrait avoir un indicateur de scroll animé', async ({ page }) => {
    await page.goto('/');

    // Vérifier l'indicateur de scroll
    await expect(page.locator('text=Découvrez plus')).toBeVisible();
  });

  test('responsive - devrait être mobile-friendly', async ({ page }) => {
    // Définir la taille de viewport mobile
    await page.setViewportSize({ width: 375, height: 667 });
    await page.goto('/');

    // Vérifier que le contenu est visible sur mobile
    await expect(page.locator('h1:has-text("Travel Express")')).toBeVisible();
    await expect(page.locator('h2:has-text("Transformez Vos Rêves")')).toBeVisible();
  });
});
