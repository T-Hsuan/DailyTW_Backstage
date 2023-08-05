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
  {
    path: "/place_add",
    name: "place_add",
    component: () =>
        import(/* webpackChunkName: "trip" */ "@/views/PlaceAdd.vue"),
  },
  {
    path: "/place_list",
    name: "place_list",
    component: () =>
        import(/* webpackChunkName: "place" */ "@/views/PlaceList.vue"),
  },
  {
    path: "/place_type_mgt",
    name: "place_type_mgt",
    component: () =>
        import(/* webpackChunkName: "place" */ "@/views/PlaceTypeMgt.vue"),
  },
  {
    path: "/oott_post_list",
    name: "oott_post_list",
    component: () =>
        import(/* webpackChunkName: "oott" */ "@/views/OottPostList.vue"),
  },
  {
    path: "/style_mgt",
    name: "style_mgt",
    component: () =>
        import(/* webpackChunkName: "oott" */ "@/views/StyleMgt.vue"),
  },
  {
    path: "/ticket_list",
    name: "ticket_list",
    component: () =>
        import(/* webpackChunkName: "tickit" */ "@/views/TicketList.vue"),
  },
  {
    path: "/member_mgt",
    name: "member_mgt",
    component: () =>
        import(/* webpackChunkName: "member_mgt" */ "@/views/MemberMgt.vue"),
  },
  {
    path: "/member_view",
    name: "member_view",
    component: () =>
        import(/* webpackChunkName: "member_view" */ "@/views/MemberView.vue"),
  },
  {
    path: "/employee_mgt",
    name: "employee_mgt",
    component: () =>
        import(/* webpackChunkName: "employee" */ "@/views/EmployeeMgt.vue"),
  },
  {
    path: "/employee_add",
    name: "employee_add",
    component: () =>
        import(/* webpackChunkName: "employee_add" */ "@/views/EmployeeAdd.vue"),
  },
  {
    path: "/order_list",
    name: "order_list",
    component: () =>
        import(/* webpackChunkName: "order" */ "@/views/OrderList.vue"),
        
  },
  {
    path: "/feedback_list",
    name: "feedback_list",
    component: () =>
        import(/* webpackChunkName: "feedback" */ "@/views/FeedbackList.vue"),
  },
  {
    path: "/subscriber_list",
    name: "subscriber_list",
    component: () =>
        import(/* webpackChunkName: "subscriber" */ "@/views/SubscriberList.vue"),
  },
  {
    path: "/backstage_login",
    name: "backstage_login",
    component: () =>
        import(/* webpackChunkName: "backstage_login" */ "@/views/BackStageLogin.vue"),
  },
  
]

const router = createRouter({
  history: createWebHistory(process.env.BASE_URL),
  routes
})

export default router
