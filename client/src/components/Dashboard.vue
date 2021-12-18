<template>
	<div>
		<div class="row">
			<div class="col-sm-5 col-md-8 content-primary">
				<h2 style="margin-top: 30px">Dashboard</h2>
				<div v-if="allTransactions">
					<balance-summary :transactions="allTransactions"></balance-summary>
				</div>
				<!-- Force next columns to break to new line -->
				<br />
				<div class="row" style="margin-left: 5px">
					<div class="col-md-8">
						<!--Show Transactions-->
						<h4>Transactions</h4>
						<div class="content">
							<div class="table-responsive">
								<table class="table table-hover" style="width: 100%">
									<thead>
										<tr>
											<th scope="col"></th>
											<th scope="col">Info</th>
											<th scope="col">Amount</th>
											<th scope="col">Action</th>
										</tr>
									</thead>

									<tbody>
										<tr v-for="transaction in transactions.slice(0, 5)" :key="transaction.id">
											<td>
												<i
													v-if="transaction.type == 'C'"
													class="bi bi-arrow-bar-down label-success"
												></i>
												<i v-else class="bi bi-arrow-bar-up label-danger"></i>
											</td>
											<td>
												{{ transaction.payment_reference }}
												<p class="text-secondary" style="font-size: 16px">
													{{ transaction.datetime }}
												</p>
											</td>
											<td>
												<p
													v-if="transaction.type == 'C'"
													style="display: inline; font-weight: 700; color: green"
												>
													${{
														Math.round((transaction.new_balance - transaction.old_balance) * 100) /
														100
													}}
												</p>
												<p
													v-else
													style="display: inline; font-weight: 700; color: rgb(253, 53, 53)"
												>
													${{
														Math.round((transaction.old_balance - transaction.new_balance) * 100) /
														100
													}}
												</p>
											</td>
											<td>
												<router-link
													type="button"
													class="btn btn-primary btn-sm"
													:to="{
														name: 'Transaction',
														params: {
															vcard: vCardId,
															id: transaction.id,
														},
													}"
													><i class="bi-pencil-square" style="color: white"></i
												></router-link>
											</td>
										</tr>
									</tbody>
								</table>
								<br />
								<div
									v-if="transactions.length == 0"
									class="text-secondary"
									style="text-align: center"
								>
									<h5>You have not made any transaction yet</h5>
								</div>
							</div>
							<router-link
								class="mb-3 d-flex justify-content-end"
								aria-current="page"
								:to="{
									name: 'Transactions',
									params: {
										vcard: vCardId,
									},
								}"
							>
								Show more transactions -->
							</router-link>
						</div>
					</div>

					<div class="col-md-4">
						<h4>Categories</h4>
						<div class="content">
							<div v-for="category in categories.slice(0, 10)" :key="category.id">
								<p class="label-primary">
									<router-link
										style="text-decoration: none"
										aria-label="Add category"
										:to="{
											name: 'CategoryUpdate',
											params: {
												vcardId: vCardId,
												id: category.id,
											},
										}"
									>
										{{ category.name }}
									</router-link>
								</p>
							</div>
							<router-link
								class="mb-3 d-flex justify-content-end"
								aria-current="page"
								:to="{
									name: 'Categories',
									params: {
										vcardId: vCardId,
									},
								}"
							>
								Show more categories -->
							</router-link>
						</div>
					</div>
				</div>
			</div>

			<div class="col-sm-5 offset-sm-2 col-md-4 offset-md-0 content-secondary">
				<!--Visual vCard-->
				<div class="secondary-info">
					<div class="row">
						<div class="col">
							<h2>My vCard</h2>
							<div class="vcard">
								<div class="logo">
									<img src="../assets/img/logo-visa.png" alt="Visa" />
								</div>
								<div class="number">{{ vCardInfo.phone_number }}</div>
								<div class="value">${{ vCardInfo.balance }}</div>
								<div class="name">{{ vCardInfo.name }}</div>
								<div class="ring"></div>
							</div>
						</div>
					</div>
					<br />
					<br />
					<!--vCard Info-->
					<div class="card mb-3" style="max-width: 300px">
						<div class="card-header">Card Information</div>
						<div class="card-body">
							<div class="row">
								<div class="card-text col align-self-start text-secondary">Status</div>
								<div class="card-text col align-self-end text-right" style="text-align: right">
									<p
										v-if="vCardInfo.blocked == false"
										class="label-success"
										style="display: inline"
									>
										Active
									</p>
									<p v-else class="label-danger">Blocked</p>
								</div>
							</div>
							<br />
							<div class="row">
								<div class="card-text col align-self-start text-secondary">Name</div>
								<div class="card-text col align-self-end" style="text-align: right">
									{{ vCardInfo.name }}
								</div>
							</div>
							<br />
							<div class="card-text col align-self-start text-secondary">Email</div>
							<div class="card-text col align-self-end" style="text-align: right">
								{{ vCardInfo.email }}
							</div>
							<br />
							<div class="row">
								<div class="card-text col align-self-start text-secondary">Balance</div>
								<div class="card-text col align-self-end" style="text-align: right">
									${{ vCardInfo.balance }}
								</div>
							</div>
							<br />
							<div class="row">
								<div class="card-text col align-self-start text-secondary">Max debit</div>
								<div class="card-text col align-self-end" style="text-align: right">
									${{ vCardInfo.max_debit }}
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import BalanceSummary from "./statistics/BalanceSummary.vue"
	export default {
		name: "Dashboard",
		components: {
			BalanceSummary,
		},
		props: {},

		data() {
			return {
				vCardId: this.$store.state.user.id.toString(),
				vCardInfo: [],
				transactions: [],
				allTransactions: null,
				categories: [],
			}
		},

		methods: {
			getInfo() {
				this.$axios
					.get("vcards/" + this.vCardId)
					.then(response => {
						this.vCardInfo = response.data.data
					})
					.catch(error => {
						console.log(error)
					})
			},
			getTransactions() {
				this.$axios
					.get("vcards/" + this.vCardId + "/transactions")
					.then(response => {
						this.transactions = response.data.data
					})
					.catch(error => {
						console.log(error)
					})
			},
			getAllTransactions() {
				this.$axios
					.get("vcards/" + this.vCardId + "/AllTransactions")
					.then(response => {
						this.allTransactions = response.data.data
					})
					.catch(error => {
						console.log(error)
					})
			},
			getCategories() {
				this.$axios
					.get("vcards/" + this.vCardId + "/categories")
					.then(response => {
						this.categories = response.data
					})
					.catch(error => {
						console.log(error)
					})
			},
		},
		mounted() {
			this.getInfo()
			this.getAllTransactions()
			this.getTransactions()
			this.getCategories()
		},
	}
</script>

<style scoped lang="css">
	@import "../assets/css/style.css";
	@import "../assets/css/vcard.css";
	@import "../assets/css/containers.css";

	.card {
		border-radius: 25px;
	}
</style>
