// import { test } from '@playwright/test';

import { test, expect } from './coverage-utils';

// import { test, expect } from '@playwright/test';

// test.beforeEach(async ({ page }) => {
//   // Wait for Inertia to hydrate by targeting a known marker element
//   await page.waitForSelector('#app');

//   // OR use a general wait for JS rendering (not ideal but works as fallback)
//   // await page.waitForLoadState('networkidle');
// });


test('login test', async ({ page }) => {
  await page.goto('/login');

  // ⏳ Wait for Inertia hydration to finish
  await page.getByRole('textbox', { name: 'Email address' }).waitFor({ timeout: 15000 });

  await page.getByRole('textbox', { name: 'Email address' }).fill('admin@admin.com');
  await page.getByRole('textbox', { name: 'Password' }).fill('password');
  await page.getByRole('button', { name: 'Log in' }).click();

  await expect(page).toHaveURL('/login');
});
