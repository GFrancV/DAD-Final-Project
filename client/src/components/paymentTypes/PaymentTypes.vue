<template>
  <div>
    <h2 style="margin-top: 30px">Payment Types</h2>
  </div>

  <div class="content">
    <div class="row">
      <div class="col-sm-8"></div>
    </div>

    <div class="table-responsive">
      <table class="table table-hover">
        <thead>
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Description</th>
          </tr>
        </thead>
        <tbody>
          <tr v-for="paymentType in paymentTypes" :key="paymentType.code">
            <th scope="row">{{ paymentType.name }}</th>
            <td>
              {{ paymentType.description }}
            </td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
export default {
  name: "PaymentTypes",
  props: {
    vcardId: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      paymentTypes: [],
    };
  },
  methods: {
    getPaymentTypes() {
      this.$axios
        .get("/paymentTypes")
        .then((response) => {
          this.paymentTypes = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
    
  },
  mounted() {
    this.getPaymentTypes();
  },
};
</script>

<style scoped lang="scss"></style>
