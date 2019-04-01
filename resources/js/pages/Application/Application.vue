<template>
  <v-container>
    <app-filters></app-filters>
    <app-applications-table></app-applications-table>
  </v-container>
</template>

<script>
  import Filters  from './Filters.vue';
  import ApplicationsTable  from './ApplicationsTable.vue';

  export default {
    components: {
      appFilters: Filters,
      appApplicationsTable: ApplicationsTable,
    }
  }
</script>

<style scoped>
</style>
