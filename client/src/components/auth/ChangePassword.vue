<template>
  <form
    class="row g-3 needs-validation"
    novalidate
  >
    <h3 class="mt-5 mb-3">Change Password - TODO - COPIADO DA FICHA 7</h3>
    <hr>
    <div class="mb-3">
      <div class="mb-3">
        <label
          for="inputCurrentPassword"
          class="form-label"
        >Current Password</label>
        <input
          type="password"
          class="form-control"
          id="inputCurrentPassword"
          required
          v-model="passwords.current_password"
        >
        <field-error-message
          :errors="errors"
          fieldName="current_password"
        ></field-error-message>
      </div>
    </div>
    <div class="mb-3">
      <div class="mb-3">
        <label
          for="inputPassword"
          class="form-label"
        >New Password</label>
        <input
          type="password"
          class="form-control"
          id="inputPassword"
          required
          v-model="passwords.password"
        >
        <field-error-message
          :errors="errors"
          fieldName="password"
        ></field-error-message>
      </div>
    </div>
    <div class="mb-3">
      <div class="mb-3">
        <label
          for="inputPasswordConfirm"
          class="form-label"
        >Password Confirmation</label>
        <input
          type="password"
          class="form-control"
          id="inputPasswordConfirm"
          required
          v-model="passwords.password_confirm"
        >
        <field-error-message
          :errors="errors"
          fieldName="password_confirm"
        ></field-error-message>
      </div>
    </div>
    <div class="mb-3 d-flex justify-content-center">
      <button
        type="button"
        class="btn btn-primary px-5"
        @click.prevent="changePassword"
      >Change Password</button>
    </div>
  </form>
</template>

<script>
export default {
  name: 'ChangePassword',
  data () {
    return {
      passwords: {
        current_password: '',
        password: '',
        password_confirm: ''
      },
      errors: null,
    }
  },
  emits: [
    'changedPassword',
  ],
  methods: {
    changePassword () {
      // FALTA FAZER O LOGIN
      this.$emit('changedPassword')
    },
  }
}
</script>

<style scoped>
</style>
