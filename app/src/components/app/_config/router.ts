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
  {
    path: '/diagnostika',
    name: 'Diagnostika',
    component: () => import('@/components/app@part/part.vue'),  
  },
  {
    path: '/q&a',
    name: 'Q&A',
    component: () => import('@/components/app@q&a/q&a.vue'),  
  }
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;