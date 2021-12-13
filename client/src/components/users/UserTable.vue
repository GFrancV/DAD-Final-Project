<template>
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
							class="rounded-circle z-depth-0 avatar-img"
							alt="avatar image"
						/>
					</th>
					<th scope="col" class="align-middle">{{ user.name }}</th>
					<td scope="col" class="align-middle">{{ user.email }}</td>
					<td scope="col" class="align-middle">{{ user.id }}</td>
					<td scope="col" class="align-middle">
						<ul class="list-inline m-0">
							<li class="list-inline-item">
								<button type="button" class="btn btn-primary btn-sm">
									<!--
								<router-link
									aria-label="Add category"
									:to="{
										name: 'CategoryUpdate',
										params: {
											vcardId: vcardId,
											id: category.id,
										},
									}"
								>
									<i class="bi-pencil-square" style="color: white"></i>
								</router-link>
									-->
								</button>
							</li>
							<li class="list-inline-item">
								<!--
							<button
								type="button"
								class="btn btn-danger btn-sm"
								@click="deleteCategory(category.id)"
							>
								<i class="bi-trash-fill red" style="color: white"></i>
							</button>
								-->
							</li>
						</ul>
						<ul class="list-inline m-0">
							<li class="list-inline-item">
								<button type="button" class="btn btn-primary btn-sm">
									<!-- <router-link
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
                  </router-link> -->
								</button>
							</li>
						</ul>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
	export default {
		name: "UserTable",
		props: {
			users: {
				type: Array,
				required: true,
			},
		},
		computed: {},
		methods: {
			photoFullUrl(user) {
				return user.photo_url
					? this.$serverUrl + "/storage/fotos/" + user.photo_url
					: "img/avatar-default.png"
			},
		},
	}
</script>

<style></style>
