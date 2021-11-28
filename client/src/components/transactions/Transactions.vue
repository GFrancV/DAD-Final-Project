<template>
	<div>
		<h5 style="margin-top: 30px">Transactions: vCard {{ idVcard }}</h5>
		<div class="content">
			<div class="row">
				<div class="col-sm-8">
					<div class="input-group rounded">
						<input
							type="search"
							class="form-control rounded"
							placeholder="Search"
							aria-label="Search"
							aria-describedby="search-addon"
						/>
						<span class="input-group-text border-0" id="search-addon">
							<i class="bi bi-search"></i>
						</span>
					</div>
				</div>
				<div class="col-sm-4" style="text-align: right">
					<router-link
						type="button"
						class="btn btn-primary"
						:to="{ name: 'NewTransaction', params: { vcard: '900000001' } }"
					>
						<i class="bi bi-plus" style="color: white"></i>
						New Transaction
					</router-link>
				</div>
			</div>
			<br />
			<div class="table-responsive">
				<table class="table table-hover" style="width: 100%">
					<thead>
						<tr>
							<th scope="col">ID</th>
							<th scope="col">Info</th>
							<th scope="col"></th>
							<th scope="col">Old balance</th>
							<th scope="col">Mount</th>
							<th scope="col">Payment type</th>
							<th scope="col">New balance</th>
							<!-- 
							<th scope="col">pair_transaction</th>
							<th scope="col">pair_vcard</th>
							-->
							<th scope="col">Category</th>
							<th scope="col">Description</th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="transaction in transactions" :key="transaction.id">
							<th scope="row">{{ transaction.id }}</th>
							<td>
								<p style="font-size: 18px; display: inline">
									{{ transaction.payment_reference }}
								</p>
								<p class="text-secondary" style="font-size: 12px">
									{{ transaction.datetime }}
								</p>
							</td>
							<td v-if="transaction.type == 'C'">
								<i class="bi bi-arrow-bar-down label-success"></i>
							</td>
							<td v-else><i class="bi bi-arrow-bar-up label-danger"></i></td>
							<td>${{ transaction.old_balance }}</td>
							<td v-if="transaction.type == 'C'">
								<p style="display: inline; font-weight: 700; color: green">
									+ ${{ Math.round((transaction.new_balance - transaction.old_balance) * 100) / 100 }}
								</p>
							</td>
							<td v-else>
								<p style="display: inline; font-weight: 700; color: rgb(253, 53, 53)">
									- ${{ Math.round((transaction.new_balance - transaction.old_balance) * 100) / 100 }}
								</p>
							</td>
							<td>${{ transaction.new_balance }}</td>
							<td>{{ transaction.payment_type }}</td>
							<!--
							<td>{{ transaction.pair_transaction || "N/A" }}</td>
							<td>{{ transaction.pair_vcard || "N/A" }}</td>
							-->
							<td>
								<div class="label-primary">
									{{ transaction.category_name || "uncategorized" }}
								</div>
								<!--/* TODO - Mudar para nome de categoria */-->
							</td>
							<td v-if="transaction.description == null">
								<p class="text-secondary" style="font-size: 12px">Without description</p>
							</td>
							<td v-else>{{ transaction.description }}</td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
		<br />
	</div>
</template>

<script>
export default {
	name: "Transactions",
	props: {
		idVcard: {
			type: String,
			default: '',
		},
	},

	computed: {},

	data() {
		return {
			categories: [],
			transactions: [],
		};
	},

	methods: {
		getTransactions() {
			this.$axios
				.get("vcards/" + this.idVcard + "/transactions")
				.then((response) => {
					this.transactions = response.data.data;
				})
				.catch((error) => {
					console.log(error);
				});
		},

		addTask() {
			this.$router.push({ name: "NewTransaction", params: { id: this.idVcard } });
		},
	},

	mounted() {
		this.getTransactions();
	},
};
</script>

<style scoped lang="css">
.btn-primary {
	background-color: var(--primary);
}

.btn-primary:hover {
	background-color: #3e61b3;
}

.label-success {
	text-align: center;
	padding: 2px;
	padding-left: 4px;
	padding-right: 4px;
	background-color: #77dd77;
	color: green;
	border: 10px 10px 10px 10px;
	border-radius: 8px;
}

.label-danger {
	text-align: center;
	padding: 2px;
	padding-left: 4px;
	padding-right: 4px;
	background-color: #f89c99;
	color: rgb(255, 0, 0);
	border: 10px 10px 10px 10px;
	border-radius: 8px;
}

.label-primary {
	font-weight: 600;
	text-align: center;
	padding: 2px;
	padding-left: 4px;
	padding-right: 4px;
	background-color: #abc4fd;
	color: var(--primary);
	border: 10px 10px 10px 10px;
	border-radius: 8px;
}
</style>
