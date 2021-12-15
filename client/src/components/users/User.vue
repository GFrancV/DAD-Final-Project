<template>
	<div>
		<h2 style="margin-top: 30px">{{ user.name }}</h2>
		<div class="content">
			<form class="row g-3 needs-validation" novalidate @submit.prevent="save">
				<div class="row" style="margin-top: 20px">
					<div class="col-sm-4" style="text-align: center">
						<h6>
							<label class="sr-only">User photo</label>
						</h6>
						<img
							:src="photoFullUrl()"
							class="rounded-circle"
							alt="avatar image"
							style="width: 240px"
						/>
					</div>
					<div class="col-sm-8">
						<h6>
							<label class="sr-only" for="inputName" style="margin-top: 35px">Name</label>
						</h6>
						<div class="input-group mb-2">
							<input id="inputName" class="form-control" type="text" :value="user.name" readonly />
						</div>
						<br />
						<h6>
							<label class="sr-only" for="inputName">Email</label>
						</h6>
						<div class="input-group mb-2">
							<input id="inputName" class="form-control" type="text" :value="user.email" readonly />
						</div>
						<br />
						<div class="mb-3 d-flex justify-content-end">
							<ul class="list-inline">
								<li class="list-inline-item">
									<button type="button" class="btn btn-primary px-5" @click="back">
										Back to the list
									</button>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</form>
		</div>
	</div>
</template>

<script>
	export default {
		name: "Users",
		props: {
			id: {
				type: String,
				default: "",
			},
		},
		data() {
			return {
				user: [],
			}
		},
		methods: {
			getUserInfo() {
				this.$axios
					.get("users/" + this.id)
					.then(response => {
						this.user = response.data.data
					})
					.catch(error => {
						console.log(error)
					})
			},

			photoFullUrl() {
				return this.user.photo_url
					? this.$serverUrl + "/storage/fotos/" + this.user.photo_url
					: "img/avatar-default.png"
			},

			back() {
				this.$router.back()
			},
		},
		mounted() {
			this.getUserInfo()
		},
	}
</script>

<style scoped lang="scss"></style>
