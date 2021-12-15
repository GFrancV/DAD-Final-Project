<template>
	<h5>Active Vcards</h5>
	<div class="content">
		<pie-chart
			:data="[
				['Active', 60],
				['Bloqued', 40],
			]"
			:donut="true"
		></pie-chart>
	</div>
</template>

<script>
	export default {
		name: "ActiveVcards",
	}
</script>

<style></style>
