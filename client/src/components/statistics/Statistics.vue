<template>
	<div>
		<h2 style="margin-top: 30px">Statistics</h2>
		<div v-if="graphData">
			<transactions-statistics :graphData="graphData"></transactions-statistics>
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
				transactions: [],
				graphData: null,
			}
		},
		methods: {
			async getMountOfDay() {
				var array = [["", 0]]

				await this.$axios
					.get("vcards/" + this.idVcard + "/transactions")
					.then(response => {
						this.transactions = response.data.data
					})
					.catch(error => {
						console.log(error)
					})

				for (let i = 0; i < this.transactions.length; i++) {
					array.push([this.transactions[i].date.slice(5, 11), this.transactions[i].new_balance])
				}

				console.log(array)
				this.graphData = array
			},
		},
		mounted() {
			this.getMountOfDay()
		},
	}
</script>

<style></style>
