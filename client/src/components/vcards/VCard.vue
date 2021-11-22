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
    <p>TABELA</p>
  </div>

  <div>
    <h4>Icons</h4>
    <p>
      Icons used for this template:
      <a href="https://icons.getbootstrap.com/"
        ><strong>Bootstrap Icons</strong></a
      >
    </p>
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
  data() {
    return {
      categories: [],
    };
  },
  methods: {
    getCategories() {
      this.$axios
        .get("vcards/" + this.id + "/categories")
        .then((response) => {
          this.categories = response.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getCategories();
  },
};
</script>

<style scoped lang="scss">
</style>
