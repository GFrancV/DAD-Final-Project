<template>
  <div>
    <h5 v-if="idTransaction == null" style="margin-top: 30px;"> New transaction of vCard {{ vcard }}</h5>
    <h5 v-else style="margin-top: 30px;" > Transaction {{idTransaction }} of vCard {{ vcard }} </h5>
    <div class="content">
        {{ transactionTitle }}
    </div>
  </div>
</template>

<script>
export default {
    name: 'Transactions',
    props: {
      transaction: {
        type: Object,
        required: true,
      },
      idVcard: {
        type: Number,
        default: null,
      },
      idTransaction: {
        type: Number,
        default: null,
      },
    },

    data () {
      return {
        editingTransaction: this.transaction,
      }
    },

    computed: {
      transactionTitle () {
        if (!this.editingTransaction) {
          return ""
        }
        return this.operationType == "insert"
          ? "New Project"
          : "Project #" + this.editingProject.id
      },
    },
}
</script>

<style scoped lang="scss">
</style>
