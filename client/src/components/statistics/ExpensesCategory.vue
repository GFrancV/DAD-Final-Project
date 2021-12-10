<template>
	<h5>Expenses by categories</h5>
	<pie-chart :data="graphData" :donut="true"></pie-chart>
	{{ categories }}
</template>

<script>
	export default {
		name: "ExpensesCategory",
		props: {
			transactions: {
				type: Object,
				required: true,
			},
			categories: {
				type: Object,
				required: true,
			},
		},
		data() {
			return {
				graphData: null,
				graph: true,
				date: null,
				formatDate: null,
			}
		},
		methods: {
			getStatistics() {
				var array = [["", 0]]
				for (let i = 0; i < this.categories.length; i++) {
					var count = 0
					for (let j = 0; j < this.transactions.length; j++) {
						if (this.categories[i].name == this.transactions[j].category_name) {
							count = count + this.transactions[j].value
						}
					}
					array.push([this.categories[i].name, count])
				}

				this.graphData = array
			},
		},
		mounted() {
			this.getStatistics()
		},
	}
</script>

<style></style>
