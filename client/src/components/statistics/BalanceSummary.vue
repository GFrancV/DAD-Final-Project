<template>
	<div>
		<div class="row">
			<div class="content col-md-4">
				<div class="row">
					<div class="col-md-12">
						<datepicker
							v-model="date"
							:enableTimePicker="false"
							placeholder="Select a date ..."
							format="yyyy/MM/dd"
							range
							twoCalendars
							@update:modelValue="pickDate"
							@cleared="getStatistics"
						>
						</datepicker>
					</div>
				</div>
			</div>
		</div>
		<br />
		<div class="content">
			<div class="row align-items-center">
				<div class="col-md-6"><h5>Balance summary</h5></div>
				<div class="col-md-6" style="text-align: right">
					<button v-if="graph" v-on:click="graphType()" type="button" class="btn btn-primary">
						<i class="bi bi-bar-chart" style="color: white"></i>
					</button>
					<button v-else v-on:click="graphType()" type="button" class="btn btn-primary">
						<i class="bi bi-graph-up" style="color: white"></i>
					</button>
				</div>
			</div>

			<br />
			<area-chart v-if="graph" :colors="['#4e79e0']" :data="graphData" grid="true"></area-chart>
			<column-chart v-else :colors="['#4e79e0']" :data="graphData"></column-chart>
		</div>
	</div>
</template>

<script>
	export default {
		name: "BalanceSummary",
		props: {
			transactions: {
				type: Object,
				required: true,
			},
		},
		data() {
			return {
				graphData: null,
				graph: true,
				date: null,
				formatDate: null,
			}
		},
		computed: {},
		methods: {
			getStatistics() {
				var array = [["", 0]]
				for (let i = 0; i < this.transactions.length; i++) {
					array.push([this.transactions[i].date.slice(5, 11), this.transactions[i].new_balance])
				}

				this.graphData = array
			},

			pickDate() {
				if (this.date == null) {
					this.formatDate = ""
				} else {
					var aux1 = this.date[0]
					var aux2 = this.date[1]

					var date1 =
						aux1.getFullYear() +
						"-" +
						(aux1.getMonth() + 1 < 10 ? "0" + (aux1.getMonth() + 1) : aux1.getMonth() + 1) +
						"-" +
						(aux1.getDate() < 10 ? "0" + aux1.getDate() : aux1.getDate())
					var date2 =
						aux2.getFullYear() +
						"-" +
						(aux2.getMonth() + 1 < 10 ? "0" + (aux2.getMonth() + 1) : aux2.getMonth() + 1) +
						"-" +
						(aux2.getDate() < 10 ? "0" + aux2.getDate() : aux2.getDate())

					this.formatDate = [date1, date2]
				}

				this.getSpecificsStatistics()
			},

			getSpecificsStatistics() {
				var auxData = []
				for (let i = 0; i < this.transactions.length; i++) {
					if (
						this.formatDate[0] <= this.transactions[i].date &&
						this.transactions[i].date <= this.formatDate[1]
					) {
						auxData.push([this.transactions[i].date, this.transactions[i].new_balance])
					}
				}

				if (auxData.length == 1) auxData = []

				this.graphData = auxData
			},

			graphType() {
				this.graph = !this.graph
			},
		},
		mounted() {
			this.getStatistics()
		},
	}
</script>

<style></style>
