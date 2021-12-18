<template>
  <h2 style="margin-top: 30px">Register</h2>
  <div class="content">
    <form
      class="row g-3 needs-validation"
      novalidate
      @submit.prevent="checkForm"
    >
      <div class="mb-3">
        <!--NAME-->
        <div class="mb-3">
          <h6>
            <label for="inputName" class="form-label">Name</label>
          </h6>
          <input
            type="text"
            class="form-control"
            id="inputName"
            v-model="vcard.name"
            required
          />
        </div>

        <!--USERNAME-->
        <div class="mb-3">
          <h6>
            <label for="inputUsername" class="form-label">Username</label>
          </h6>
          <input
            type="text"
            class="form-control"
            id="inputUsername"
            required
            v-model="vcard.phone_number"
          />
        </div>

        <!--EMAIL-->
        <div class="mb-3">
          <h6>
            <label for="inputEmail" class="form-label">Email</label>
          </h6>
          <input
            type="text"
            class="form-control"
            id="inputEmail"
            v-model="vcard.email"
            required
          />
        </div>

        <!--CONFIRMATION CODE-->
        <div class="mb-3 row">
          <div class="col-sm">
            <h6>
              <label for="inputConfirmationCode" class="form-label"
                >New Confirmation Code</label
              >
            </h6>
            <input
              type="text"
              class="form-control"
              id="inputConfirmationCode"
              v-model="vcard.confirmation_code"
              required
            />
          </div>
        </div>

        <!--PASSWORD-->
        <div class="mb-3">
          <div class="mb-3">
            <h6>
              <label for="inputPassword" class="form-label">Password</label>
            </h6>

            <input
              type="password"
              class="form-control"
              id="inputPassword"
              required
              v-model="vcard.password"
            />
          </div>
        </div>
      </div>
      <div class="mb-3 d-flex justify-content-center">
        <button type="button" class="btn btn-primary px-5" @click="checkForm">
          register
        </button>
      </div>
    </form>
  </div>
</template>

<script>
export default {
  name: "Register",
  data() {
    return {
      vcard: {
        phone_number: null,
        name: "",
        email: "",
        photo_url: "",
        password: "",
        confirmation_code: "",
        blocked: false,
        balance: 0,
        max_debit: 5000,
      },
      errors: null,
    };
  },
  methods: {
    checkForm() {
      if (this.vcard.phone_number == "")
        this.$toast.error("Username is required!");

      if (this.vcard.password == "") this.$toast.error("Password is required!");

      if (this.vcard.password != "" && this.vcard.phone_number != "")
        this.register();
    },

    register() {
      this.$axios
        .post("register", this.vcard)
        .then(() => {
          this.$toast.success(
            "User " + this.$vcard.phone_number + " created and ready to login."
          );
        })
        .catch(() => {
          this.vcard.password = "";
          this.$toast.error("Invalid vcard!");
        });
    },
  },
};
</script>

<style scoped></style>
