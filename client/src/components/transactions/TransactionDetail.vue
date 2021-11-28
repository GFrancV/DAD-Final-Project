<template>
	<div>
		<h4 style="margin-top: 30px">{{ transactionTitle }}</h4>
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
				<div class="row" style="margin-top: 20px">
					<div class="col-auto">
						<h6><label class="sr-only" for="inputDate">Date of transaction</label></h6>
						<div class="input-group mb-2">
							<input
								id="inputDate"
								class="form-control"
								type="text"
								:value="editingTransaction.datetime"
								readonly
							/>
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="bi bi-calendar3"></i></div>
							</div>
						</div>
					</div>

					<div class="col-auto"></div>
				</div>

				<div class="row">
					<div class="col-sm-8">
						<h6><label for="inputReference">Reference of payment</label></h6>
						<input
							id="inputReference"
							class="form-control"
							type="text"
							:value="editingTransaction.payment_reference"
							readonly
						/>
					</div>
					<div class="col-sm-4">
						<h6><label class="sr-only" for="inputType">Type</label></h6>
						<div class="input-group mb-2">
							<input
								id="inputType"
								class="form-control"
								type="text"
								:value="transactionType"
								readonly
							/>
							<div v-if="transactionType == 'Debit'" class="input-group-prepend">
								<div class="input-group-text"><i class="bi bi-arrow-bar-up label-danger"></i></div>
							</div>
							<div v-else class="input-group-prepend">
								<div class="input-group-text label-success">
									<i class="bi bi-arrow-bar-down label-success"></i>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div class="row" style="margin-top: 20px">
					<div class="col-sm-3">
						<h6>Old balance</h6>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input
								id="inputVCard"
								class="form-control"
								type="text"
								:value="editingTransaction.old_balance"
								aria-label="vCard number"
								readonly
							/>
						</div>
					</div>
					<div class="col-sm-1 d-flex justify-content-center align-items-center">
						<i class="bi bi-arrow-right"></i>
					</div>
					<div class="col-sm-4">
						<h6>Mount</h6>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input
								id="inputVCard"
								class="form-control"
								type="text"
								:value="editingTransaction.value"
								aria-label="vCard number"
								readonly
							/>
						</div>
					</div>
					<div class="col-sm-1 d-flex justify-content-center align-items-center">
						<i class="bi bi-arrow-right"></i>
					</div>
					<div class="col-sm-3">
						<h6>New balance</h6>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
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
				</div>

				<div class="row">
					<div class="col">
						<label for="inputCategory" class="form-label">Categories</label>
						<select class="form-select" id="inputCategory" v-model="editingTransaction.category_id">
							<option :value="null">-- Without category --</option>
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

		transactionType() {
			if (!this.editingTransaction) {
				return "";
			}
			return this.editingTransaction.type == "D" ? "Debit" : "Credit";
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

<style scoped lang="css"></style>
