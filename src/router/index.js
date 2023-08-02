import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const routes = [
  {
    path: '/',
    name: 'home',
    component: HomeView
  },
  {
    path: "/trip_list",
    name: "trip_list",
    component: () =>
        import(/* webpackChunkName: "trip" */ "@/views/TripList.vue"),
  },
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
