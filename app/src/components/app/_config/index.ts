import { createApp } from 'vue';
import { library } from '@fortawesome/fontawesome-svg-core';
import { FontAwesomeIcon } from '@fortawesome/vue-fontawesome';
import { faCheck } from '@fortawesome/free-solid-svg-icons';
import router from '@/components/app/_config/router';
import App from '@/App.vue';
import '@/components/app/_theme/index.sass';

library.add(faCheck);


const app = createApp(App);
app.use(router);
app.component('font-awesome-icon', FontAwesomeIcon);
app.mount('#app');
