import puppeteer from 'puppeteer-core';
import fs from 'fs';
import path from 'path';

const chromePath = 'C:\\Program Files\\Google\\Chrome\\Application\\chrome.exe';
const baseUrl = 'http://127.0.0.1:8000';
const outputDir = path.resolve('screenshots');
const artifactDir = 'C:\\Users\\Bagas Syahputra\\.gemini\\antigravity-ide\\brain\\67ec7778-4a62-462d-affa-25bde05ebff7';

async function main() {
  console.log('Launching browser with Chrome at:', chromePath);
  const browser = await puppeteer.launch({
    executablePath: chromePath,
    headless: true,
    args: ['--no-sandbox', '--disable-setuid-sandbox', '--window-size=1440,900']
  });

  const page = await browser.newPage();
  await page.setViewport({ width: 1440, height: 900, deviceScaleFactor: 1.5 });

  async function snap(filename, url, fullPage = false) {
    console.log(`Navigating to ${url}...`);
    await page.goto(url, { waitUntil: 'networkidle2' });
    await new Promise(r => setTimeout(r, 1000));
    const dest1 = path.join(outputDir, filename);
    const dest2 = path.join(artifactDir, filename);
    await page.screenshot({ path: dest1, fullPage });
    fs.copyFileSync(dest1, dest2);
    console.log(`Captured ${filename}`);
  }

  // 1. Landing Page (Home)
  await snap('01_landing_page.png', `${baseUrl}/`, false);

  // 2. Katalog Kursus
  await snap('02_katalog_kursus.png', `${baseUrl}/courses`, false);

  // 3. Detail Kursus
  await snap('03_detail_kursus.png', `${baseUrl}/courses/laravel-untuk-pemula-dari-nol-sampai-mahir`, false);

  // 4. Login Page
  await snap('04_halaman_login.png', `${baseUrl}/login`, false);

  // 5. Register Page
  await snap('05_halaman_register.png', `${baseUrl}/register`, false);

  // 6. Student Flow
  console.log('Logging in as student in isolated context...');
  const studentContext = await browser.createBrowserContext();
  const studentPage = await studentContext.newPage();
  await studentPage.setViewport({ width: 1440, height: 900, deviceScaleFactor: 1.5 });
  await studentPage.goto(`${baseUrl}/login`, { waitUntil: 'networkidle2' });
  await studentPage.type('#email', 'student@learnspace.test');
  await studentPage.type('#password', 'password');
  await Promise.all([
    studentPage.waitForNavigation({ waitUntil: 'networkidle2' }),
    studentPage.click('button[type="submit"]')
  ]);
  
  const snapStudent = async (filename, url) => {
    console.log(`Navigating to ${url}...`);
    await studentPage.goto(url, { waitUntil: 'networkidle2' });
    await new Promise(r => setTimeout(r, 1000));
    const dest1 = path.join(outputDir, filename);
    const dest2 = path.join(artifactDir, filename);
    await studentPage.screenshot({ path: dest1, fullPage: false });
    fs.copyFileSync(dest1, dest2);
    console.log(`Captured ${filename}`);
  };

  await snapStudent('06_dashboard_siswa.png', `${baseUrl}/student/dashboard`);
  await snapStudent('07_ruang_belajar_siswa.png', `${baseUrl}/student/lessons/1`);
  await studentContext.close();

  // 8. Instructor Flow
  console.log('Logging in as instructor in isolated context...');
  const instructorContext = await browser.createBrowserContext();
  const instructorPage = await instructorContext.newPage();
  await instructorPage.setViewport({ width: 1440, height: 900, deviceScaleFactor: 1.5 });
  await instructorPage.goto(`${baseUrl}/login`, { waitUntil: 'networkidle2' });
  await instructorPage.type('#email', 'instructor@learnspace.test');
  await instructorPage.type('#password', 'password');
  await Promise.all([
    instructorPage.waitForNavigation({ waitUntil: 'networkidle2' }),
    instructorPage.click('button[type="submit"]')
  ]);

  const snapInstructor = async (filename, url) => {
    console.log(`Navigating to ${url}...`);
    await instructorPage.goto(url, { waitUntil: 'networkidle2' });
    await new Promise(r => setTimeout(r, 1000));
    const dest1 = path.join(outputDir, filename);
    const dest2 = path.join(artifactDir, filename);
    await instructorPage.screenshot({ path: dest1, fullPage: false });
    fs.copyFileSync(dest1, dest2);
    console.log(`Captured ${filename}`);
  };

  await snapInstructor('08_dashboard_instruktur.png', `${baseUrl}/instructor/dashboard`);
  await snapInstructor('09_kursus_instruktur.png', `${baseUrl}/instructor/courses`);
  await instructorContext.close();

  // 10. Admin Flow
  console.log('Logging in as admin in isolated context...');
  const adminContext = await browser.createBrowserContext();
  const adminPage = await adminContext.newPage();
  await adminPage.setViewport({ width: 1440, height: 900, deviceScaleFactor: 1.5 });
  await adminPage.goto(`${baseUrl}/login`, { waitUntil: 'networkidle2' });
  await adminPage.type('#email', 'admin@learnspace.test');
  await adminPage.type('#password', 'password');
  await Promise.all([
    adminPage.waitForNavigation({ waitUntil: 'networkidle2' }),
    adminPage.click('button[type="submit"]')
  ]);

  const snapAdmin = async (filename, url) => {
    console.log(`Navigating to ${url}...`);
    await adminPage.goto(url, { waitUntil: 'networkidle2' });
    await new Promise(r => setTimeout(r, 1000));
    const dest1 = path.join(outputDir, filename);
    const dest2 = path.join(artifactDir, filename);
    await adminPage.screenshot({ path: dest1, fullPage: false });
    fs.copyFileSync(dest1, dest2);
    console.log(`Captured ${filename}`);
  };

  await snapAdmin('10_dashboard_admin.png', `${baseUrl}/admin/dashboard`);
  await snapAdmin('11_manajemen_user_admin.png', `${baseUrl}/admin/users`);
  await snapAdmin('12_manajemen_kategori_admin.png', `${baseUrl}/admin/categories`);
  await adminContext.close();

  await browser.close();
  console.log('All screenshots completed successfully!');
}

main().catch(err => {
  console.error('Error during screenshot generation:', err);
  process.exit(1);
});
