<template>
	<div>
		<h2 style="margin-top: 30px">Statistics</h2>
		<div class="row">
			<div class="content col-md-4">
				<div class="row">
					<div class="col-md-5">
						<select id="inputState" class="form-control">
							<option selected>22/11/2021</option>
							<option>21/11/2021</option>
							<option>20/11/2021</option>
						</select>
					</div>
					-
					<div class="col-md-5">
						<select id="inputState" class="form-control">
							<option selected>22/11/2021</option>
							<option>21/11/2021</option>
							<option>20/11/2021</option>
						</select>
					</div>
					<div class="col-md-1"><i class="bi bi-calendar3" style="color: #5176e0"></i></div>
				</div>
			</div>
		</div>
		<br />
		<div class="content">
			<h5>Year summary</h5>
			<br />
			<div class="row align-items-center">
				<div class="col-md-12" style="text-align: right">
					<button v-if="graph" v-on:click="graphType()" type="button" class="btn btn-primary">
						<i class="bi bi-bar-chart" style="color: white"></i>
					</button>
					<button v-else v-on:click="graphType()" type="button" class="btn btn-primary">
						<i class="bi bi-graph-up" style="color: white"></i>
					</button>
				</div>
			</div>

			<br />
			<div v-if="graphData != null && graph">
				<transactions-statistics :graphData="graphData"></transactions-statistics>
			</div>
			<column-chart v-else :colors="['#4e79e0']" :data="graphData"></column-chart>
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
				graph: true,
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

			graphType() {
				this.graph = !this.graph
				console.log(this.graph)
			},
		},
		mounted() {
			this.getMountOfDay()
		},
	}
</script>

<style></style>
