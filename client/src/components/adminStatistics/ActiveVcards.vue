<template>
	<h5>Active Vcards</h5>
	<div class="content">
		<pie-chart :data="vcardsStatus" :donut="true" :colors="['#4e79e0', '#bd4226']"></pie-chart>
		<br />
		<div class="row text-center" style="font-size: 18px">
			<div class="col-md-6"><span style="font-weight: bold">Total active:</span> {{ active }}</div>
			<div class="col-md-6">
				<span style="font-weight: bold">Total blocked:</span> {{ blocked }}
			</div>
		</div>
	</div>
</template>

<script>
	export default {
		name: "ActiveVcards",
		props: {
			vcards: {
				type: Object,
				required: true,
			},
		},
		data() {
			return {
				vcardsStatus: null,
				active: 0,
				blocked: 0,
			}
		},
		methods: {
			getStatus() {
				var aux = []
				var active = 0
				var block = 0

				for (let i = 0; i < this.vcards.length; i++) {
					if (this.vcards[i].blocked) block++
					else active++
				}

				aux.push(["Active", active], ["Blocked", block])

				this.active = active
				this.blocked = block
				this.vcardsStatus = aux
			},
		},
		mounted() {
			this.getStatus()
		},
	}
</script>

<style></style>
