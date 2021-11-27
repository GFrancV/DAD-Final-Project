<template>
  <category-detail
    :operationType="operation"
    :vcardId="vcardId"
    :category="category"
    :errors="errors"
    @save="save"
    @cancel="cancel"
  >
  </category-detail>
</template>

<script>
import CategoryDetail from "./CategoryDetail.vue";

export default {
  name: "Category",
  components: {
    CategoryDetail,
  },
  props: {
    vcardId: {
      type: String,
      default: "",
    },
    id: {
      type: Number,
      default: null,
    },
  },
  data() {
    return {
      category: this.newCategory(),
      errors: null, //Variável para debug
    };
  },
  computed: {
    operation() {
      //Se id for null estamos a criar uma categoria, caso contrário, estamos a atualizar uma categoria
      return !this.id || this.id < 0 ? "Create" : "Update";
    },
  },
  watch: {
    id: {
      immediate: true,
      handler(newValue) {
        this.loadCategory(newValue);
      },
    },
  },
  methods: {
    dataAsString() {
      return JSON.stringify(this.category);
    },
    newCategory() {
      return {
        vcard: null,
        type: "",
        name: "",
      };
    },
    loadCategory(id) {
      this.errors = null;
      if (!id || id < 0) {
        this.category = this.newCategory();
        this.originalValueStr = this.dataAsString();
      } else {
        this.$axios
          .get("vcards/" + this.vcardId + "/categories/" + id)
          .then((response) => {
            this.category = response.data.data;
            this.originalValueStr = this.dataAsString();
          })
          .catch((error) => {
            console.log(error);
          });
      }
    },
    save(category) {
      this.errors = null;
      if (this.operation == "Create") {
        this.$axios
          .post("vcards/" + this.vcardId + "/categories", category)
          .then((response) => {
            this.$toast.success(
              'Category "' + response.data.data.name + '" was created successfully.'
            );
            this.category = response.data;
            this.originalValueStr = this.dataAsString();
            this.$router.back();
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.$toast.error(
                "Category was not created due to validation errors!"
              );
              this.errors = error.response.data.errors;
            } else {
              this.$toast.error(
                "Category was not created due to unknown server error!"
              );
            }
          });
      } else {
        this.$axios
          .put("vcards/" + this.vcardId + "/categories/" + this.id, category)
          .then((response) => {
            this.$toast.success(
              'Category "' + response.data.data.name + '" was updated successfully.'
            );
            this.category = response.data;
            this.originalValueStr = this.dataAsString();
            this.$router.back();
          })
          .catch((error) => {
            if (error.response.status == 422) {
              this.$toast.error(
                'Category "' +
                  this.category.nam +
                  '" was not updated due to validation errors!'
              );
              this.errors = error.response.data.errors;
            } else {
              this.$toast.error(
                'Category "' +
                  this.category.name +
                  '" was not updated due to unknown server error!'
              );
            }
          });
      }
    },
    cancel() {
      this.$router.back();
    },
  },
};
</script>

<style>
</style>