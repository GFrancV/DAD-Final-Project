<template>
	<h2 style="margin-top: 30px">Vcards</h2>
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
					<tr v-for="vcard in vcards" :key="vcard.id">
						<th scope="col" class="align-middle">
							<img
								:src="photoFullUrl(vcard)"
								class="rounded-circle"
								alt="avatar image"
								style="width: 50px"
							/>
						</th>
						<th scope="col" class="align-middle">{{ vcard.name }}</th>
						<td scope="col" class="align-middle">{{ vcard.email }}</td>
						<td scope="col" class="align-middle">{{ vcard.id }}</td>
						<td scope="col" class="align-middle">
							<router-link
								type="button"
								class="btn btn-primary btn-sm"
								:to="{
									name: 'Vcard',
									params: { id: vcard.id },
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
		name: "Vcards",
		props: {
			/*
			idUser: {
				type: String,
				default: "",
			},
			*/
		},
		data() {
			return {
				allUsers: [],
				vcards: [],
			}
		},
		methods: {
			async getVcards() {
				var aux
				var def = []

				await this.$axios
					.get("users")
					.then(response => {
						aux = response.data.data
					})
					.catch(error => {
						console.log(error)
					})

				for (let i = 0; i < aux.length; i++) {
					if (aux[i].user_type == "V") {
						def.push(aux[i])
					}
				}

				this.vcards = def
			},

			photoFullUrl(user) {
				return user.photo_url
					? this.$serverUrl + "/storage/fotos/" + user.photo_url
					: "img/avatar-default.png"
			},
		},

		mounted() {
			this.getVcards()
		},
	}
</script>

<style></style>
