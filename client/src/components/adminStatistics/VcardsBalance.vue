<template>
	<h5>vCards Balance</h5>
	<div class="content">
		<div class="table-responsive">
			<table class="table table-hover">
				<thead>
					<th scope="col">vCard</th>
					<th scope="col">Current balance</th>
				</thead>
				<tbody>
					<tr v-for="vcard in vcards" :key="vcard.phone_number">
						<td>{{ vcard.phone_number }}</td>
						<td>${{ vcard.balance }}</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default {
		name: "VcardsBalance",
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
	}
</script>

<style></style>
