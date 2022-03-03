import { createRouter, createWebHistory } from 'vue-router'
import HomeView from '../views/HomeView.vue'

const router = createRouter({
  history: createWebHistory(import.meta.env.BASE_URL),
  routes: [
    {
      path: '/',
      name: 'home',
      component: HomeView
    },
    {
      path: '/bookings',
      name: 'bookings',
      component: ()=>import('../views/BookingsView.vue')
    },
    {
      path: '/bookings/:id',
      name: 'booking',
      component: () => import('../views/BookingView.vue')
    },
    {
      path: '/bookings/new',
      name: 'add new booking',
      component: () => import('../views/NewBookingView.vue')
    },
    {
      path: '/courses',
      name: 'courses',
      // route level code-splitting
      // this generates a separate chunk (About.[hash].js) for this route
      // which is lazy-loaded when the route is visited.
      component: () => import('../views/CoursesView.vue')
    },
    {
      path: '/courses/:id',
      name: 'course',
      component: () => import('../views/CourseView.vue')
    },
    {
      path: '/locations',
      name: 'locations',
      component: ()=>import('../views/LocationsView.vue')
    },
    {
      path: '/locations/:id',
      name: 'location',
      component: () => import('../views/LocationView.vue')
    },
    {
      path: '/students',
      name: 'students',
      component: ()=>import('../views/StudentsView.vue')
    },
    {
      path: '/students/:id',
      name: 'student',
      component: () => import('../views/StudentView.vue')
    },
    {
      path: '/trainers',
      name: 'trainers',
      component: ()=>import('../views/TrainersView.vue')
    },
    {
      path: '/trainers/:id',
      name: 'trainer',
      component: () => import('../views/TrainerView.vue')
    }
  ]
})

export default router
