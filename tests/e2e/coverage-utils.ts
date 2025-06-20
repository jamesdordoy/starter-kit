import fs from 'fs';
import path from 'path';
import { test as base, expect } from '@playwright/test';

// Extend the base test
const test = base.extend({});

// Add afterEach hook to save coverage
// Add debug log

test.afterEach(async ({ page }, testInfo) => {
  const coverage = await page.evaluate(() => window.__coverage__);
  if (coverage) {
    const dir = path.resolve('.nyc_output');
    fs.mkdirSync(dir, { recursive: true });

    const name = `coverage-${testInfo.title.replace(/\s+/g, '-')}-${Date.now()}.json`;
    fs.writeFileSync(path.join(dir, name), JSON.stringify(coverage));
  }
});

export { test, expect };
