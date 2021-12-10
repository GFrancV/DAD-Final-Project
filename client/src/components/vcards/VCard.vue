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

      <!--CONFIRMATION CODE-->
      <div class="mb-3 row">
        <div class="col">
          <label for="inputConfirmationCode" class="form-label"
            >Current Confirmation Code</label
          >
          <input
            type="text"
            class="form-control"
            id="inputConfirmationCode"
            v-model="currentCredentials.currentCode"
            required
          />
        </div>

        <div class="col-sm">
          <label for="inputConfirmationCode" class="form-label"
            >New Confirmation Code</label
          >
          <input
            type="text"
            class="form-control"
            id="inputConfirmationCode"
            v-model="this.vcard.confirmation_code"
            required
          />
        </div>
      </div>

      <!--PASSWORD-->
      <div class="mb-3 row">
        <div class="col">
          <label for="inputConfirmationCode" class="form-label"
            >Current Password</label
          >
          <input
            type="text"
            class="form-control"
            id="inputConfirmationCode"
            v-model="currentCredentials.currentPassword"
            required
          />
        </div>

        <div class="col-sm">
          <label for="inputConfirmationCode" class="form-label"
            >New Password</label
          >
          <input
            type="text"
            class="form-control"
            id="inputConfirmationCode"
            v-model="this.vcard.password"
            required
          />
        </div>
      </div>

      <!--PROFILE PHOTO-->
      <div class="mb-3">
        <label for="formFile" class="form-label">Profile Photo:</label>

        <div class="mb-3">
          <img
            :src="profilePhoto"
            alt=""
            height="150"
            class="d-inline-block align-text-top"
            style="float: left; margin-bottom: 10px"
          />
        </div>
      </div>

      <div>
        <input
          class="form-control"
          ref="fileInput"
          type="file"
          @input="pickFile"
        />
      </div>

      <div v-if="this.previewImage" class="mb-10" style="margin-top: 5px">
        <div>
          {{ newImage }}
        </div>
        <div
          class="imagePreviewWrapper"
          :style="{ 'background-image': `url(${previewImage})` }"
          @click="selectImage"
        ></div>
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
      vcard: {},
      errors: null, //Variável para debug
      previewImage: null,
      currentCredentials: {
        currentPassword: "",
        currentCode: "",
      },
    };
  },
  computed: {
    newImage() {
      if (this.previewImage) {
        return "New Image:";
      }
      return "";
    },
    profilePhoto() {
      if (this.vcard.photo_url) {
        return this.$serverUrl + "/storage/fotos/" + this.vcard.photo_url;
      }
      return "./assets/img/avatar-exemplo-1.jpg";
    },
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
          //this.vcard.password = ""
          //this.vcard.confirmation_code = ""
        })
        .catch((error) => {
          console.log(error);
        });
    },
    save() {
      this.$axios
        .put("vcards/" + this.id, this.vcard, { newPassword: "1234" })
        .then((response) => {
          this.$toast.success(
            'User "' + response.data.data.name + '" was updated successfully.'
          );
          this.vcard = response.data.data;
          this.originalValueStr = this.dataAsString();
          this.$router.back();
        })
        .catch((error) => {
          if (error.response.status == 422) {
            this.$toast.error(
              'User "' +
                this.vcard.name +
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
    },
    cancel() {
      this.loadVcard();
      this.previewImage = null;
    },
    selectImage() {
      this.$refs.fileInput.click();
    },
    pickFile() {
      let input = this.$refs.fileInput;
      let file = input.files;
      if (file && file[0]) {
        let reader = new FileReader();
        reader.onload = (e) => {
          this.previewImage = e.target.result;
        };
        reader.readAsDataURL(file[0]);
        this.$emit("input", file[0]);
      }
    },
  },
  mounted() {
    this.loadVcard();
  },
};
</script>

<style>
</style>