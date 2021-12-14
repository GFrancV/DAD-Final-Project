import { createRouter, createWebHashHistory } from "vue-router"
import Home from "../views/Home.vue"
import Dashboard from "../components/Dashboard.vue"
import Payments from "../components/Payments.vue"

//Transactions
import Transactions from "../components/transactions/Transactions.vue"
import Transaction from "../components/transactions/Transaction.vue"

//Statistics
import Statistics from "../components/statistics/Statistics.vue"

//Administrators
import Users from "../components/users/Users.vue"
import User from "../components/users/User.vue"

//Vcards
import Vcards from "../components/vcards/Vcards.vue"

//Categories
import Categories from "../components/categories/Categories.vue"
import Category from "../components/categories/Category.vue"

//Vcards/Clientes
import VCard from "../components/vcards/VCard.vue"

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

	{
		path: "/users/:idUser/create",
		name: "UserCreate",
		component: User,
		props: route => ({ id: route.params.idUser, idUser: null }),
	},

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

	//Vcards view routes
	{
		path: "/vcards",
		name: "Vcards",
		component: Vcards,
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

	//VCards/Clientes
	{
		path: "/users",
		name: "Users",
		component: Users,
	},
	/*
	{
		path: "/users/me",
		name: "User",
		component: VCard,
		props: { id: "900000001" }, //TODO - Temporário -> Deve-se ir buscar o id do vcard (phone_number) depois com o vuex
	},
*/
	{
		path: "/vcards/:id",
		name: "Vcard",
		component: VCard,
		props: route => ({
			id: route.params.id,
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
	if (to.name == "User" || to.name == "Users" || to.name == "Vcards" || to.name == "Vcard") {
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
