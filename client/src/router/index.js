import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Dashboard from '../components/Dashboard.vue'
import Payments from '../components/Payments.vue'
import Transactions from '../components/Transactions.vue'


import Categories from '../components/categories/Categories.vue'
import Category from '../components/categories/Category.vue'

import Users from '../components/users/Users.vue'
import User from '../components/users/User.vue'

import ChangePassword from '../components/auth/ChangePassword.vue'
import Login from '../components/auth/Login.vue'
import Register from '../components/auth/Register.vue'

import VCard from '../components/vcards/VCard.vue'


const routes = [
  {
    path: '/',
    name: 'Home',
    component: Home
  },
  {
    path: '/about',
    name: 'About',
    // route level code-splitting
    // this generates a separate chunk (about.[hash].js) for this route
    // which is lazy-loaded when the route is visited.
    component: () => import(/* webpackChunkName: "about" */ '../views/About.vue')
  },
  {
    path: '/password',
    name: 'ChangePassword',
    component: ChangePassword
  },
  {
    path: '/dashboard',
    name: 'Dashboard',
    component: Dashboard
  },
  {
    path: '/vCard/:vcardId/categories',
    name: 'Categories',
    component: Categories,
    props: route => ({ vcardId: route.params.vcardId })
  },
  {
    path: '/vCard/:vcardId/categories/create',
    name: 'CategoryCreate',
    component: Category,
    props: route => ({ vcardId: route.params.vcardId, id: null })
  },
  {
    path: '/payments',
    name: 'Payments',
    component: Payments
  },
  {
    path: '/transactions',
    name: 'Transactions',
    component: Transactions
  },
  {
    path: '/users',
    name: 'Users',
    component: Users
  },
  {
    path: '/users/me',
    name: 'User',
    component: User
  },
  {
    path: '/login',
    name: 'Login',
    component: Login
  },
  {
    path: '/register',
    name: 'Register',
    component: Register
  },
  {
    path: '/vCard/:id',
    name: 'VCard',
    component: VCard,
    props: route => ({ id: route.params.id })
  }
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
