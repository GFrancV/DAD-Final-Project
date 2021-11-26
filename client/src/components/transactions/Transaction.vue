<template>
  <transaction-detail
    :operationType="operation"
    :vcard="vcard"
    :transaction="transaction"
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
    vcard: {
      type: String,
      default: null,
    },
    idTransaction: {
      type: Number,
      default: null,
    },
  },

  data() {
    return {
      transaction: this.newTransaction(),
      errors: null,
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
    // beforeRouteUpdate was not fired correctly
    // Used this watcher instead to update the ID
    idTransaction: {
      immediate: true,
      handler(newValue) {
        this.loadTask(newValue);
      },
    },
  },

  methods: {
    newTransaction() {
      return {
        idTransaction: null,
        owner_id: this.vcard,
        description: "",
        notes: "",
      };
    },

    loadTask(idTransaction) {
      this.errors = null;
      if (!idTransaction || idTransaction < 0) {
        this.transaction = this.newTransaction();
        //this.originalValueStr = this.dataAsString()
      } else {
        this.$axios
          .get("vcard/" + this.vcard + "/transactions/" + this.idTransaction)
          .then((response) => {
            this.task = response.data.data;
            this.originalValueStr = this.dataAsString();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
  },
};
</script>

<style scoped lang="scss">
</style>
