<template>
	<div>
		<div class="row">
			<div class="content col-md-3">
				<div class="row">
					<div class="col-md-12">
						<Datepicker
							v-model="date"
							:enableTimePicker="false"
							placeholder="Select a date ..."
							range
							twoCalendars
						/>
						{{ formatData }}
					</div>
				</div>
			</div>
		</div>
		<br />
		<div class="content">
			<div class="row align-items-center">
				<div class="col-md-6">
					<h5>Year summary</h5>
				</div>
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
			<div v-if="graph">
				<area-chart :colors="['#4e79e0']" :data="graphData"></area-chart>
			</div>
			<column-chart v-else :colors="['#4e79e0']" :data="graphData"></column-chart>
		</div>
	</div>
</template>

<script>
	export default {
		name: "TransactionsStatistics",
		props: {
			graphData: {
				type: Object,
				required: true,
			},
		},
		data() {
			return {
				graph: true,
				date: null,
			}
		},
		computed: {
			formatData() {
				if (this.date == null) {
					return 0
				}
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

				return date1 + " " + date2
			},
		},
		methods: {
			graphType() {
				this.graph = !this.graph
				console.log(this.graph)
			},
		},
	}
</script>

<style></style>
