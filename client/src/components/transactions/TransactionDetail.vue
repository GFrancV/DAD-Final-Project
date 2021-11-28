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
        <!--Date-->
				<div class="row" style="margin-top: 20px">
					<div class="col-auto">
						<h6><label class="sr-only" for="inputDate">Date of transaction</label></h6>
						<div v-if="operationType != 'insert'" class="input-group mb-2">
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

						<div v-else class="input-group mb-2">
							<input id="inputDate" class="form-control" type="text" :value="currentDate" readonly />
							<div class="input-group-prepend">
								<div class="input-group-text"><i class="bi bi-calendar3"></i></div>
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
							:value="editingTransaction.payment_reference"
							readonly
						/>
						<input
							v-else
							id="inputReference"
							class="form-control"
							type="text"
							:value="editingTransaction.payment_reference"
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

					<!--Mount-->
					<div class="col-sm-4">
						<label for="inputVCard"><h6>Mount</h6></label>
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
								type="text"
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
							:value="editingTransaction.payment_type"
							readonly
						/>
						<input
							v-else
							id="inputyPaymentType"
							class="form-control"
							type="text"
							:value="editingTransaction.payment_type"
						/>
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
      currentBalance: 0.00
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

    currentDate() {
      const today = new Date()
      const month = today.getMonth() + 1
      return today.getDate() + '-' + month + '-' + today.getFullYear()
      + ' ' + today.getHours() + ':' + today.getMinutes() + ':' + today.getSeconds()
    },

    newBalance() {
      var newValue = 0
      if (this.editingTransaction.value != null){
        newValue = parseFloat(this.editingTransaction.old_balance) - parseFloat(this.editingTransaction.value)
        
        return newValue
      }
      else{
        
        return newValue
      }
    }
	},

	methods: {
		save() {
			this.$emit("save", this.editingTransaction);
		},
		cancel() {
			this.$emit("cancel", this.editingTransaction);
		},

    transactionType() {
      if (this.operationType == "insert") 
        this.editingTransaction.type = 'D'
    },

    balance() {
      if (this.operationType == "insert") {
        this.$axios
        .get("vcards/" + this.idVcard)
        .then((response) => {
          this.editingTransaction.old_balance = response.data.data.balance;
        })
        .catch((error) => {
          console.log(error);
        });
      }
    },

    calculateNewValue () {

    }
	},

  mounted() {
    this.balance()
    this.transactionType()
  },
};
</script>

<style scoped lang="css"></style>
