<template>
  <form class="row g-3 needs-validation" novalidate>
    <h2 class="mt-5 mb-3">VCard {{ id }}</h2>
    <hr />

    <div class="mb-3">
      <div class="mb-3">
        <label for="inputVCard" class="form-label">Phone Number</label>
        <input
          id="inputVCard"
          class="form-control"
          type="text"
          aria-label="vCard number"
          :value="id"
          readonly
        />
      </div>

      <!--NAME-->
      <div class="mb-3">
        <label for="inputName" class="form-label">Name</label>
        <input
          type="text"
          class="form-control"
          id="inputName"
          v-model="vcard.name"
          required
        />
      </div>

      <!--EMAIL-->
      <div class="mb-3">
        <label for="inputEmail" class="form-label">Email</label>
        <input
          type="text"
          class="form-control"
          id="inputEmail"
          v-model="vcard.email"
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
        />
        <label class="form-check-label" for="flexRadioDefault2">Debit</label>
      </div>
    </div>

    <div class="mb-3 d-flex justify-content-left">
      <ul class="list-inline">
        <li class="list-inline-item">
          <button type="button" class="btn btn-primary px-3" @click="save">
            Save
          </button>
        </li>
        <li class="list-inline-item">
          <button type="button" class="btn btn-secondary px-3" @click="cancel">
            Cancel
          </button>
        </li>
      </ul>
    </div>
  </form>
</template>

<script>
export default {
  name: "VCard",
  props: {
    id: {
      type: String,
      required: true,
    },
  },
  data() {
    return {
      vcard: this.loadVcard(),
      errors: null, //Variável para debug
    };
  },
  methods: {
    dataAsString() {
      return JSON.stringify(this.vcard);
    },
    newVcard() {
      return {
        phone_number: null,
        name: "",
        email: "",
        photo_url: "",
        password: "",
        confirmation_code: "",
        blocked: null,
        balance: null,
        max_debit: null,
      };
    },
    loadVcard() {
      this.errors = null;
      this.$axios
        .get("vcards/" + this.id)
        .then((response) => {
          this.vcard = response.data.data;
          this.originalValueStr = this.dataAsString();
        })
        .catch((error) => {
          console.log(error);
        });
    },
    save() {},
    cancel() {},
    getVcard() {},
  },
  mounted() {
    this.getVcard();
  },
};
</script>

<style>
</style>