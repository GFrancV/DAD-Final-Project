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

  <user-table
    :users="$store.getters.users"
    :showId="false"
  ></user-table>
</template>

<script>

import UserTable from "./UserTable.vue"

export default {
  name: "Users",
  components:{
    UserTable
  },
  props: {
    idUser: {
      type: String,
      default: null,
    },
  },
  data() {
    return {
      users: [],
    };
  },
  methods: {
    getUsers() {
      this.$axios
        .get("users")
        .then((response) => {
          this.users = response.data.data;
        })
        .catch((error) => {
          console.log(error);
        });
    },
  },
  mounted() {
    this.getUsers();
  },
};
</script>

<style scoped lang="scss"></style>
