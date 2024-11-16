import { createApp } from 'vue';
import router from '@/components/app/_config/router';
import App from '@/App.vue';
import '@/components/app/_theme/index.sass';

const app = createApp(App);
app.use(router);
app.mount('#app');
