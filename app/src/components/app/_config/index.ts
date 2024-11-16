import { createApp } from 'vue';
import router from '@/components/app/_config/router';
import App from '@/App.vue';

const app = createApp(App);
app.use(router);
app.mount('#app');
