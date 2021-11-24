<template>
  <div
    class="
      d-flex
      justify-content-between
      flex-wrap flex-md-nowrap
      align-items-center
      pt-3
      pb-2
      mb-3
      border-bottom
    "
  >
    <h1 class="h2">VCard {{ id }}</h1>
  </div>
  <div>
    <h4>OWNER</h4>
    <ul>
      <li>*Username*</li>
      <li>*PhoneNumber*</li>
      <li>TALVEZ *UserType* (Admin/Cliente)</li>
    </ul>
  </div>

  <div>
    <h4>Categories</h4>
    <ul>
      <li v-for="category in categories" :key="category.id">
        {{ category.name }}
      </li>
    </ul>
  </div>

  <div>
    <h4>Transactions</h4>
    <table class="table table-striped table-sm">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">date</th>
          <th scope="col">type</th>
          <th scope="col">old_balance</th>
          <th scope="col">new_balance</th>
          <th scope="col">payment_type</th>
          <th scope="col">payment_reference</th>
          <th scope="col">pair_transaction</th>
          <th scope="col">pair_vcard</th>
          <th scope="col">category</th>
          <th scope="col">description</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="transaction in transactions" :key="transaction.id">
          <th scope="row">{{ transaction.id }}</th>
          <td>{{ transaction.datetime }}</td>
          <td>{{ transaction.type }}</td>
          <td>{{ transaction.old_balance }}</td>
          <td>{{ transaction.new_balance }}</td>
          <td>{{ transaction.payment_type }}</td>
          <td>{{ transaction.payment_reference }}</td>
          <td>{{ transaction.pair_transaction || "N/A" }}</td>
          <td>{{ transaction.pair_vcard || "N/A" }}</td>
          <td>
            {{ transaction.category_name || 'N/A' /* TODO - Mudar para nome de categoria */ }}
          </td>
          <td>{{ transaction.description || "N/A" }}</td>
        </tr>
      </tbody>
    </table>
  </div>
</template>

<script>
export default {
  name: "VCard",
  props: {
    id: {
      type: Number,
      default: null,
    },
  },
  computed: {

  },
  data() {
    return {
      categories: [],
      transactions: [],
    };
  },
  methods: {
    getCategories() {
      this.$axios
        .get("vcards/" + this.id + "/categories")
        .then((response) => {
          this.categories = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    getTransactions() {
      this.$axios
        .get("vcards/" + this.id + "/transactions")
        .then((response) => {
          this.transactions = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getCategories();
    this.getTransactions();
  },
};
</script>

<style scoped lang="scss">
</style>
