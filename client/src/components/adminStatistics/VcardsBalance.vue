<template>
	<h5>vCards Balance</h5>
	<div class="content">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<th scope="col">vCard</th>
					<th scope="col">Current balance</th>
				</thead>
				<tbody>
					<tr v-for="vcard in newVcards" :key="vcard.phone_number">
						<td>{{ vcard.phone_number }}</td>
						<td>${{ vcard.balance }}</td>
					</tr>
				</tbody>
			</table>
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
	</div>
</template>

<script>
	export default {
		name: "VcardsBalance",
		props: {
			vcards: {
				type: Object,
				required: true,
			},
		},
		data() {
			return {
				newVcards: this.vcards.data,
				nPages: this.vcards.meta.last_page,
				currentPage: 1,
			}
		},
		methods: {
			getVcards() {
				this.$axios
					.get("vcards?page=" + this.currentPage)
					.then(response => {
						this.newVcards = response.data.data
						this.nPages = response.data.meta.last_page
					})
					.catch(error => {
						console.log(error)
					})
			},

			previousPage() {
				if (this.currentPage - 1 <= 0) return

				this.currentPage--
				this.getVcards()
			},

			nextPage() {
				if (this.currentPage + 1 > this.nPages) return

				this.currentPage++
				this.getVcards()
			},
		},
	}
</script>

<style></style>
