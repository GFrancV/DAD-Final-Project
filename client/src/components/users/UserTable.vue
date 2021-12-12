<template>
  <table class="table">
    <thead>
      <tr>
        <th v-if="showId" class="align-middle">#</th>
        <th v-if="showPhoto" class="align-middle">Photo</th>
        <th scope="col">Name</th>
        <th v-if="showEmail" class="align-middle">email</th>
        <th scope="col">Edit</th>
        <th scope="col">Delete</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="user in users" :key="user.id">
        <td v-if="showId" class="align-middle">{{ user.id }}</td>
        <td v-if="showPhoto" class="align-middle">
          <img :src="photoFullUrl(user)" class="rounded-circle img_photo" />
        </td>
        <td class="align-middle">{{ user.name }}</td>
        <td v-if="showEmail" class="align-middle">{{ user.email }}</td>

        <td class="text-end align-middle" v-if="showEditButton">
          <div
            class="d-flex justify-content-end"
            v-if="canViewUserDetail(user.id)"
          >
            <button               class="btn btn-xs btn-light"
              @click="editClick(user)"
              v-if="showEditButton"><i class="bi bi-xs bi-pencil"></i>
            </button>
          </div>
        </td>
        <td>
          <li class="list-inline-item">
            <button type="button" class="btn btn-danger btn-sm">
              <i class="bi-trash-fill red" style="color: white"></i>
            </button>
          </li>
        </td>
      </tr>
    </tbody>
  </table>
</template>

<script>
export default {
  name: "UserTable",
  props: {
    users: {
      type: Array,
      default: () => [],
    },
    showId: {
      type: Boolean,
      default: true,
    },
    showEmail: {
      type: Boolean,
      default: true,
    },
    showAdmin: {
      type: Boolean,
      default: true,
    },
    showPhoto: {
      type: Boolean,
      default: true,
    },

    showEditButton: {
      type: Boolean,
      default: true,
    },
  },
  emits: ["edit"],
  methods: {
    canViewUserDetail(userId) {
      if (!this.$store.state.user) {
        return false;
      }
      return (
        this.$store.state.user.type == "A" ||
        this.$store.state.user.id == userId
      );
    },

    photoFullUrl(user) {
      return user.photo_url
        ? this.$serverUrl + "/storage/fotos/" + user.photo_url
        : "./assets/img/avatar-none.png";
    },
    editClick(user) {
      this.$emit("edit", user);
    },
  },
};
</script>

<style></style>
