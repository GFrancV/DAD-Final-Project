<template>
	<h2 style="margin-top: 30px">Users</h2>
	<div class="content">
		<div class="row">
			<div class="col-sm-8"></div>
			<!--
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
			-->
		</div>
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Photo</th>
						<th scope="col">Name</th>
						<th scope="col">Email</th>
						<th scope="col">Phone number</th>
						<th scope="col">Tools</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="user in users" :key="user.id">
						<th scope="col" class="align-middle">
							<img
								:src="photoFullUrl(user)"
								class="rounded-circle"
								alt="avatar image"
								style="width: 50px"
							/>
						</th>
						<th scope="col" class="align-middle">{{ user.name }}</th>
						<td scope="col" class="align-middle">{{ user.email }}</td>
						<td scope="col" class="align-middle">{{ user.id }}</td>
						<td scope="col" class="align-middle">
							<router-link
								type="button"
								class="btn btn-primary btn-sm"
								:to="{
									name: 'User',
									params: { id: user.id },
								}"
								><i class="bi-pencil-square" style="color: white"></i
							></router-link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default {
		name: "Users",
		components: {},
		props: {
			idUser: {
				type: String,
				default: "",
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

			photoFullUrl(user) {
				return user.photo_url
					? this.$serverUrl + "/storage/fotos/" + user.photo_url
					: "img/avatar-default.png"
			},
		},
		mounted() {
			this.getUsers()
		},
	}
</script>

<style scoped lang="scss"></style>
