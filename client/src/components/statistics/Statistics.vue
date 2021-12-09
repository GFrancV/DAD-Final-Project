<template>
	<h2 style="margin-top: 30px">Statistics of vCard {{ idVcard }}</h2>
	<div class="content">
		<h5>Transactions summary</h5>
		<br />
		<div v-if="graphData != null">
			<transactions-statistics :graphData="graphData"></transactions-statistics>
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
				var array = [["as", 20]]

				await this.$axios
					.get("vcards/" + this.idVcard + "/transactions")
					.then(response => {
						this.transactions = response.data.data
					})
					.catch(error => {
						console.log(error)
					})

				for (let i = 0; i < this.transactions.length; i++) {
					array.push([this.transactions[i].date, parseFloat(this.transactions[i].value)])
				}

				this.graphData = array
			},
		},
		mounted() {
			this.getMountOfDay()
		},
	}
</script>

<style></style>
