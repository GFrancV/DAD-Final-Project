<template>
	<h2 style="margin-top: 30px">Login</h2>
	<div class="content">
		<form class="row g-3 needs-validation" novalidate @submit.prevent="checkForm">
			<div class="mb-3">
				<div class="mb-3">
					<label for="inputUsername" class="form-label">Username</label>
					<input
						type="text"
						class="form-control"
						id="inputUsername"
						required
						v-model="credentials.username"
					/>
				</div>
			</div>
			<div class="mb-3">
				<div class="mb-3">
					<label for="inputPassword" class="form-label">Password</label>
					<input
						type="password"
						class="form-control"
						id="inputPassword"
						required
						v-model="credentials.password"
					/>
				</div>
			</div>
			<div class="mb-3 d-flex justify-content-center">
				<button type="button" class="btn btn-primary px-5" @click="checkForm">Login</button>
			</div>
		</form>
	</div>
</template>

<script>
	export default {
		name: "Login",
		data() {
			return {
				credentials: {
					username: "",
					password: "",
				},
				errors: null,
			}
		},
		emits: ["login"],
		methods: {
			checkForm() {
				if (this.credentials.username == "") this.$toast.error("Username is required!")

				if (this.credentials.password == "") this.$toast.error("Password is required!")

				if (this.credentials.password != "" && this.credentials.username != "") this.login()
			},

			login() {
				this.$store
					.dispatch("login", this.credentials)
					.then(() => {
						this.$toast.success(
							"User " + this.$store.state.user.name + " has entered the application."
						)
						this.$emit("login")
						this.$router.push({ name: "Home" })
					})
					.catch(() => {
						this.credentials.password = ""
						this.$toast.error("User credentials are invalid!")
					})
			},
		},
	}
</script>

<style scoped></style>
