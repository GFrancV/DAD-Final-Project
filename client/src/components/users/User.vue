<template>
	<user-detail :idUser="idUser" :user="user"></user-detail>
</template>

<script>
	import UserDetail from "./UserDetail.vue"
	export default {
		name: "User",
		components: {
			UserDetail,
		},
		props: {
			idUser: {
				type: String,
				default: "",
			},
		},
		data() {
			return {
				user: null,
			}
		},
		methods: {},
		mounted() {},
	}
</script>

<style scoped lang="scss"></style>
