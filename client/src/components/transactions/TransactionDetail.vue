<template>
	<div>
		<h2 style="margin-top: 30px">{{ transactionTitle }}</h2>
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
				<!--Date-->
				<div class="row" style="margin-top: 20px">
					<!--Date transaction-->
					<div class="col-auto">
						<h6>
							<label class="sr-only" for="inputDate">Date of transaction</label>
						</h6>
						<div class="input-group mb-2">
							<input
								id="inputDate"
								class="form-control"
								type="text"
								:value="editingTransaction.datetime"
								readonly
							/>
							<div class="input-group-prepend">
								<div class="input-group-text">
									<i class="bi bi-calendar3"></i>
								</div>
							</div>
						</div>
					</div>

					<div class="col-auto"></div>
				</div>

				<!--Payment reference-->
				<div class="row" style="margin-top: 20px">
					<div class="col-sm-8">
						<h6><label for="inputReference">Reference of payment</label></h6>
						<input
							v-if="operationType != 'insert'"
							id="inputReference"
							class="form-control"
							type="text"
							v-model="editingTransaction.payment_reference"
							readonly
						/>
						<input
							v-else
							id="inputReference"
							class="form-control"
							type="text"
							v-model="editingTransaction.payment_reference"
						/>
					</div>

					<!--Transaction type-->
					<div class="col-sm-4">
						<h6><label class="sr-only" for="inputType">Type</label></h6>
						<div class="input-group mb-2">
							<input
								id="inputType"
								class="form-control"
								type="text"
								:value="editingTransaction.type"
								readonly
							/>
							<div v-if="editingTransaction.type == 'D'" class="input-group-prepend">
								<div class="input-group-text label-danger">
									<i class="bi bi-arrow-bar-up label-danger"></i>
								</div>
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
					<!--Old balance/Current balance-->
					<div class="col-sm-3">
						<label for="inputVCard"><h6>Old balance</h6></label>
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

					<!--Amount-->
					<div class="col-sm-4">
						<label for="inputVCard"><h6>Amount</h6></label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input
								v-if="operationType != 'insert'"
								id="inputVCard"
								class="form-control"
								type="text"
								:value="editingTransaction.value"
								aria-label="vCard number"
								readonly
							/>
							<input
								v-else
								@keyup="calculateNewValue"
								id="inputVCard"
								class="form-control"
								type="number"
								required=""
								v-model="editingTransaction.value"
								aria-label="vCard number"
							/>
						</div>
					</div>

					<div class="col-sm-1 d-flex justify-content-center align-items-center">
						<i class="bi bi-arrow-right"></i>
					</div>

					<!--New balance-->
					<div class="col-sm-3">
						<label for="inputVCard"><h6>New balance</h6></label>
						<div class="input-group mb-3">
							<div class="input-group-prepend">
								<span class="input-group-text">$</span>
							</div>
							<input
								v-if="operationType != 'insert'"
								id="inputVCard"
								class="form-control"
								type="text"
								:value="editingTransaction.new_balance"
								aria-label="vCard number"
								readonly
							/>
							<input
								v-else
								id="inputVCard"
								class="form-control"
								type="text"
								:value="newBalance"
								aria-label="vCard number"
								readonly
							/>
						</div>
					</div>
				</div>

				<div class="row">
					<!--Payment type-->
					<div class="col">
						<h6>
							<label for="inputyPaymentType"><h6>Payment type</h6></label>
						</h6>
						<input
							v-if="operationType != 'insert'"
							id="inputyPaymentType"
							class="form-control"
							type="text"
							v-model="editingTransaction.payment_type"
							readonly
						/>
						<select
							v-else
							class="form-select"
							id="inputyPaymentType"
							v-model="editingTransaction.payment_type"
						>
							<option value="">-- Select payment type --</option>
							<option>IBAN</option>
							<option>MASTERCARD</option>
							<option>MB</option>
							<option>MBWAY</option>
							<option>PAYPAL</option>
							<option>VCARD</option>
							<option>VISA</option>
						</select>
					</div>

					<!--Category-->
					<div class="col">
						<label for="inputCategory" class="form-label"><h6>Categories</h6> </label>
						<select class="form-select" id="inputCategory" v-model="editingTransaction.category_id">
							<option :value="null">-- Without category --</option>
							<option v-for="cat in categories" :key="cat.id" :value="cat.id">
								{{ cat.name }}
							</option>
						</select>
					</div>
				</div>
				<div class="mb-3">
					<label for="inputDescription"><h6>Description</h6></label>
					<textarea
						class="form-control"
						id="inputDescription"
						rows="4"
						v-model="editingTransaction.description"
					></textarea>
				</div>

				<div class="mb-3 row">
					<div class="col">
						<h6>
							<label for="inputConfirmationCode" class="form-label">Pin code</label>
						</h6>
						<input
							type="text"
							class="form-control"
							id="inputConfirmationCode"
							v-model="this.vcard.currentPassword"
							required
						/>
					</div>
				</div>

				<div class="mb-3 d-flex justify-content-end">
					<ul class="list-inline">
						<li class="list-inline-item">
							<button type="button" class="btn btn-primary px-5" @click="save">Save</button>
						</li>
						<li class="list-inline-item">
							<button type="button" class="btn btn-secondary px-5" @click="cancel">Cancel</button>
						</li>
					</ul>
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
				currentBalance: 0.0,
			}
		},

		watch: {
			transaction(newTransaction) {
				this.editingTransaction = newTransaction
			},
		},

		computed: {
			transactionTitle() {
				if (!this.editingTransaction) {
					return ""
				}
				return this.operationType == "insert"
					? "New transaction of vCard " + this.transaction.vcard
					: "Transaction " + this.transaction.id + " of vCard " + this.idVcard
			},

			newBalance() {
				var newValue = 0
				if (this.editingTransaction.value != null && this.editingTransaction.value != "") {
					newValue =
						parseFloat(this.editingTransaction.old_balance) -
						parseFloat(this.editingTransaction.value)

					return newValue
				} else {
					return 0
				}
			},
		},

		methods: {
			transactionType() {
				if (this.operationType == "insert") this.editingTransaction.type = "D"
			},

			currentDate() {
				const today = new Date()

				var month = today.getMonth() + 1
				if (month < 10) month = "0" + today.getMonth()

				var day = today.getDate()
				if (day < 10) day = "0" + today.getDate()

				var hour = today.getHours()
				if (hour < 10) hour = "0" + today.getHours()

				var minutes = today.getMinutes()
				if (minutes < 10) minutes = "0" + today.getMinutes()

				var seconds = today.getSeconds()
				if (seconds < 10) seconds = "0" + today.getSeconds()

				this.editingTransaction.date = today.getFullYear() + "-" + month + "-" + day
				this.editingTransaction.datetime =
					today.getFullYear() + "-" + month + "-" + day + " " + hour + ":" + minutes + ":" + seconds
			},

			balance() {
				if (this.operationType == "insert") {
					this.$axios
						.get("vcards/" + this.idVcard)
						.then(response => {
							this.editingTransaction.old_balance = response.data.data.balance
						})
						.catch(error => {
							console.log(error)
						})
				}
			},

			checkForm() {
				var error = false
				if (this.editingTransaction.payment_reference == "") {
					this.$toast.error("Payment reference is required")
					error = true
				}
				if (this.editingTransaction.value == null) {
					this.$toast.error("Amount is required")
					error = true
				}
				if (this.editingTransaction.new_balance < 0) {
					this.$toast.error(`New balance can't be a negative number.`)
					error = true
				}
				if (this.editingTransaction.payment_type == "") {
					this.$toast.error("Payment type is required")
					error = true
				}
				if (
					(this.editingTransaction.description.length < 3 &&
						this.editingTransaction.description.length > 0) ||
					this.editingTransaction.description.length > 50
				) {
					this.$toast.error(
						"The description must be at least 3 characters and not be greater than 50 characters."
					)
					error = true
				}

				return error
			},

			save() {
				//Insert de vcard of transaction
				this.editingTransaction.vcard = this.idVcard

				//If is a new transaction insert the new balance
				if (this.operationType == "insert")
					this.editingTransaction.new_balance = String(this.newBalance)

				//Serch and insert the category name
				for (let i = 0; i < this.categories.length; i++) {
					if (this.categories[i].id == this.editingTransaction.category_id) {
						this.editingTransaction.category_name = this.categories[i].name
						break
					}
				}

				//Check the format of the form
				if (this.checkForm()) return

				this.$emit("save", this.editingTransaction)
			},
			cancel() {
				this.$emit("cancel", this.editingTransaction)
			},
		},

		mounted() {
			this.transactionType()
			this.currentDate()
			this.balance()
		},
	}
</script>

<style scoped lang="css"></style>
