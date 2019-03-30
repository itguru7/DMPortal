<template>
  <v-container>
    <app-filters></app-filters>
    <app-application-table></app-application-table>
  </v-container>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';

  import Filters  from './Filters.vue';
  import ApplicationTable  from './ApplicationTable.vue';

  export default {
    components: {
      appFilters: Filters,
      appApplicationTable: ApplicationTable,
    }
  }
</script>

<style scoped>
</style>
