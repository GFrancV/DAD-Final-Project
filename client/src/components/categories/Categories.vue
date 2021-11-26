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
    <h1 class="h2">Categories</h1>
  </div>

  <div class="mb-3 d-flex justify-content-left">
    <router-link
      class="link-secondary"
      aria-label="Add category"
      :to="{
        name: 'CategoryCreate',
        params: {
          vcardId: '900000001',
        },
      }"
    >
      <button
        type="button"
        class="btn btn-primary px-3"
      >
      Add New Category
      </button>
    </router-link>
  </div>

  <div>
    <li v-for="category in categories" :key="category.id">
      {{ category.name }}
    </li>
  </div>
</template>

<script>
export default {
  name: "Categories",
  props: {
    vcardId: {
      type: String,
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
        .get("vcards/" + this.vcardId + "/categories")
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
