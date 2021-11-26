<template>
	<div>
		<h5 style="margin-top: 30px">{{ transactionTitle }}</h5>
		<div class="content">
			{{ transaction.owner_id }}
			{{ transaction.id }}
		</div>
	</div>
</template>

<script>
export default {
	name: "Transactions",
	props: {
		transaction: {
			type: Object,
			required: true,
		},
		operationType: {
			type: String,
			default: "insert",
		},
		idVcard: {
			type: String,
			default: "",
		},
	},

	emits: ["save", "cancel"],

	data() {
		return {
			editingTransaction: this.transaction,
		};
	},

	watch: {
		transaction(newTransaction) {
			this.editingTransaction = newTransaction;
		},
	},

	computed: {
		transactionTitle() {
			if (!this.editingTransaction) {
				return "";
			}
			return this.operationType == "insert"
				? "New transaction of vCard " + this.transaction.owner_id
				: "Transaction " + this.transaction.id + " of vCard " + this.idVcard;
		},
	},

	methods: {
		save() {
			this.$emit("save", this.editingTransaction);
		},
		cancel() {
			this.$emit("cancel", this.editingTransaction);
		},
	},
};
</script>

<style scoped lang="scss"></style>
