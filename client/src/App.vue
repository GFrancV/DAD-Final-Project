<template>
	<div>
		<nav
			class="
				navbar navbar-expand-md navbar-light
				bg-light
				sticky-top
				flex-md-nowrap
				p-0
				navbar-separator
			"
		>
			<div class="container-fluid">
				<a class="navbar-brand col-md-3 col-lg-2 me-0 px-3" href="#"
					><img
						src="./assets/logo.png"
						alt=""
						height="34"
						class="d-inline-block align-text-top"
						style="float: left"
					/>
					<h5>vCard App</h5></a
				>
				<button
					id="buttonSidebarExpandId"
					class="navbar-toggler"
					type="button"
					data-bs-toggle="collapse"
					data-bs-target="#sidebarMenu"
					aria-controls="sidebarMenu"
					aria-expanded="false"
					aria-label="Toggle navigation"
				>
					<span class="navbar-toggler-icon"></span>
				</button>

				<!--Drop down for desktop-->
				<div class="collapse navbar-collapse justify-content-end">
					<ul class="navbar-nav">
						<li v-if="userName == ''" class="nav-item">
							<router-link class="nav-link" :to="{ name: 'Login' }">
								<i class="bi bi-box-arrow-in-right"></i>
								Login
							</router-link>
						</li>
						<li v-if="userName == ''" class="nav-item">
							<router-link class="nav-link" :to="{ name: 'Register' }"
								><i class="bi bi-person-check-fill"></i>
								Register
							</router-link>
						</li>
						<li class="nav-item dropdown">
							<a
								class="nav-link dropdown-toggle"
								href="#"
								id="navbarDropdownMenuLink"
								role="button"
								data-bs-toggle="dropdown"
								aria-expanded="false"
							>
								<img
									:src="userPhotoUrl"
									class="rounded-circle z-depth-0 avatar-img"
									alt="avatar image"
								/>
								<span class="avatar-text">{{ userName }}</span>
							</a>
							<ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdownMenuLink">
								<li>
									<router-link
										class="dropdown-item"
										:to="{
											name: 'User',
											params: {
												id: userId,
											},
										}"
										><i class="bi bi-person-square"></i>Profile</router-link
									>
								</li>
								<li>
									<router-link class="dropdown-item" :to="{ name: 'ChangePassword' }"
										><i class="bi bi-key-fill"></i>Change password</router-link
									>
								</li>
								<li>
									<hr class="dropdown-divider" />
								</li>
								<li>
									<a class="dropdown-item" @click.prevent="logout"
										><i class="bi bi-arrow-right"></i>Logout</a
									>
								</li>
							</ul>
						</li>
					</ul>
				</div>
			</div>
		</nav>
		<div class="container-fluid">
			<div class="row">
				<nav id="sidebarMenu" class="col-md-3 col-lg-2 d-md-block bg-light sidebar collapse">
					<div class="position-sticky pt-3 menu">
						<ul v-if="userType == 'V'" class="nav flex-column">
							<li class="nav-item">
								<router-link
									class="nav-link"
									:class="{ active: $route.name === 'Dashboard' }"
									aria-current="page"
									:to="{ name: 'Dashboard' }"
								>
									<i class="bi bi-layers mr-2"></i>
									Dashboard
								</router-link>
							</li>
							<li class="nav-item d-flex justify-content-between align-items-center pe-3">
								<router-link
									class="nav-link w-100 me-3"
									:class="{ active: $route.name === 'Categories' }"
									aria-current="page"
									:to="{
										name: 'Categories',
										params: {
											vcardId: userId,
										},
									}"
								>
									<i class="bi bi-list-stars"></i>
									Categories
								</router-link>
							</li>
							<li class="nav-item d-flex justify-content-between align-items-center pe-3">
								<router-link
									class="nav-link w-100 me-3"
									:class="{ active: $route.name === 'Payments' }"
									aria-current="page"
									:to="{ name: 'Payments' }"
								>
									<i class="bi bi-credit-card"></i>
									Payment Types
								</router-link>
								<a class="link-secondary" href="#" aria-label="Add payment type">
									<i class="bi bi-xs bi-plus-circle"></i>
								</a>
							</li>

							<li class="nav-item">
								<router-link
									class="nav-link"
									:class="{ active: $route.name === 'Transactions' }"
									aria-current="page"
									:to="{
										name: 'Transactions',
										params: {
											vcard: userId,
										},
									}"
								>
									<i class="bi bi-currency-dollar"></i>
									Transactions
								</router-link>
							</li>

							<li class="nav-item">
								<router-link
									class="nav-link"
									:class="{ active: $route.name === 'Statistics' }"
									aria-current="page"
									:to="{
										name: 'Statistics',
										params: {
											vcard: userId,
										},
									}"
								>
									<i class="bi bi-bar-chart"></i>
									Statistics
								</router-link>
							</li>
						</ul>

						<!--Administrator tools-->
						<ul v-if="userType == 'A'" class="nav flex-column">
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
										/*
										params: {
											idUser: userId,
										},
										*/
									}"
								>
									<i class="bi bi-people"></i>
									Administrators
								</router-link>
							</li>
						</ul>

						<!-- Dropdown for phone-->
						<div class="d-block d-md-none">
							<ul class="nav flex-column mb-2">
								<li v-if="userName == ''" class="nav-item">
									<router-link class="nav-link" :to="{ name: 'Login' }">
										<i class="bi bi-box-arrow-in-right"></i>
										Login
									</router-link>
								</li>
								<li v-if="userName == ''" class="nav-item">
									<router-link class="nav-link" :to="{ name: 'Register' }"
										><i class="bi bi-person-check-fill"></i>
										Register
									</router-link>
								</li>
								<li class="nav-item dropdown">
									<a
										class="nav-link dropdown-toggle"
										href="#"
										id="navbarDropdownMenuLink2"
										role="button"
										data-bs-toggle="dropdown"
										aria-expanded="false"
									>
										<img
											:src="userPhotoUrl"
											class="rounded-circle z-depth-0 avatar-img"
											alt="avatar image"
										/>
										<span class="avatar-text">{{ userName }}</span>
									</a>
									<ul class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink2">
										<li>
											<a class="dropdown-item" href="#"
												><i class="bi bi-person-square"></i>Profile</a
											>
										</li>
										<li>
											<a class="dropdown-item" href="#"
												><i class="bi bi-key-fill"></i>Change password</a
											>
										</li>
										<li>
											<hr class="dropdown-divider" />
										</li>
										<li>
											<a class="dropdown-item" @click.prevent="logout"
												><i class="bi bi-arrow-right"></i>Logout</a
											>
										</li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</nav>
			</div>
		</div>
		<main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 main-content">
			<router-view></router-view>
		</main>
	</div>
</template>

<script>
	export default {
		name: "RootComponent",
		data() {
			return {
				prueba: 1,
			}
		},

		computed: {
			user() {
				return this.$store.state.user
			},
			userId() {
				return this.$store.state.user ? this.$store.state.user.id : -1
			},
			userType() {
				return this.$store.state.user ? this.$store.state.user.user_type : -1
			},
			userName() {
				return this.$store.state.user ? this.$store.state.user.name : ""
			},
			userPhotoUrl() {
				let urlPhoto = this.$store.state.user ? this.$store.state.user.photo_url : null

				return urlPhoto ? this.$serverUrl + "/storage/fotos/" + urlPhoto : "img/avatar-default.png"
			},
		},

		methods: {
			logout() {
				this.$store
					.dispatch("logout")
					.then(() => {
						this.$toast.success("User has logged out of the application.")
						this.$router.push({ name: "Home" })
					})
					.catch(() => {
						this.$toast.error("There was a problem logging out of the application!")
					})
			},
		},
	}
</script>

<style lang="css">
	@import "./assets/css/dashboard.css";

	.avatar-img {
		margin: -1.2rem 0.8rem -2rem 0.8rem;
		width: 3.3rem;
		height: 3.3rem;
	}
	.avatar-text {
		line-height: 2.2rem;
		margin: 1rem 0.5rem -2rem 0;
		padding-top: 1rem;
	}

	.dropdown-item {
		font-size: 0.875rem;
	}

	.main-content {
		background-color: #f4f5f8;
	}

	.imagePreviewWrapper {
		background-repeat: no-repeat;
		width: 200px;
		height: 200px;
		display: block;
		cursor: pointer;
		margin: 2px 0 0 0;
		background-size: contain;
		background-position: center center;
		float: left;
	}
</style>
