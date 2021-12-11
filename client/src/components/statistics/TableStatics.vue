<template>
	<h5>Summary tables</h5>
	<div class="content">
		<div class="row">
			<div class="col-sm-7">
				<pie-chart :data="graphData" :donut="true" :round="2" prefix="$"></pie-chart>
			</div>
			<div class="col-sm-5">
				<div class="content">
					<div class="content-success">
						<p>
							<i class="bi bi-arrow-down"></i>
							<span style="font-size: 22px; font-weight: bold">$ {{ debit }}</span>
						</p>
						<p style="font-size: 16px">Debit</p>
					</div>
					<br />
					<div class="content-danger">
						<p>
							<i class="bi bi-arrow-down" style="font-weight: bold"></i>
							<span style="font-size: 22px; font-weight: bold">$ {{ credit }}</span>
						</p>
						<p style="font-size: 16px">Credit</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "TableStatistics",
		props: {
			transactions: {
				type: Object,
				required: true,
			},
		},
		data() {
			return {
				graphData: null,
				credit: 0,
				debit: 0,
			}
		},
		methods: {
			getAmounts() {
				for (let i = 0; i < this.transactions.length; i++) {
					console.log(this.transactions[i].type)
					if (this.transactions[i].type == "C")
						this.credit =
							Math.round((this.credit + parseFloat(this.transactions[i].value)) * 100) / 100
					else
						this.debit =
							Math.round((this.debit + parseFloat(this.transactions[i].value)) * 100) / 100
				}

				this.graphData = [
					["Credit", this.credit],
					["Debit", this.debit],
				]
			},
		},
		mounted() {
			this.getAmounts()
		},
	}
</script>

<style></style>
