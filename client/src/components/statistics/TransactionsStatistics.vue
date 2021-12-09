<template>
	<area-chart :colors="['#4e79e0', '#ffffff']" :data="graphData"></area-chart>
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
			return {}
		},
	}
</script>

<style></style>
