import { test, expect } from '@playwright/test';

test('login', async ({ page }) => {

  test('test', async ({ page }) => {
    await page.goto('https://starter-kit.test/');
    await page.getByRole('link', { name: 'Log in' }).click();
    await page.getByRole('textbox', { name: 'Email address' }).click();
    await page.getByRole('textbox', { name: 'Email address' }).fill('admin@admin.com');
    await page.getByRole('textbox', { name: 'Email address' }).press('Tab');
    await page.getByRole('textbox', { name: 'Password' }).fill('password');
    await page.getByRole('button', { name: 'Log in' }).click();
  });
});
