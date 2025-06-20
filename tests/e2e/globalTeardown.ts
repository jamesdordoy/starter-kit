import fs from 'fs';
import path from 'path';

export default async () => {
  const coverage = await globalThis.__coverage__;
  if (coverage) {
    const outDir = path.join(process.cwd(), '.nyc_output');
    fs.mkdirSync(outDir, { recursive: true });
    fs.writeFileSync(path.join(outDir, 'out.json'), JSON.stringify(coverage));
  }
};