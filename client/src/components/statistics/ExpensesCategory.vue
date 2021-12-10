<template>
	<h5>Expenses by categories</h5>
	<pie-chart :data="graphData" :donut="true" :round="2" prefix="$"></pie-chart>
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
				var array = []
				var uncathegory = 0

				for (let i = 0; i < this.categories.length; i++) {
					var count = 0
					for (let j = 0; j < this.transactions.length; j++) {
						if (
							this.categories[i].name == this.transactions[j].category_name &&
							this.transactions[j].type == "D"
						)
							count = count + this.transactions[j].value
						else if (this.transactions[j].category_name == "" && this.transactions[j].type == "D") {
							uncathegory = uncathegory + this.transactions[j].value
						}
					}
					if (count == 0) continue

					array.push([this.categories[i].name, count])
				}

				if (uncathegory != 0) array.push(["uncathegory", uncathegory])

				this.graphData = array
			},
		},
		mounted() {
			this.getStatistics()
		},
	}
</script>

<style></style>
