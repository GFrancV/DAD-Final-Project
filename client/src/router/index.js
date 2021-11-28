import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Dashboard from '../components/Dashboard.vue'
import Payments from '../components/Payments.vue'

//Transactions
import Transactions from '../components/transactions/Transactions.vue'
import Transaction from "../components/transactions/Transaction.vue"


import Categories from '../components/categories/Categories.vue'
import Category from '../components/categories/Category.vue'

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
  
  //Transactions routes
  {
    path: '/transactions/:vcard',
    name: 'Transactions',
    component: Transactions,
    props: route => ({ 
      idVcard: route.params.vcard 
    })
  },

  {
    path: '/transactions/:vcard/:id',
    name: 'Transaction',
    component: Transaction,
    props: (route) => ({ 
      idVcard: route.params.vcard,
      idTransaction: parseInt(route.params.id) 
    })
  },
  
  {
    path: '/transactions/:vcard/new',
    name: 'NewTransaction',
    component: Transaction,
    props: (route) => ({ 
      idVcard: route.params.vcard,
      idTransaction: null, 
    })
  },

  
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
