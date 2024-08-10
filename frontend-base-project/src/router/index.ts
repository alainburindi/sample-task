import { createRouter, createWebHistory, RouteRecordRaw } from 'vue-router';
import Rooms from '../components/Rooms.vue';
import Guests from '../components/Guests.vue';

const routes: Array<RouteRecordRaw> = [
  {
    path: '/',
    redirect: '/rooms',
  },
  {
    path: '/rooms',
    name: 'Rooms',
    component: Rooms,
  },
  {
    path: '/guests',
    name: 'Guests',
    component: Guests,
  },
];

const router = createRouter({
  history: createWebHistory(),
  routes,
});

export default router;
