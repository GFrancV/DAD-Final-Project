<template>
  <form class="row g-3 needs-validation" novalidate>
    <h3 class="mt-5 mb-3">{{ categoryTitle }}</h3>
    <hr />

    <div class="mb-3">
      <div class="mb-3">
        <label for="inputVCard" class="form-label">vCard</label>
        <input
          id="inputVCard"
          class="form-control"
          type="text"
          :value="vcardId"
          aria-label="vCard number"
          readonly
        />
      </div>
    </div>

    <div class="mb-3">
      <div class="mb-3">
        <label for="inputName" class="form-label">Name</label>
        <input
          type="text"
          class="form-control"
          id="inputName"
          v-model="editingCategory.name"
          required
        />
      </div>
    </div>

    <!--TIPO CATEGORIA-->
    <div class="d-flex">
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="creditRadio"
          value="C"
          v-model="editingCategory.type"
          checked
        />
        <label class="form-check-label" for="flexRadioDefault1">Credit</label>
      </div>
      <div class="form-check form-check-inline">
        <input
          class="form-check-input"
          type="radio"
          name="flexRadioDefault"
          id="debitRadio"
          value="D"
          v-model="editingCategory.type"
        />
        <label class="form-check-label" for="flexRadioDefault2">Debit</label>
      </div>
    </div>

    <div class="mb-3 d-flex justify-content-left">
      <button type="button" class="btn btn-primary px-3" @click="save">
        {{ operationType }}
      </button>
    </div>
  </form>
</template>

<script>
export default {
  name: "CategoryDetail",
  props: {
    category: {
      type: Object,
      required: true,
    },
    vcardId: {
      type: String,
      required: true,
    },
    operationType: {
      type: String,
      default: "Create", // create / update
    },
    errors: {
      type: Object,
      default: null,
    },
  },
  emits: ["save", "cancel"],
  data() {
    return {
      editingCategory: this.category,
    };
  },
  watch: {
    category(newCategory) {
      this.editingCategory = newCategory;
    },
  },
  computed: {
    categoryTitle() {
      if (!this.editingCategory) {
        return "";
      }
      return this.operationType == "Create"
        ? "Create Category"
        : "Category " + this.editingCategory.id;
    },
  },
  methods: {
    save() {
      this.editingCategory.vcard = this.vcardId;
      console.log(this.editingCategory);
      this.$emit("save", this.editingCategory);
    },
    cancel() {
      this.$emit("cancel", this.editingCategory);
    },
  },
};
</script>

<style>
</style>