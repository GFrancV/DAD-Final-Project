<template>
	<div>
		<h2 style="margin-top: 30px">Transactions</h2>
		<div class="content">
			<div class="row">
				<div class="table-responsive">
					<table class="table table-hover" style="width: 100%">
						<thead>
							<th style="text-align: center">Available vCards</th>
							<th style="text-align: center">Actions</th>
						</thead>
						<tbody>
							<tr v-for="vcard in vcards" :key="vcard.phone_number">
								<td scope="row" style="font-size: 20px; text-align: center">
									{{ vcard.phone_number }}
								</td>
								<td scope="row" style="text-align: center">
									<router-link
										type="button"
										class="btn btn-primary"
										:to="{ name: 'NewTransaction', params: { vcard: vcard.phone_number } }"
									>
										<i class="bi bi-plus" style="color: white"></i>
										Add Credit to vCard
									</router-link>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
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
		</div>
	</div>
</template>

<script>
	export default {
		name: "TransactionsAdmin",
		data() {
			return {
				vcards: [],
				nPages: 0,
				currentPage: 1,
				idVcard: "900000009",
			}
		},
		methods: {
			getVcards() {
				this.$axios
					.get("vcards?page=" + this.currentPage)
					.then(response => {
						this.vcards = response.data.data
						this.nPages = response.data.meta.last_page
					})
					.catch(error => {
						console.log(error)
					})
			},

			previousPage() {
				if (this.currentPage - 1 < 0) return

				this.currentPage--
				this.getVcards()
			},

			nextPage() {
				if (this.currentPage + 1 > this.nPages) return

				this.currentPage++
				this.getVcards()
			},
		},
		mounted() {
			this.getVcards()
		},
	}
</script>

<style></style>
