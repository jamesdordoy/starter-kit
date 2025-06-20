import { test } from './coverage-utils';

test('register test', async ({ page }) => {
    await page.goto('https://starter-kit.test/register');
    await page.getByRole('textbox', { name: 'Name' }).fill('tester');
    await page.getByRole('textbox', { name: 'Name' }).press('Tab');
    await page.getByRole('textbox', { name: 'Email address' }).fill('tester@test.com');
    await page.getByRole('textbox', { name: 'Email address' }).press('Tab');
    await page.getByRole('textbox', { name: 'Password', exact: true }).fill('password');
    await page.getByRole('textbox', { name: 'Password', exact: true }).press('Tab');
    await page.getByRole('textbox', { name: 'Confirm password' }).fill('password');
    await Promise.all([
        page.waitForNavigation(),
        page.getByRole('button', { name: 'Create account' }).click(),
    ]);
});
