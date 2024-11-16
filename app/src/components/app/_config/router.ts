import { createRouter, createWebHistory } from 'vue-router';
import { RouteRecordRaw } from 'vue-router';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'Domov',
    component: () => import('@/components/app@home/home.vue'),
  },
  {
    path: '/servis',  
    name: 'Servis',
    component: () => import('@/components/app@service/service.vue'),  
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;