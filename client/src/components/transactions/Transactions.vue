<template>
  <div>
    <div class="row">
      <!-- Main container -->
      <div class="col-sm-5 col-md-8 content-primary">
        <h5 style="margin-top: 30px;">Transactions: vCard {{ id }}</h5>
        <div class="content">
          <button 
            type="button" 
            class="btn btn-primary"
            @click="addTask"
          >
            <i class="bi bi-plus" style="color: white;"></i>
            New Transaction
          </button>
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
                <!--
                <th scope="col">pair_transaction</th> 
                <th scope="col">pair_vcard</th>
                <th scope="col">category</th>
                <th scope="col">description</th>
                -->
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
                <!--
                <td>{{ transaction.pair_transaction || "N/A" }}</td>
                <td>{{ transaction.pair_vcard || "N/A" }}</td>
                <td>
                  {{ transaction.category_name || 'N/A' /* TODO - Mudar para nome de categoria */ }}
                </td>
                <td>{{ transaction.description || "N/A" }}</td>
                -->
              </tr>
            </tbody>
          </table>
        </div>
      </div>

      <!-- Secondary container -->
      <div class="col-sm-5 offset-sm-2 col-md-4 offset-md-0 content-secondary">
        <div class="secondary-info">
          <h5 style="margin-top: 30px;">Categories</h5>
          <div class="content">
            <ul>
              <li v-for="category in categories" :key="category.id">
                {{ category.name }}
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'Transactions',
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

    addTask () {
      this.$router.push({ name: 'NewTransaction', params: { id: null } })
    }
  },

  mounted() {
    this.getCategories();
    this.getTransactions();
  },
}
</script>

<style scoped lang="scss">
</style>
