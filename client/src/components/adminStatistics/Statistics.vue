<template>
	<div>
		<h2 style="margin-top: 30px">Global statistics</h2>
		<div v-if="vcards" class="row">
			<div class="col-md-6">
				<balance-sum :vcards="vcards"></balance-sum>
				<br />
				<active-vcards :vcards="vcards"></active-vcards>
				<br />
			</div>
			<div class="col-md-6">
				<vcards-balance></vcards-balance>
			</div>
		</div>
	</div>
</template>

<script>
	import BalanceSum from "./BalanceSum.vue"
	import ActiveVcards from "./ActiveVcards.vue"
	import VcardsBalance from "./VcardsBalance.vue"

	export default {
		name: "AdminStatistics",
		components: {
			BalanceSum,
			ActiveVcards,
			VcardsBalance,
		},
		data() {
			return {
				vcards: null,
			}
		},
		methods: {
			getVcards() {
				this.$axios
					.get("vcardsAll")
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
