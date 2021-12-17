<template>
	<div>
		<h2 style="margin-top: 30px">Transactions: vCard {{ idVcard }}</h2>
		<div class="content">
			<div class="row">
				<div class="col-sm-8">
					<div class="input-group rounded">
						<input
							type="search"
							class="form-control rounded"
							placeholder="Search"
							aria-label="Search"
							aria-describedby="search-addon"
						/>
						<span class="input-group-text border-0" id="search-addon">
							<i class="bi bi-search"></i>
						</span>
					</div>
				</div>
				<div class="col-sm-4" style="text-align: right">
					<router-link
						type="button"
						class="btn btn-primary"
						:to="{ name: 'NewTransaction', params: { vcard: idVcard } }"
					>
						<i class="bi bi-plus" style="color: white"></i>
						Add New Transaction
					</router-link>
				</div>
			</div>
			<br />
			<div class="table-responsive">
				<table class="table table-hover" style="width: 100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Info</th>
							<th scope="col">Date</th>
							<th scope="col">Old balance</th>
							<th scope="col" style="width: 10%">Mount</th>
							<th scope="col">New balance</th>
							<th scope="col">Payment type</th>
							<!-- 
							<th scope="col">pair_transaction</th>
							<th scope="col">pair_vcard</th>
							<th scope="col">Category</th>
							<th scope="col">Description</th>
							-->
							<th scope="col">Tools</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="transaction in transactions" :key="transaction.id">
							<th scope="row">{{ transaction.id }}</th>
							<td>
								<p style="font-size: 18px; display: inline">
									{{ transaction.payment_reference }}
								</p>
								<p class="text-secondary" style="font-size: 16px"></p>
							</td>
							<td>{{ transaction.datetime }}</td>
							<td>${{ transaction.old_balance }}</td>
							<td v-if="transaction.type == 'C'">
								<p style="display: inline; font-weight: 700; color: green">
									<i class="bi bi-arrow-bar-down label-success"></i>
									${{ Math.round((transaction.new_balance - transaction.old_balance) * 100) / 100 }}
								</p>
							</td>
							<td v-else>
								<p style="display: inline; font-weight: 700; color: rgb(253, 53, 53)">
									<i class="bi bi-arrow-bar-up label-danger"></i>
									${{ Math.round((transaction.old_balance - transaction.new_balance) * 100) / 100 }}
								</p>
							</td>
							<td>${{ transaction.new_balance }}</td>
							<td>{{ transaction.payment_type }}</td>
							<!--
							<td>{{ transaction.pair_transaction || "N/A" }}</td>
							<td>{{ transaction.pair_vcard || "N/A" }}</td>
							<td>
								<div class="label-primary">
									{{ transaction.category_name || "uncategorized" }}
								</div>
							</td>
							<td v-if="transaction.description == null">
								<p class="text-secondary" style="font-size: 12px">
									Without description
								</p>
							</td>
							<td v-else>{{ transaction.description }}</td>
							-->
							<td>
								<router-link
									type="button"
									class="btn btn-primary btn-sm"
									:to="{
										name: 'Transaction',
										params: { vcard: idVcard, id: transaction.id },
									}"
									><i class="bi-pencil-square" style="color: white"></i
								></router-link>
							</td>
						</tr>
					</tbody>
				</table>
				<br />
				<div v-if="transactions.length == 0" class="text-secondary" style="text-align: center">
					<h3>You have not made any transaction yet</h3>
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
		</div>
		<br />
	</div>
</template>

<script>
	export default {
		name: "Transactions",
		props: {
			idVcard: {
				type: String,
				default: "",
			},
		},

		computed: {},

		data() {
			return {
				categories: [],
				transactions: [],
				nPages: null,
				currentPage: 1,
			}
		},

		methods: {
			getTransactions() {
				this.$axios
					.get("vcards/" + this.idVcard + "/transactions?page=" + this.currentPage)
					.then(response => {
						this.transactions = response.data.data
						this.nPages = response.data.meta.last_page
					})
					.catch(error => {
						console.log(error)
					})
			},

			previousPage() {
				if (this.currentPage - 1 < 0) return

				this.currentPage--
				this.getTransactions()
			},

			nextPage() {
				if (this.currentPage + 1 > this.nPages) return

				this.currentPage++
				this.getTransactions()
			},
		},

		mounted() {
			this.getTransactions()
		},
	}
</script>

<style scoped lang="css">
	@import "../../assets/css/style.css";
</style>
