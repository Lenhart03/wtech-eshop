import { defineConfig } from 'vite';
import laravel from 'laravel-vite-plugin';

export default defineConfig({
    plugins: [
        laravel({
            input: [
                'resources/css/main.css',
                'resources/js/app.js',

                'resources/css/components/main_footer.css',
                'resources/css/components/navbar.css',
                'resources/css/pages/about.css',
                'resources/css/pages/admin.css',
                'resources/css/pages/cart.css',
                'resources/css/pages/confirmation.css',
                'resources/css/pages/contact.css',
                'resources/css/pages/detail.css',
                'resources/css/pages/index.css',
                'resources/css/pages/login.css',
                'resources/css/pages/order-payment.css',
                'resources/css/pages/products.css',
                'resources/css/pages/register.css',
                'resources/css/pages/search.css',
            ],
            refresh: true,
        }),
    ],
});
