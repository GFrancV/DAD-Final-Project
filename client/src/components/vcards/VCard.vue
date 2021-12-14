<template>
	<form class="row g-3 needs-validation" novalidate>
		<h2 class="mt-5 mb-3">VCard {{ id }}</h2>
		<hr />

		<div class="mb-3">
			<div class="mb-3">
				<label for="inputVCard" class="form-label">Phone Number</label>
				<input
					id="inputVCard"
					class="form-control"
					type="text"
					aria-label="vCard number"
					:value="id"
					readonly
				/>
			</div>

			<!--NAME-->
			<div class="mb-3">
				<label for="inputName" class="form-label">Name</label>
				<input type="text" class="form-control" id="inputName" v-model="vcard.name" required />
			</div>

			<!--EMAIL-->
			<div class="mb-3">
				<label for="inputEmail" class="form-label">Email</label>
				<input type="text" class="form-control" id="inputEmail" v-model="vcard.email" required />
			</div>

			<!--CONFIRMATION CODE-->
			<div class="mb-3 row">
				<div class="col">
					<label for="inputConfirmationCode" class="form-label">Current Confirmation Code</label>
					<input
						type="text"
						class="form-control"
						id="inputConfirmationCode"
						v-model="this.vcard.currentCode"
						required
					/>
				</div>

				<div class="col-sm">
					<label for="inputConfirmationCode" class="form-label">New Confirmation Code</label>
					<input
						type="text"
						class="form-control"
						id="inputConfirmationCode"
						v-model="this.vcard.confirmation_code"
						required
					/>
				</div>
			</div>

			<!--PASSWORD-->
			<div class="mb-3 row">
				<div class="col">
					<label for="inputConfirmationCode" class="form-label">Current Password</label>
					<input
						type="text"
						class="form-control"
						id="inputConfirmationCode"
						v-model="this.vcard.currentPassword"
						required
					/>
				</div>

				<div class="col-sm">
					<label for="inputConfirmationCode" class="form-label">New Password</label>
					<input
						type="text"
						class="form-control"
						id="inputConfirmationCode"
						v-model="this.vcard.password"
						required
					/>
				</div>
			</div>

			<!--PROFILE PHOTO-->
			<div class="mb-3">
				<label for="formFile" class="form-label">Profile Photo:</label>

				<div class="mb-3">
					<img
						:src="this.profilePhoto"
						alt=""
						height="150"
						class="d-inline-block align-text-top"
						style="float: left; margin-bottom: 10px"
					/>
				</div>
			</div>

			<div>
				<form @submit="formSubmit" enctype="multipart/form-data">
					<input type="file" class="form-control" v-on:change="onChange" />
				</form>

				<!--<input type="file" class="form-control" v-on:change="formSubmit" />-->
			</div>
			<!--
      <div v-if="this.image" class="mb-10" style="margin-top: 5px">
        <div>
          {{ newImage }}
        </div>
        <div
          class="imagePreviewWrapper"
          :style="{ 'background-image': `url(${image})` }"
          @click="onChange"
        ></div>
      </div>
      -->
		</div>

		<div class="mb-3 d-flex justify-content-left">
			<ul class="list-inline">
				<li class="list-inline-item">
					<button type="button" class="btn btn-primary px-3" @click="save">Save</button>
				</li>
				<li class="list-inline-item">
					<button type="button" class="btn btn-secondary px-3" @click="cancel">Cancel</button>
				</li>
			</ul>
		</div>
	</form>
</template>

<script>
	export default {
		name: "VCard",
		props: {
			id: {
				type: String,
				required: true,
			},
		},
		data() {
			return {
				vcard: {},
				errors: null,
				profilePhoto: null,
				image: "",
				success: "",
			}
		},
		computed: {
			newImage() {
				if (this.image) {
					return "New Image:"
				}
				return ""
			},
		},
		methods: {
			dataAsString() {
				return JSON.stringify(this.vcard)
			},
			newVcard() {
				return {
					phone_number: null,
					name: "",
					email: "",
					photo_url: "",
					password: "",
					confirmation_code: "",
					blocked: null,
					balance: null,
					max_debit: null,
				}
			},
			loadVcard() {
				this.errors = null
				this.$axios
					.get("vcards/" + this.id)
					.then(response => {
						this.vcard = response.data.data
						this.originalValueStr = this.dataAsString()
						this.vcard.currentPassword = ""
						this.vcard.currentCode = ""
						if (this.vcard.photo_url) {
							this.profilePhoto = this.$serverUrl + "/storage/fotos/" + this.vcard.photo_url
						} else {
							this.profilePhoto = "./assets/img/avatar-exemplo-1.jpg"
						}
					})
					.catch(error => {
						console.log(error)
					})
			},
			save() {
				this.$axios
					.put("vcards/" + this.id, this.vcard)
					.then(response => {
						this.$toast.success('User "' + response.data.data.name + '" was updated successfully.')
						this.vcard = response.data.data
						this.originalValueStr = this.dataAsString()
						this.loadVcard()
					})
					.catch(error => {
						if (error.response.status == 422) {
							this.$toast.error(
								'User "' + this.vcard.name + '" was not updated due to validation errors!'
							)
							this.errors = error.response.data.errors
						} else {
							this.$toast.error(
								'Category "' + this.category.name + '" was not updated due to unknown server error!'
							)
						}
					})
			},
			cancel() {
				this.loadVcard()
				this.image = ""
			},
			onChange(e) {
				this.image = e.target.files[0]
				this.formSubmit(e)
			},
			formSubmit(e) {
				e.preventDefault()
				const config = {
					headers: {
						"content-type": "multipart/form-data",
					},
				}
				let data = new FormData()
				data.append("file", this.image)
				this.$axios
					.post("/photo", data, config)
					.then(response => {
						this.vcard.photo_url = response.data
					})
					.catch(err => {
						console.log(err)
					})
			},
		},
		mounted() {
			this.loadVcard()
		},
	}
</script>

<style></style>
