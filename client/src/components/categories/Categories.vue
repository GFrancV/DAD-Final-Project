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
      <button type="button" class="btn btn-primary px-3">
        Add New Category
      </button>
    </router-link>
  </div>

  <div class="table-responsive">
    <table class="table">
      <thead>
        <tr>
          <th scope="col">Name</th>
          <th scope="col">Actions</th>
        </tr>
      </thead>
      <tbody>
        <tr v-for="category in categories" :key="category.id">
          <th scope="row">{{ category.name }}</th>
          <td>
            <ul class="list-inline m-0">
              <li class="list-inline-item">
                <button type="button" class="btn btn-primary btn-sm">
                  <router-link
                    aria-label="Add category"
                    :to="{
                      name: 'CategoryUpdate',
                      params: {
                        vcardId: '900000001',
                        id: category.id,
                      },
                    }"
                  >
                    <i class="bi-pencil-square" style="color: white"></i>
                  </router-link>
                </button>
              </li>
              <li class="list-inline-item">
                <button
                  type="button"
                  class="btn btn-danger btn-sm"
                  @click="deleteCategory(category.id)"
                >
                  <i class="bi-trash-fill red" style="color: white"></i>
                </button>
              </li>
            </ul>
          </td>
        </tr>
      </tbody>
    </table>
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
    deleteCategory(id) {
      this.$axios
        .delete("vcards/" + this.vcardId + "/categories/" + id)
        .then((response) => {
          this.$toast.success(
            'Category "' +
              response.data.data.name +
              '" was deleted successfully.'
          );
          console.log(response.data.data);
        })
        .catch((error) => {
          this.$toast.error(
            "Category was not deleted due to validation errors!"
          );
          console.log(error);
        });
      this.getCategories();
    },
  },
  mounted() {
    this.getCategories();
  },
};
</script>

<style scoped lang="scss">
</style>
