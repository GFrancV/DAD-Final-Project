<template>
	<div>
		<h2 style="margin-top: 30px">Statistics</h2>
		<balance-summary v-if="transactions" :transactions="transactions"></balance-summary>
		<br />
		<div class="row" style="margin-left: 5px">
			<div class="col-md-8">
				<table-statistics v-if="transactions" :transactions="transactions"></table-statistics>
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
	import TableStatistics from "./TableStatics.vue"

	export default {
		name: "Statistics",
		components: {
			BalanceSummary,
			ExpensesCategory,
			TableStatistics,
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
					.get("vcards/" + this.idVcard + "/AllTransactions")
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
