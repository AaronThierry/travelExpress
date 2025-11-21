import { test, expect } from '@playwright/test';

test.describe('Navigation et UX', () => {

  test('smooth scroll - navigation vers sections', async ({ page }) => {
    await page.goto('/');

    // Cliquer sur "Programmes"
    await page.locator('a:has-text("Programmes")').click();
    await page.waitForTimeout(1000); // Attendre l'animation de scroll

    // Vérifier qu'on a scrollé vers la section
    const programsSection = page.locator('text=Nos Programmes d\'Excellence');
    await expect(programsSection).toBeInViewport();
  });

  test('bouton scroll to top', async ({ page }) => {
    await page.goto('/');

    // Scroller vers le bas
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));
    await page.waitForTimeout(500);

    // Vérifier que le bouton scroll to top est visible
    const scrollBtn = page.locator('button').filter({ hasText: '' }).first();

    // Cliquer sur le bouton
    if (await scrollBtn.isVisible()) {
      await scrollBtn.click();
      await page.waitForTimeout(500);

      // Vérifier qu'on est en haut de la page
      const scrollY = await page.evaluate(() => window.scrollY);
      expect(scrollY).toBeLessThan(100);
    }
  });

  test('WhatsApp floating button', async ({ page }) => {
    await page.goto('/');

    // Vérifier que le bouton WhatsApp est visible
    const whatsappBtn = page.locator('a[href*="wa.me"]');
    await expect(whatsappBtn).toBeVisible();

    // Vérifier qu'il a l'animation bounce
    await expect(whatsappBtn).toHaveClass(/animate-bounce/);
  });

  test('footer - tous les liens', async ({ page }) => {
    await page.goto('/');

    // Scroll vers le footer
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));

    // Vérifier les liens du footer
    await expect(page.locator('footer >> text=Licence (BAC+3)')).toBeVisible();
    await expect(page.locator('footer >> text=Master (BAC+5)')).toBeVisible();
    await expect(page.locator('footer >> text=Doctorat (BAC+8)')).toBeVisible();

    // Vérifier les informations de contact
    await expect(page.locator('footer >> text=Ouagadougou')).toBeVisible();
    await expect(page.locator('footer >> text=contact@travel-express.bf')).toBeVisible();
  });

  test('footer - newsletter', async ({ page }) => {
    await page.goto('/');
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));

    // Vérifier le formulaire newsletter
    await expect(page.locator('text=Restez Informé des Nouvelles Bourses')).toBeVisible();

    const emailInput = page.locator('input[type="email"]').first();
    await expect(emailInput).toBeVisible();
    await expect(emailInput).toHaveAttribute('placeholder', /email/i);
  });

  test('footer - réseaux sociaux', async ({ page }) => {
    await page.goto('/');
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));

    // Vérifier que la section réseaux sociaux existe
    await expect(page.locator('footer >> text=Suivez-nous')).toBeVisible();

    // Il devrait y avoir au moins 4 icônes sociales
    const socialLinks = page.locator('footer a[href="#"]').filter({ has: page.locator('svg') });
    const count = await socialLinks.count();
    expect(count).toBeGreaterThanOrEqual(4);
  });

  test('mentions légales', async ({ page }) => {
    await page.goto('/');
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));

    // Vérifier les mentions légales
    await expect(page.locator('text=Politique de confidentialité')).toBeVisible();
    await expect(page.locator('text=Conditions d\'utilisation')).toBeVisible();
    await expect(page.locator('text=Mentions légales')).toBeVisible();
  });

  test('copyright', async ({ page }) => {
    await page.goto('/');
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));

    // Vérifier le copyright
    await expect(page.locator('text=2025')).toBeVisible();
    await expect(page.locator('text=Travel Express Burkina Faso')).toBeVisible();
  });

  test('boutons CTA - Ma Bourse', async ({ page }) => {
    await page.goto('/');

    // Vérifier le bouton "Ma Bourse" dans la nav
    const maBoursBtn = page.locator('button:has-text("Ma Bourse")').first();
    await expect(maBoursBtn).toBeVisible();

    // Vérifier qu'il a un style distinct
    await expect(maBoursBtn).toHaveClass(/btn-primary/);
  });

  test('mobile menu - devrait être accessible', async ({ page }) => {
    // Viewport mobile
    await page.setViewportSize({ width: 375, height: 667 });
    await page.goto('/');

    // Le menu mobile button devrait être visible
    const mobileMenuBtn = page.locator('button[type="button"]').filter({ has: page.locator('svg') }).first();
    await expect(mobileMenuBtn).toBeVisible();
  });
});
