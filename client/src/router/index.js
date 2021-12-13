import { createRouter, createWebHashHistory } from "vue-router"
import Home from "../views/Home.vue"
import Dashboard from "../components/Dashboard.vue"
import Payments from "../components/Payments.vue"

//Transactions
import Transactions from "../components/transactions/Transactions.vue"
import Transaction from "../components/transactions/Transaction.vue"

//Statistics
import Statistics from "../components/statistics/Statistics.vue"

import Categories from "../components/categories/Categories.vue"
import Category from "../components/categories/Category.vue"

import Users from "../components/users/Users.vue"
import User from "../components/users/User.vue"

import ChangePassword from "../components/auth/ChangePassword.vue"
import Login from "../components/auth/Login.vue"
import Register from "../components/auth/Register.vue"

const routes = [
	{
		path: "/",
		name: "Home",
		component: Home,
	},

	{
		path: "/about",
		name: "About",
		// route level code-splitting
		// this generates a separate chunk (about.[hash].js) for this route
		// which is lazy-loaded when the route is visited.
		component: () => import(/* webpackChunkName: "about" */ "../views/About.vue"),
	},

	{
		path: "/password",
		name: "ChangePassword",
		component: ChangePassword,
	},

	{
		path: "/dashboard",
		name: "Dashboard",
		component: Dashboard,
	},

	{
		path: "/vCard/:vcardId/categories",
		name: "Categories",
		component: Categories,
		props: route => ({ vcardId: route.params.vcardId }),
	},
	{
		path: "/vCard/:vcardId/categories/create",
		name: "CategoryCreate",
		component: Category,
		props: route => ({ vcardId: route.params.vcardId, id: null }),
	},
	{
		path: "/vCard/:vcardId/categories/:id/update",
		name: "CategoryUpdate",
		component: Category,
		props: route => ({ vcardId: route.params.vcardId, id: parseInt(route.params.id) }),
	},

	{
		path: "/payments",
		name: "Payments",
		component: Payments,
	},

	/*
	{
		path: "/users/:idUser/create",
		name: "UserCreate",
		component: User,
		props: route => ({ id: route.params.idUser, idUser: null }),
	},
	*/

	//Login/Register routes
	{
		path: "/login",
		name: "Login",
		component: Login,
	},
	{
		path: "/register",
		name: "Register",
		component: Register,
	},

	//Users view routes

	{
		path: "/users",
		name: "Users",
		component: Users,
	},

	{
		path: "/users/:id",
		name: "User",
		component: User,
		props: route => ({
			idUser: route.params.id,
		}),
	},

	//Transactions routes
	{
		path: "/transactions/:vcard",
		name: "Transactions",
		component: Transactions,
		props: route => ({
			idVcard: route.params.vcard,
		}),
	},

	{
		path: "/transactions/:vcard/:id",
		name: "Transaction",
		component: Transaction,
		props: route => ({
			idVcard: route.params.vcard,
			idTransaction: parseInt(route.params.id),
		}),
	},

	{
		path: "/transactions/:vcard/new",
		name: "NewTransaction",
		component: Transaction,
		props: route => ({
			idVcard: route.params.vcard,
			idTransaction: null,
		}),
	},

	//Statistics Routes
	{
		path: "/statistics/:vcard",
		name: "Statistics",
		component: Statistics,
		props: route => ({
			idVcard: route.params.vcard,
		}),
	},
]

const router = createRouter({
	history: createWebHashHistory(),
	routes,
})

import store from "../store"

router.beforeEach((to, from, next) => {
	if (to.name == "Login" || to.name == "Home") {
		next()
		return
	}
	if (to.name == "User" || to.name == "Users") {
		if (store.state.user.user_type == "A" || store.state.user.id == to.params.id) {
			next()
			return
		}
		next(false)
		console.log("estoy aqui")
		return
	}
	next()
})

export default router
