import { createRouter, createWebHistory } from 'vue-router'
import Entrance from '../views/Entrance.vue'

const routes = [
    {
        path: '/',
        name: 'Entrance',
        component: Entrance
    },
    {
        path: '/login',
        name: 'login',
        component: () =>
            import(/* webpackChunkName: "login" */ "@/views/Login.vue"),
    },
    {
        path: "/trip_list",
        name: "trip_list",
        component: () =>
            import(/* webpackChunkName: "trip" */ "@/views/TripList.vue"),
    },
    {
        path: "/trip_add",
        name: "trip_add",
        component: () =>
            import(/* webpackChunkName: "trip" */ "@/views/TripAdd.vue"),
    },
    {
        path: "/trip_edit",
        name: "trip_edit",
        component: () =>
            import(/* webpackChunkName: "trip" */ "@/views/TripEdit.vue"),
    },
    {
        path: "/place_add",
        name: "place_add",
        component: () =>
            import(/* webpackChunkName: "trip" */ "@/views/PlaceAdd.vue"),
    },
    {
        path: "/place_edit/:place_id",
        name: "place_edit",
        component: () =>
            import(/* webpackChunkName: "trip" */ "@/views/PlaceEdit.vue"),
    },
    {
        path: "/place_list",
        name: "place_list",
        component: () =>
            import(/* webpackChunkName: "place" */ "@/views/PlaceList.vue"),
    },
    {
        path: "/place_tag",
        name: "place_tag",
        component: () =>
            import(/* webpackChunkName: "place" */ "@/views/PlaceTag.vue"),
    },
    {
        path: "/place_tag_add",
        name: "place_tag_add",
        component: () =>
            import(/* webpackChunkName: "place" */ "@/views/PlaceTagAdd.vue"),
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
            import(/* webpackChunkName: "ticket" */ "@/views/TicketList.vue"),
    },
    {
        path: "/ticket_add",
        name: "ticket_add",
        component: () =>
            import(/* webpackChunkName: "ticket_add" */ "@/views/TicketAdd.vue"),
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

    }, {
        path: "/order_content",
        name: "order_content",
        component: () =>
            import(/* webpackChunkName: "order" */ "@/views/OrderContent.vue"),

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
        path: "/oott_style_add",
        name: "oott_style_add",
        component: () =>
            import(/* webpackChunkName: "OottStyleAdd" */ "@/views/OottStyleAdd.vue"),
    },
    {
        path: "/oott_post_review/:id",
        name: "oott_post_review",
        component: () =>
            import(/* webpackChunkName: "OottPostReview" */ "@/views/OottPostReview.vue"),
    },


]

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes
})

export default router
