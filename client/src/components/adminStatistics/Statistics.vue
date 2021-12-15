<template>
	<div>
		<h2 style="margin-top: 30px">Global statistics</h2>
		<div class="content"></div>
		<br />
		<div class="row">
			<div class="col-sm-6">
				<vcards-balance></vcards-balance>
			</div>
			<div class="col-sm-6">
				<active-vcards></active-vcards>
				<br />
				<payment-type-sum></payment-type-sum>
			</div>
		</div>
	</div>
</template>

<script>
	import VcardsBalance from "./VcardsBalance.vue"
	import ActiveVcards from "./ActiveVcards.vue"
	import PaymentTypeSum from "./PaymentTypesSum.vue"

	export default {
		name: "AdminStatistics",
		components: {
			VcardsBalance,
			ActiveVcards,
			PaymentTypeSum,
		},
	}
</script>

<style></style>
