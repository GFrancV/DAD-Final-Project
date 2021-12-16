<template>
	<div>
		<h2 style="margin-top: 30px">Global statistics</h2>
		<div v-if="vcards" class="row">
			<div class="col-md-6">
				<balance-sum :vcards="vcards"></balance-sum>
				<br />
				<active-vcards :vcards="vcards"></active-vcards>
				<br />
				<payment-type-sum :vcards="vcards"></payment-type-sum>
			</div>
			<div class="col-md-6">
				<vcards-balance :vcards="vcards"></vcards-balance>
			</div>
		</div>
	</div>
</template>

<script>
	import VcardsBalance from "./VcardsBalance.vue"
	import ActiveVcards from "./ActiveVcards.vue"
	import PaymentTypeSum from "./PaymentTypesSum.vue"
	import BalanceSum from "./BalanceSum.vue"

	export default {
		name: "AdminStatistics",
		components: {
			VcardsBalance,
			ActiveVcards,
			PaymentTypeSum,
			BalanceSum,
		},
		data() {
			return {
				vcards: null,
			}
		},
		methods: {
			getVcards() {
				this.$axios
					.get("vcards")
					.then(response => {
						this.vcards = response.data.data
					})
					.catch(error => {
						console.log(error)
					})
			},
		},
		mounted() {
			this.getVcards()
		},
	}
</script>

<style></style>
