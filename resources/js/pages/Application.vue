<template>
  <div class="content-wrapper">
    <app-filters></app-filters>
    <app-applications-table></app-applications-table>
  </div>
</template>

<script>
  import Filters  from './Application/Filters.vue';
  import ApplicationsTable  from './Application/ApplicationsTable.vue';

  export default {
    components: {
      appFilters: Filters,
      appApplicationsTable: ApplicationsTable,
    }
  }
</script>

<style scoped>
</style>
