<template>
  <v-container>
    <app-filters></app-filters>
  </v-container>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';

  import Filters  from './Filters.vue';

  export default {
    components: {
      appFilters: Filters,
    }
  }
</script>

<style scoped>
</style>
