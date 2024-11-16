import { createRouter, createWebHistory } from 'vue-router';
import { RouteRecordRaw } from 'vue-router';
import HomePage from '@/components/app@home/home.vue';
import ServicePage from '@/components/app@service/service.vue'; 

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'Home',
    component: HomePage,
  },
  {
    path: '/servis',  
    name: 'Servis',
    component: ServicePage,  
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;