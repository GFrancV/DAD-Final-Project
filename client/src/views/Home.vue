<template>
	<div class="home">
		<div v-if="this.$store.state.user != null">
			<div v-if="this.$store.state.user.user_type == 'A'">
				<h2 style="margin-top: 30px">Welcome to vCard App {{ this.$store.state.user.name }}</h2>
				<div class="content">
					<p>What do you want to do?</p>
					<!--Administrator tools-->
					<ul class="nav flex-column">
						<h4
							class="
								sidebar-heading
								d-flex
								justify-content-between
								align-items-center
								px-3
								mt-4
								mb-1
								text-muted
							"
						>
							<span>Administrator tool</span>
						</h4>
						<li class="nav-item">
							<router-link
								class="nav-link"
								:class="{ active: $route.name === 'TransactionsAdmin' }"
								aria-current="page"
								:to="{
									name: 'TransactionsAdmin',
								}"
							>
								<i class="bi bi-currency-dollar"></i>
								Transactions
							</router-link>
						</li>
						<li class="nav-item">
							<router-link
								class="nav-link"
								:class="{ active: $route.name === 'Vcards' }"
								aria-current="page"
								:to="{
									name: 'Vcards',
								}"
							>
								<i class="bi bi-credit-card"></i>
								vCards
							</router-link>
						</li>
						<li class="nav-item">
							<router-link
								class="nav-link"
								:class="{ active: $route.name === 'Users' }"
								aria-current="page"
								:to="{
									name: 'Users',
								}"
							>
								<i class="bi bi-people"></i>
								Administrators
							</router-link>
						</li>
						<li class="nav-item">
							<router-link
								class="nav-link"
								:class="{ active: $route.name == 'AdminStatistics' }"
								aria-current="page"
								:to="{
									name: 'AdminStatistics',
								}"
							>
								<i class="bi bi-bar-chart"></i>
								Statistics
							</router-link>
						</li>
					</ul>
				</div>
			</div>
			<div v-else>
				<dashboard></dashboard>
			</div>
		</div>
		<div v-else>
			<h2 style="margin-top: 30px">Welcome to vCard App</h2>
			<div class="content">
				<login></login>
			</div>
		</div>
	</div>
</template>

<script>
	import Login from "../components/auth/Login.vue"
	import Dashboard from "../components/Dashboard.vue"

	export default {
		name: "Home",
		components: {
			Login,
			Dashboard,
		},
	}
</script>
