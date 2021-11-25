import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Categories from '../components/Categories.vue'
import Dashboard from '../components/Dashboard.vue'
import Payments from '../components/Payments.vue'

//Transactions
import Transactions from '../components/transactions/Transactions.vue'
import Transaction from "../components/transactions/Transaction.vue"

import Users from '../components/users/Users.vue'
import User from '../components/users/User.vue'

import ChangePassword from '../components/auth/ChangePassword.vue'
import Login from '../components/auth/Login.vue'
import Register from '../components/auth/Register.vue'

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
    path: '/categories',
    name: 'Categories',
    component: Categories
  },

  {
    path: '/payments',
    name: 'Payments',
    component: Payments
  },

  {
    path: '/users',
    name: 'Users',
    component: Users
  },
  {
    path: '/users/me', //TODO - TEMPORÁRIO, DEVE-SE ALTERAR PARA "path: '/users/:id',"
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
  
  //Transactions routes
  {
    path: '/transactions/:id',
    name: 'Transactions',
    component: Transactions,
    props: route => ({ id: parseInt(route.params.id) })
  },

  {
    path: '/transactions/:vcard/new',
    name: 'NewTransaction',
    component: Transaction,
    props: (route) => ({ 
      id: null,
      vcard: parseInt(route.params.vcard) })
  },

  
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
