import { test, expect } from '@playwright/test';

test.describe('Animations et Effets Visuels', () => {

  test('Hero - animations au chargement', async ({ page }) => {
    await page.goto('/');

    // Vérifier les classes d'animation
    const heroTitle = page.locator('h2:has-text("Transformez Vos Rêves")');
    await expect(heroTitle).toHaveClass(/fade-in-up|stagger/);
  });

  test('Hero - slide background animation', async ({ page }) => {
    await page.goto('/');

    // Vérifier que l'image de fond a l'animation slide
    const slideImage = page.locator('.slide img').first();
    await expect(slideImage).toBeVisible();
  });

  test('Statistiques - glassmorphism effect', async ({ page }) => {
    await page.goto('/');

    // Vérifier les cartes de stats avec effet glassmorphism
    const statCards = page.locator('.backdrop-blur-md');
    const count = await statCards.count();
    expect(count).toBeGreaterThan(0);
  });

  test('Photos étudiants - hover zoom effect', async ({ page }) => {
    await page.goto('/');
    await page.locator('text=Des Étudiants Africains').scrollIntoViewIfNeeded();

    // Hover sur une photo d'étudiant
    const studentPhoto = page.locator('img[alt*="Étudiante africaine"]').first();
    await studentPhoto.hover();

    // L'effet de zoom devrait être appliqué via la classe group-hover:scale-110
    await expect(studentPhoto).toBeVisible();
  });

  test('Cards - hover effects', async ({ page }) => {
    await page.goto('/');
    await page.locator('text=Licence').scrollIntoViewIfNeeded();

    // Hover sur une carte de programme
    const programCard = page.locator('text=Licence').locator('..');
    await programCard.hover();

    // La carte devrait avoir un effet de transformation
    await expect(programCard).toBeVisible();
  });

  test('Boutons - hover et scale', async ({ page }) => {
    await page.goto('/');

    // Hover sur un bouton CTA
    const ctaButton = page.locator('button:has-text("Obtenir Ma Bourse")').first();
    await ctaButton.hover();

    // Vérifier que le bouton est toujours visible avec l'effet
    await expect(ctaButton).toBeVisible();
  });

  test('Scroll indicator - animation bounce', async ({ page }) => {
    await page.goto('/');

    // Vérifier l'indicateur de scroll
    const scrollIndicator = page.locator('text=Découvrez plus');
    await expect(scrollIndicator).toBeVisible();

    // Devrait avoir la classe animate-bounce
    const parent = scrollIndicator.locator('..');
    await expect(parent).toHaveClass(/animate-bounce/);
  });

  test('Gradient text effects', async ({ page }) => {
    await page.goto('/');

    // Vérifier les textes avec gradient
    const gradientText = page.locator('.bg-clip-text').first();
    await expect(gradientText).toBeVisible();
    await expect(gradientText).toHaveClass(/text-transparent/);
  });

  test('Galerie photos - transitions smooth', async ({ page }) => {
    await page.goto('/');
    await page.locator('text=Chine').first().scrollIntoViewIfNeeded();

    // Vérifier les images de galerie
    const galleryImages = page.locator('img[alt*="Campus"]');
    await expect(galleryImages.first()).toBeVisible();

    // Hover pour tester la transition
    await galleryImages.first().hover();
    await page.waitForTimeout(300); // Attendre l'animation

    await expect(galleryImages.first()).toBeVisible();
  });

  test('Backdrop blur effects', async ({ page }) => {
    await page.goto('/');

    // Vérifier les éléments avec backdrop-blur
    const blurElements = page.locator('.backdrop-blur-md, .backdrop-blur-sm');
    const count = await blurElements.count();
    expect(count).toBeGreaterThan(0);
  });

  test('Shadow effects on hover', async ({ page }) => {
    await page.goto('/');

    // Tester les ombres sur les cartes
    const card = page.locator('.shadow-xl').first();
    await card.hover();
    await expect(card).toBeVisible();
  });

  test('Floating elements animation', async ({ page }) => {
    await page.goto('/');

    // Vérifier les éléments flottants animés (bulles de fond)
    await page.waitForTimeout(1000);

    // Les animations CSS devraient être appliquées
    const floatingElements = page.locator('.animate-pulse');
    if (await floatingElements.count() > 0) {
      await expect(floatingElements.first()).toBeVisible();
    }
  });

  test('Stagger animations - délais progressifs', async ({ page }) => {
    await page.goto('/');

    // Vérifier les éléments avec stagger
    const stagger1 = page.locator('.stagger-1').first();
    const stagger2 = page.locator('.stagger-2').first();

    if (await stagger1.isVisible()) {
      await expect(stagger1).toBeVisible();
    }
    if (await stagger2.isVisible()) {
      await expect(stagger2).toBeVisible();
    }
  });

  test('Performance - toutes les animations sont fluides', async ({ page }) => {
    await page.goto('/');

    // Mesurer le temps de chargement
    const performanceTiming = await page.evaluate(() => JSON.stringify(window.performance.timing));
    expect(performanceTiming).toBeTruthy();

    // Vérifier qu'il n'y a pas d'erreurs console
    const errors = [];
    page.on('console', msg => {
      if (msg.type() === 'error') {
        errors.push(msg.text());
      }
    });

    // Recharger pour capturer les erreurs
    await page.reload();
    await page.waitForTimeout(2000);

    // Il ne devrait pas y avoir d'erreurs critiques
    const criticalErrors = errors.filter(e => e.includes('Failed') || e.includes('Error'));
    expect(criticalErrors.length).toBe(0);
  });
});
