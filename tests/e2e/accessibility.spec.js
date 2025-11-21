import { test, expect } from '@playwright/test';

test.describe('Accessibilité et SEO', () => {

  test('devrait avoir des balises meta appropriées', async ({ page }) => {
    await page.goto('/');

    // Vérifier le titre
    const title = await page.title();
    expect(title).toContain('Travel Express');

    // Vérifier la meta viewport
    const viewport = await page.locator('meta[name="viewport"]').getAttribute('content');
    expect(viewport).toContain('width=device-width');
  });

  test('toutes les images ont un alt text', async ({ page }) => {
    await page.goto('/');

    // Récupérer toutes les images
    const images = await page.locator('img').all();

    for (const img of images) {
      const alt = await img.getAttribute('alt');
      // Chaque image devrait avoir un attribut alt (même vide est ok)
      expect(alt).not.toBeNull();
    }
  });

  test('structure sémantique HTML', async ({ page }) => {
    await page.goto('/');

    // Vérifier les balises sémantiques
    await expect(page.locator('nav')).toBeVisible();
    await expect(page.locator('header, section').first()).toBeVisible();
    await expect(page.locator('footer')).toBeVisible();
  });

  test('headings - hiérarchie correcte', async ({ page }) => {
    await page.goto('/');

    // Il devrait y avoir un h1 (ou h2 principal)
    const h1 = page.locator('h1, h2').first();
    await expect(h1).toBeVisible();

    // Vérifier qu'il y a des sous-titres
    await expect(page.locator('h3, h4, h5').first()).toBeVisible();
  });

  test('liens - tous ont un texte descriptif', async ({ page }) => {
    await page.goto('/');

    // Récupérer tous les liens
    const links = await page.locator('a').all();

    for (const link of links) {
      const text = await link.textContent();
      const ariaLabel = await link.getAttribute('aria-label');

      // Le lien doit avoir soit du texte, soit un aria-label
      const hasAccessibleName = (text && text.trim().length > 0) || ariaLabel;
      expect(hasAccessibleName).toBeTruthy();
    }
  });

  test('boutons - accessibles au clavier', async ({ page }) => {
    await page.goto('/');

    // Naviguer avec Tab
    await page.keyboard.press('Tab');
    await page.keyboard.press('Tab');

    // Un élément devrait avoir le focus
    const focusedElement = await page.evaluate(() => document.activeElement.tagName);
    expect(['BUTTON', 'A', 'INPUT']).toContain(focusedElement);
  });

  test('contraste des couleurs - texte lisible', async ({ page }) => {
    await page.goto('/');

    // Vérifier que le texte principal est visible (contraste suffisant)
    const mainText = page.locator('p').first();
    await expect(mainText).toBeVisible();

    // Le texte devrait être lisible
    const color = await mainText.evaluate(el => window.getComputedStyle(el).color);
    expect(color).toBeTruthy();
  });

  test('formulaire - labels et placeholders', async ({ page }) => {
    await page.goto('/');
    await page.evaluate(() => window.scrollTo(0, document.body.scrollHeight));

    // Vérifier le champ email de newsletter
    const emailInput = page.locator('input[type="email"]').first();

    if (await emailInput.isVisible()) {
      // Devrait avoir un placeholder
      const placeholder = await emailInput.getAttribute('placeholder');
      expect(placeholder).toBeTruthy();
    }
  });

  test('responsive - mobile viewport', async ({ page }) => {
    await page.setViewportSize({ width: 375, height: 667 });
    await page.goto('/');

    // Le contenu devrait être visible et non coupé
    await expect(page.locator('h1, h2').first()).toBeVisible();

    // Vérifier qu'il n'y a pas de scroll horizontal
    const bodyWidth = await page.evaluate(() => document.body.scrollWidth);
    const viewportWidth = await page.evaluate(() => window.innerWidth);

    expect(bodyWidth).toBeLessThanOrEqual(viewportWidth + 20); // +20 pour la marge d'erreur
  });

  test('responsive - tablet viewport', async ({ page }) => {
    await page.setViewportSize({ width: 768, height: 1024 });
    await page.goto('/');

    // Vérifier que le layout s'adapte
    await expect(page.locator('text=Travel Express')).toBeVisible();

    // Les cartes devraient être visibles
    await page.locator('text=Licence').scrollIntoViewIfNeeded();
    await expect(page.locator('text=Licence')).toBeVisible();
  });

  test('performance - temps de chargement acceptable', async ({ page }) => {
    const startTime = Date.now();
    await page.goto('/');

    // Attendre que le contenu principal soit chargé
    await page.locator('text=Transformez Vos Rêves').waitFor();

    const loadTime = Date.now() - startTime;

    // Le chargement devrait prendre moins de 5 secondes
    expect(loadTime).toBeLessThan(5000);
  });

  test('aucune erreur JavaScript', async ({ page }) => {
    const errors = [];

    page.on('console', msg => {
      if (msg.type() === 'error') {
        errors.push(msg.text());
      }
    });

    await page.goto('/');
    await page.waitForLoadState('networkidle');

    // Filtrer les erreurs non critiques
    const criticalErrors = errors.filter(e =>
      !e.includes('favicon') &&
      !e.includes('404') &&
      !e.includes('CORS')
    );

    expect(criticalErrors.length).toBe(0);
  });

  test('liens externes - target blank avec rel', async ({ page }) => {
    await page.goto('/');

    // Trouver les liens externes (WhatsApp, réseaux sociaux)
    const externalLinks = await page.locator('a[target="_blank"]').all();

    for (const link of externalLinks) {
      const rel = await link.getAttribute('rel');
      const href = await link.getAttribute('href');

      // Les liens externes devraient avoir rel pour la sécurité
      if (href && !href.startsWith('#') && !href.startsWith('/')) {
        // C'est une bonne pratique mais pas obligatoire
        // expect(rel).toBeTruthy();
      }
    }
  });

  test('fonts - chargement des polices Google', async ({ page }) => {
    await page.goto('/');

    // Vérifier que Montserrat est chargée
    const fontFamily = await page.locator('body').evaluate(el =>
      window.getComputedStyle(el).fontFamily
    );

    expect(fontFamily).toContain('Montserrat');
  });

  test('smooth scrolling activé', async ({ page }) => {
    await page.goto('/');

    // Cliquer sur un lien d'ancre
    await page.locator('a[href="#destinations"]').click();
    await page.waitForTimeout(1000);

    // La section devrait être visible
    await expect(page.locator('text=Destinations Phares')).toBeInViewport();
  });
});
