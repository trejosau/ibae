import puppeteer from 'puppeteer';

const fetchFacebookFollowers = async (pageUrl) => {
    const browser = await puppeteer.launch({
        headless: true,
        args: ['--no-sandbox', '--disable-setuid-sandbox']  // Para mejorar la velocidad y evitar errores
    });
    const page = await browser.newPage();

    try {
        // Deshabilitar la carga de imágenes y estilos CSS para que sea más rápido
        await page.setRequestInterception(true);
        page.on('request', (req) => {
            if (['image', 'stylesheet', 'font'].includes(req.resourceType())) {
                req.abort();
            } else {
                req.continue();
            }
        });

        await page.goto(pageUrl, { waitUntil: 'networkidle2' });

        const followersCount = await page.evaluate(() => {
            const followersElement = document.querySelector('a[href*="/followers/"]');
            return followersElement ? followersElement.innerText : 'No se encontró el elemento de seguidores';
        });

        console.log(followersCount);
    } catch (error) {
        console.error('Error al obtener seguidores:', error);
    } finally {
        await browser.close();
    }
};

const pageUrl = 'https://www.facebook.com/InstitutoDeBellezaArteEstilo';
fetchFacebookFollowers(pageUrl);
