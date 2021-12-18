<template>
  <div>
    <h2 style="margin-top: 30px">{{ transactionTitle }}</h2>
    <div class="content">
      <form class="row g-3 needs-validation" novalidate>
        <div class="mb-3">
          <h6>
            <label for="inputVCard" class="form-label">vCard</label>
          </h6>
          <input
            id="inputVCard"
            class="form-control"
            type="text"
            :value="vcardId"
            aria-label="vCard number"
            readonly
          />
        </div>

        <div class="mb-3">
          <h6>
            <label for="inputName" class="form-label">Name</label>
          </h6>
          <input
            type="text"
            class="form-control"
            id="inputName"
            v-model="editingCategory.name"
            required
          />
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
            <label class="form-check-label" for="flexRadioDefault1"
              >Credit</label
            >
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
            <label class="form-check-label" for="flexRadioDefault2"
              >Debit</label
            >
          </div>
        </div>

        <div class="mb-3 d-flex justify-content-end">
          <ul class="list-inline">
            <li class="list-inline-item">
              <button type="button" class="btn btn-primary px-3" @click="save">
                {{ operationType }}
              </button>
            </li>
            <li class="list-inline-item">
              <button
                type="button"
                class="btn btn-secondary px-3"
                @click="cancel"
              >
                Cancel
              </button>
            </li>
          </ul>
        </div>
      </form>
    </div>
  </div>
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
      default: "Create",
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
      categoryTitle: "",
    };
  },
  computed: {
    transactionTitle() {
      if (!this.editingCategory) {
        return "";
      }
      return this.operationType == "Create"
        ? "New category"
        : this.categoryTitle;
    },
  },

  watch: {
    category(newCategory) {
      this.editingCategory = newCategory;
      if (!this.categoryTitle) {
        if (this.operationType == "Create") {
          this.categoryTitle = "Create Category";
          this.editingCategory.type = "C";
        } else {
          this.categoryTitle = "Category " + this.editingCategory.name;
        }
      }
    },
  },
  methods: {
    save() {
      this.editingCategory.vcard = this.vcardId;
      if (this.editingCategory.type == "") {
        this.editingCategory.type = "C";
      }
      this.$emit("save", this.editingCategory);
    },
    cancel() {
      this.$emit("cancel", this.editingCategory);
    },
  },
  mounted() {},
};
</script>

<style></style>
