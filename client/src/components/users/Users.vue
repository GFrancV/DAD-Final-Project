<template>
	<h2 style="margin-top: 30px">Administrators list</h2>
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
					<tr v-for="admin in admins" :key="admin.id">
						<th scope="col" class="align-middle">
							<img
								:src="photoFullUrl(admin)"
								class="rounded-circle"
								alt="avatar image"
								style="width: 50px"
							/>
						</th>
						<th scope="col" class="align-middle">{{ admin.name }}</th>
						<td scope="col" class="align-middle">{{ admin.email }}</td>
						<td scope="col" class="align-middle">{{ admin.id }}</td>
						<td scope="col" class="align-middle">
							<router-link
								type="button"
								class="btn btn-primary btn-sm"
								:to="{
									name: 'User',
									params: { id: admin.id },
								}"
								><i class="bi-pencil-square" style="color: white"></i
							></router-link>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
		<br />
		<div class="mb-3 d-flex justify-content-end">
			<nav aria-label="...">
				<ul class="pagination">
					<li class="page-item">
						<a class="page-link" v-on:click="previousPage()">Previous</a>
					</li>
					<div v-for="n in nPages" :key="n">
						<li v-if="currentPage == n" class="page-item active">
							<a class="page-link">{{ n }}</a>
						</li>
						<li v-else class="page-item">
							<a class="page-link">{{ n }}</a>
						</li>
					</div>
					<li class="page-item">
						<a class="page-link" v-on:click="nextPage()">Next</a>
					</li>
				</ul>
			</nav>
		</div>
	</div>
	<br />
</template>

<script>
	export default {
		name: "Users",
		data() {
			return {
				admins: [],
				nPages: null,
				currentPage: 1,
			}
		},
		methods: {
			getAdministrators() {
				this.$axios
					.get("users/admins")
					.then(response => {
						this.admins = response.data.data
						this.nPages = response.data.meta.last_page
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

			previousPage() {
				if (this.currentPage - 1 <= 0) return

				this.currentPage--
				this.getAdministrators()
			},

			nextPage() {
				if (this.currentPage + 1 > this.nPages) return

				this.currentPage++
				this.getAdministrators()
			},
		},

		mounted() {
			this.getAdministrators()
		},
	}
</script>

<style scoped lang="scss"></style>
