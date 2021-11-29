import { createRouter, createWebHashHistory } from 'vue-router'
import Home from '../views/Home.vue'
import Dashboard from '../components/Dashboard.vue'
import Payments from '../components/Payments.vue'

//Transactions
import Transactions from '../components/transactions/Transactions.vue'
import Transaction from "../components/transactions/Transaction.vue"

//Categories
import Categories from '../components/categories/Categories.vue'
import Category from '../components/categories/Category.vue'

//Vcards/Clientes
import Users from '../components/vcards/Users.OLD.vue'
import VCard from '../components/vcards/VCard.vue'

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

  //Categories
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
    path: '/vCard/:vcardId/categories/:id/update',
    name: 'CategoryUpdate',
    component: Category,
    props: route => ({ vcardId: route.params.vcardId, id: parseInt(route.params.id) })
  },

  {
    path: '/payments',
    name: 'Payments',
    component: Payments
  },

  //VCards/Clientes
  {
    path: '/users',
    name: 'Users',
    component: Users
  },
  {
    path: '/users/me',
    name: 'User',
    component: VCard,
    props: { id: "900000001" } //TODO - Temporário -> Deve-se ir buscar o id do vcard (phone_number) depois com o vuex
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

  //Transactions
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
      vcard: parseInt(route.params.vcard)
    })
  },
]

const router = createRouter({
  history: createWebHashHistory(),
  routes
})

export default router
