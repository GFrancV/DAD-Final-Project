<template>
	<table class="table">
		<thead>
			<tr>
				<th scope="col">id</th>
				<th scope="col">Photo</th>
				<th scope="col">Name</th>
				<th scope="col">email</th>
				<th scope="col">Edit</th>
				<th scope="col">Delete</th>
			</tr>
		</thead>
		<tbody>
			<tr v-for="user in users" :key="user.id">
				<td v-if="showId" class="align-middle">{{ user.id }}</td>
				<td v-if="showPhoto" class="align-middle">
					<img :src="photoFullUrl(user)" class="rounded-circle img_photo" />
				</td>
				<th scope="row">{{ user.name }}</th>
				<td v-if="showEmail" class="align-middle">{{ user.email }}</td>

				<td>
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
				<td>
					<li class="list-inline-item">
						<button type="button" class="btn btn-danger btn-sm">
							<i class="bi-trash-fill red" style="color: white"></i>
						</button>
					</li>
				</td>
			</tr>
		</tbody>
	</table>
</template>

<script>
	export default {
		name: "UserTable",
		props: {
			users: {
				type: Array,
				default: () => [],
			},
			showId: {
				type: Boolean,
				default: true,
			},
			showEmail: {
				type: Boolean,
				default: true,
			},
			showAdmin: {
				type: Boolean,
				default: true,
			},
		},
		methods: {
			photoFullUrl(user) {
				return user.photo_url
					? this.$serverUrl + "/storage/fotos/" + user.photo_url
					: "./assets/img/avatar-none.png"
			},
		},
	}
</script>

<style></style>
