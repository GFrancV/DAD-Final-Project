<template>
	<h2 style="margin-top: 30px">Users</h2>
	<div class="content">
		<div class="row">
			<div class="col-sm-8"></div>
			<div class="col-sm-4" style="text-align: right">
				<router-link
					type="button"
					class="btn btn-primary"
					aria-label="Add User"
					:to="{
						name: 'UserCreate',
						params: {
							idUser: this.$store.state.user.id.toString(),
						},
					}"
				>
					<i class="bi bi-plus" style="color: white"></i>
					Add New User
				</router-link>
			</div>
		</div>

		<user-table :users="users"></user-table>
	</div>
</template>

<script>
	import UserTable from "./UserTable.vue"

	export default {
		name: "Users",
		components: {
			UserTable,
		},
		props: {
			idUser: {
				type: String,
				default: null,
			},
		},
		data() {
			return {
				users: [],
			}
		},
		methods: {
			getUsers() {
				this.$axios
					.get("users")
					.then(response => {
						this.users = response.data.data
					})
					.catch(error => {
						console.log(error)
					})
			},
		},
		mounted() {
			this.getUsers()
		},
	}
</script>

<style scoped lang="scss"></style>
