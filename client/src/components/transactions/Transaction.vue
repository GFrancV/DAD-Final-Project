<template>
	<transaction-detail
		:operationType="operation"
		:idVcard="idVcard"
		:transaction="transaction"
		:categories="categories"
		@save="save"
		@cancel="cancel"
	></transaction-detail>
</template>

<script>
import TransactionDetail from "./TransactionDetail.vue";

export default {
	name: "Transactions",
	components: {
		TransactionDetail,
	},

	props: {
		idVcard: {
			type: String,
			default: "",
		},
		idTransaction: {
			type: Number,
			default: null,
		},
	},

	data() {
		return {
			transaction: this.newTransaction(),
			categories: [],
		};
	},

	computed: {
		operation() {
			return !this.idTransaction || this.idTransaction < 0
				? "insert"
				: "update";
		},
	},

	watch: {
		idTransaction: {
			immediate: true,
			handler(newValue) {
				this.loadTransaction(newValue);
			},
		},
	},

	methods: {
		newTransaction() {
			return {
				vcard: this.idVcard,
				date: "",
				type: "",
				datetime: "",
				value: null,
				old_balance: "",
				new_balance: "",
				payment_type: "",
				payment_reference: "",
				pair_transaction: null,
				pair_vcard: null,
				category_id: null,
				category_name: "",
				description: "",
			};
		},

		loadTransaction(idTransaction) {
			if (!idTransaction || idTransaction < 0) {
				this.transaction = this.newTransaction();
			} else {
				this.$axios
					.get("vcards/" + this.idVcard + "/transactions/" + this.idTransaction)
					.then((response) => {
						this.transaction = response.data.data;
						console.log(this.transaction);
					})
					.catch((error) => {
						console.log(error);
					});
			}
			console.log(this.transaction);
		},

		save(transaction) {
			if (this.operation == "insert") {
				this.$axios
					.post("vcards/" + this.idVcard + "/transactions", transaction)
					.then((response) => {
						this.$toast.success(
							"Transaction #" +
								response.data.data.idTransaction +
								" was created successfully."
						);
						this.$router.back();
					})
					.catch((error) => {
						if (error.response.status == 422) {
							this.$toast.error(
								"Transaction was not created due to validation errors!"
							);
						} else {
							this.$toast.error(
								"Transaction was not created due to unknown server error!"
							);
						}
					});
			} else {
				this.$axios
					.put(
						"vcards/" + this.idVcard + "/transactions/" + this.idTransaction,
						transaction
					)
					.then((response) => {
						this.$toast.success(
							"Transaction #" +
								response.data.data.id +
								" was updated successfully."
						);
					})
					.catch((error) => {
						if (error.response.status == 422) {
							this.$toast.error(
								"Transaction #" +
									this.idTransaction +
									" was not updated due to validation errors!"
							);
						} else {
							this.$toast.error(
								"Transaction #" +
									this.idTransaction +
									" was not updated due to unknown server error!"
							);
						}
					});
			}
			console.log(this.transaction);
		},

		cancel() {
			this.$router.back();
		},
	},

	mounted() {
		this.categories = [];
		this.$axios
			.get("vcards/" + this.idVcard + "/categories")
			.then((response) => {
				this.categories = response.data;
			})
			.catch((error) => {
				console.log(error);
			});
	},
};
</script>

<style scoped lang="scss"></style>
