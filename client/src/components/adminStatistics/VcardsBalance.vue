<template>
	<h5>vCards Balance</h5>
	<div class="content">
		<div class="table-responsive">
			<table class="table table-hover" style="width: 100%">
				<thead>
					<th scope="col">vCard</th>
					<th scope="col">Current balance</th>
				</thead>
				<tbody>
					<tr>
						<td>90000001</td>
						<td>$300.00</td>
					</tr>
					<tr>
						<td>90000001</td>
						<td>$300.00</td>
					</tr>
					<tr>
						<td>90000001</td>
						<td>$300.00</td>
					</tr>
					<tr>
						<td>90000001</td>
						<td>$300.00</td>
					</tr>
				</tbody>
			</table>
		</div>
	</div>
</template>

<script>
	export default {
		name: "VcardsBalance",
		data() {
			return {
				vcardsInfo: [],
			}
		},
		methods: {
			getVcardsInfo() {},
		},
	}
</script>

<style></style>
