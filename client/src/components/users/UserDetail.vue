<template>
	<div>
		<h2 style="margin-top: 30px">User {{ idUser }}</h2>
		<div class="content"></div>
	</div>
</template>

<script>
	export default {
		name: "UserDetail",
		props: {
			idUser: {
				type: String,
				default: "",
			},
			user: {
				type: Object,
				required: true,
			},
		},
	}
</script>

<style></style>
