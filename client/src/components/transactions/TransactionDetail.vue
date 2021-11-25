<template>
  <div>
    <h5 style="margin-top: 30px;">Transactions: vCard {{ id }}</h5>
    <div class="content">
        {{ vcard }}
        
    </div>
  </div>
</template>

<script>
export default {
    name: 'Transactions',
    props: {
      vcard: {
        type: Number,
        default: null,
      },
      idTransaction: {
        type: Number,
        default: null,
      },
    },
}
</script>

<style scoped lang="scss">
</style>
