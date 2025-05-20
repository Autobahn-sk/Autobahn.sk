import { createRouter, createWebHistory } from 'vue-router';
import { RouteRecordRaw } from 'vue-router';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    name: 'Domov',
    component: () => import('@/components/app@home/home.vue'),
  },
  {
    path: '/ads/:id',
    name: 'Detail Inzerátu',
    component: () => import('@/components/app@ad/ad.vue'),
    props: true
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
    path: '/qna',
    name: 'Q&A',
    component: () => import('@/components/app@q&a/q&a.vue'),  
  },
  {
    path: '/about',
    name: 'AboutUs',
    component: () => import('@/components/app@about/about-us.vue'),  
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;