<template>
  <v-container>
    <div class="row">
      <div class="col-sm-6">
        <app-parts-table></app-parts-table>
      </div>
      <div class="col-sm-6">
        <app-part-detail></app-part-detail>
      </div>
    </div>
  </v-container>
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
