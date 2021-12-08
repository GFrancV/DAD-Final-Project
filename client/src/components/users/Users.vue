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
    <h1 class="h2">Users</h1>
  </div>
  <div>
    <div class="mb-3 d-flex justify-content-left">
      <router-link
        class="link-secondary"
        aria-label="Add User"
        :to="{
          name: 'UserCreate',
          params: {
            idUser: '900000001',
          },
        }"
      >
        <button type="button" class="btn btn-primary px-3">Add New User</button>
      </router-link>
    </div>
  </div>
</template>

<script>
export default {
  name: "Users",
    props: {
    idUser: {
      type: String,
      default: null,
    },
  },
};
</script>

<style scoped lang="scss"></style>
