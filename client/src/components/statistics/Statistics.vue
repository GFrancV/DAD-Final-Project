<template>
	<div>
		<h2 style="margin-top: 30px">Statistics</h2>
		<div v-if="transactions">
			<balance-summary :transactions="transactions"></balance-summary>
		</div>
		<br />
		<div class="row" style="margin-left: 5px">
			<div class="col-md-8">
				<div class="content"><h5>Summary table</h5></div>
			</div>
			<div class="col-md-4">
				<div class="content">
					<expenses-category
						v-if="categories && transactions"
						:transactions="transactions"
						:categories="categories"
					></expenses-category>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import BalanceSummary from "./BalanceSummary.vue"
	import ExpensesCategory from "./ExpensesCategory.vue"

	export default {
		name: "Statistics",
		components: {
			BalanceSummary,
			ExpensesCategory,
		},

		props: {
			idVcard: {
				type: String,
				default: "",
			},
		},
		data() {
			return {
				transactions: null,
				categories: null,
			}
		},
		methods: {
			getTransactions() {
				this.$axios
					.get("vcards/" + this.idVcard + "/transactions")
					.then(response => {
						this.transactions = response.data.data
					})
					.catch(error => {
						console.log(error)
					})
			},

			getCategories() {
				this.$axios
					.get("vcards/" + this.idVcard + "/categories")
					.then(response => {
						this.categories = response.data
					})
					.catch(error => {
						console.log(error)
					})
			},
		},
		mounted() {
			this.getTransactions()
			this.getCategories()
		},
	}
</script>

<style></style>
