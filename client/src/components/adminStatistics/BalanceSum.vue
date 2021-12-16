<template>
	<h5>Total money in vCard Platform</h5>
	<div class="content">
		<h1 style="font-weight: bold">${{ totalExpenditure }}</h1>
		<p class="text-secondary" style="font-size: 18px">Total money</p>
	</div>
</template>

<script>
	export default {
		name: "BalanceSum",
		props: {
			vcards: {
				type: Object,
				required: true,
			},
		},
		data() {
			return {
				totalExpenditure: 0,
			}
		},
		methods: {
			totalCalc() {
				var aux = 0

				for (let i = 0; i < this.vcards.length; i++) {
					aux = Math.round((aux + parseFloat(this.vcards[i].balance)) * 100) / 100
				}

				this.totalExpenditure = aux
			},
		},
		mounted() {
			this.totalCalc()
		},
	}
</script>

<style></style>
