<template>
	<div>
		<h2 style="margin-top: 30px">Categories of vCard {{ vcardId }}</h2>
	</div>

	<div class="content">
		<div class="row">
			<div class="col-sm-8"></div>
			<div class="col-sm-4" style="text-align: right">
				<router-link
					type="button"
					class="btn btn-primary"
					:to="{
						name: 'CategoryCreate',
						params: {
							vcardId: '900000001',
						},
					}"
				>
					<i class="bi bi-plus" style="color: white"></i>
					Add New Category
				</router-link>
			</div>
		</div>

		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<tr>
						<th scope="col">Name</th>
						<th scope="col">Actions</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="category in categories" :key="category.id">
						<th scope="row">{{ category.name }}</th>
						<td>
							<ul class="list-inline m-0">
								<li class="list-inline-item">
									<button type="button" class="btn btn-primary btn-sm">
										<router-link
											aria-label="Add category"
											:to="{
												name: 'CategoryUpdate',
												params: {
													vcardId: '900000001',
													id: category.id,
												},
											}"
										>
											<i class="bi-pencil-square" style="color: white"></i>
										</router-link>
									</button>
								</li>
								<li class="list-inline-item">
									<button
										type="button"
										class="btn btn-danger btn-sm"
										@click="deleteCategory(category.id)"
									>
										<i class="bi-trash-fill red" style="color: white"></i>
									</button>
								</li>
							</ul>
						</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default {
		name: "Categories",
		props: {
			vcardId: {
				type: String,
				default: null,
			},
		},
		data() {
			return {
				categories: [],
			}
		},
		methods: {
			getCategories() {
				this.$axios
					.get("vcards/" + this.vcardId + "/categories")
					.then(response => {
						this.categories = response.data
					})
					.catch(error => {
						console.log(error)
					})
			},
			deleteCategory(id) {
				this.$axios
					.delete("vcards/" + this.vcardId + "/categories/" + id)
					.then(response => {
						this.$toast.success(
							'Category "' + response.data.data.name + '" was deleted successfully.'
						)
						console.log(response.data.data)
					})
					.catch(error => {
						this.$toast.error("Category was not deleted due to validation errors!")
						console.log(error)
					})
				this.getCategories()
			},
		},
		mounted() {
			this.getCategories()
		},
	}
</script>

<style scoped lang="scss"></style>
