<template>
	<div>
		<h2 style="margin-top: 30px">Statistics</h2>
		<div v-if="transactions">
			<balance-summary :transactions="transactions"></balance-summary>
		</div>
		<br />
		<div class="content">
			<h5>Expenses by categories</h5>
			<pie-chart
				:data="[
					['Blueberry', 44],
					['Strawberry', 23],
				]"
				:donut="true"
			></pie-chart>
		</div>
	</div>
</template>

<script>
	import BalanceSummary from "./BalanceSummary.vue"

	export default {
		name: "Statistics",
		components: {
			BalanceSummary,
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
		},
		mounted() {
			this.getTransactions()
		},
	}
</script>

<style></style>
