<template>
	<div>
		<h5 style="margin-top: 30px">{{ transactionTitle }}</h5>
		<div class="content">
			<form class="row g-3 needs-validation" novalidate @submit.prevent="save">
				<!--
        <h6>ID transaction</h6>
				<input
					id="inputVCard"
					class="form-control"
					type="text"
					:value="transaction.id"
					aria-label="vCard number"
					readonly
				/>
        -->
				<h6>Date of transaction</h6>
				<input
					id="inputVCard"
					class="form-control"
					type="text"
					:value="editingTransaction.datetime"
					aria-label="vCard number"
					readonly
				/>
				<h6>Type</h6>
				<input
					id="inputVCard"
					class="form-control"
					type="text"
					:value="editingTransaction.type"
					aria-label="vCard number"
					readonly
				/>
				<div class="row">
					<div class="col">
						<h6>Old balance</h6>
						<input
							id="inputVCard"
							class="form-control"
							type="text"
							:value="editingTransaction.old_balance"
							aria-label="vCard number"
							readonly
						/>
					</div>
					<div class="col">
						<h6>Mount</h6>
						<input
							id="inputVCard"
							class="form-control"
							type="text"
							:value="editingTransaction.value"
							aria-label="vCard number"
							readonly
						/>
					</div>
					<div class="col">
						<h6>New balance</h6>
						<input
							id="inputVCard"
							class="form-control"
							type="text"
							:value="editingTransaction.new_balance"
							aria-label="vCard number"
							readonly
						/>
					</div>
				</div>
				<div class="row">
					<div class="col">
						<label for="inputCategory" class="form-label">Categories</label>
						<select
							class="form-select"
							id="inputCategory"
							:disabled="editingTransaction.category_name"
							v-model="editingTransaction.categot_id"
						>
							<option :value="null">Without category</option>
							<option v-for="cat in categories" :key="cat.id" :value="cat.id">
								{{ cat.name }}
							</option>
						</select>
					</div>
				</div>
				<div class="mb-3">
					<label for="inputNotes" class="form-label">Description</label>
					<textarea
						class="form-control"
						id="inputNotes"
						rows="4"
						v-model="editingTransaction.description"
					></textarea>
				</div>
				<div class="mb-3 d-flex justify-content-end">
					<button type="button" class="btn btn-primary px-5" @click="save">Save</button>
					<button type="button" class="btn btn-light px-5" @click="cancel">Cancel</button>
				</div>
			</form>
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
    categories: {
      type: Array,
      required: true,
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
