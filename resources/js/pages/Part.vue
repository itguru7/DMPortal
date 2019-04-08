<template>
  <div class="py-3">
    <div class="row">
      <div class="col-md-6">
        <app-parts-table></app-parts-table>
      </div>
      <div class="col-md-6">
        <app-part-detail></app-part-detail>
      </div>
    </div>
  </div>
</template>

<script>
  import PartsTable   from './Part/PartsTable.vue';
  import PartDetail   from './Part/PartDetail.vue';

  export default {
    components: {
      appPartsTable: PartsTable,
      appPartDetail: PartDetail,
    }
  }
</script>

<style scoped>
</style>
