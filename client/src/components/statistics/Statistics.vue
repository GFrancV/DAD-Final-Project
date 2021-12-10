<template>
	<div>
		<h2 style="margin-top: 30px">Statistics</h2>
		<div v-if="transactions">
			<transactions-statistics :transactions="transactions"></transactions-statistics>
		</div>
		<br />
		<div class="content">
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
	import TransactionsStatistics from "./TransactionsStatistics.vue"

	export default {
		name: "Statistics",
		components: {
			TransactionsStatistics,
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
