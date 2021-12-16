<template>
	<h5>Payment types</h5>
	<div class="content">
		<div style="border-bottom: 10px">Summary of transactions of the total vcards.</div>
		<br />
		<div class="row label-primary">
			<div class="col-sm-8">MBWAY</div>
			<div class="col-sm-4">$200</div>
		</div>
		<br />
		<div class="row label-primary">
			<div class="col-sm-8">MBWAY</div>
			<div class="col-sm-4">$200</div>
		</div>
		<br />
		<div class="row label-primary">
			<div class="col-sm-8">MBWAY</div>
			<div class="col-sm-4">$200</div>
		</div>
		<br />
		<div class="row label-primary">
			<div class="col-sm-8">MBWAY</div>
			<div class="col-sm-4">$200</div>
		</div>
		<br />
		<div class="row label-primary">
			<div class="col-sm-8">MBWAY</div>
			<div class="col-sm-4">$200</div>
		</div>
		<br />
		<div class="row label-primary">
			<div class="col-sm-8">MBWAY</div>
			<div class="col-sm-4">$200</div>
		</div>
		<br />
	</div>
</template>

<script>
	export default {
		name: "PaymentTypesSum",
		props: {
			vcards: {
				type: Object,
				required: true,
			},
		},
		data() {
			return {}
		},
		methods: {},
		mounted() {},
	}
</script>

<style></style>
