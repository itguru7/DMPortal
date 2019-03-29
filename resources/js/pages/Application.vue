<template>
  <v-app>
    <h2>Hello {{ vendor }}</h2>
    <v-container>
      <v-tabs
        slot="extension"
        color="cyan"
        dark
        slider-color="yellow"
      >
        <v-tab href="#filter">
          Application
        </v-tab>
        <v-tab href="#part">
          Part Number
        </v-tab>
        <v-tab href="#xref">
          Xref
        </v-tab>
        <v-tab-item :value="'filter'">
          <app-filter></app-filter>
        </v-tab-item>
        <v-tab-item :value="'part'">
          <app-part></app-part>
        </v-tab-item>
        <v-tab-item :value="'xref'">
          <app-xref></app-xref>
        </v-tab-item>
      </v-tabs>
    </v-container>
  </v-app>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';

  import Filter from './Application/Filter.vue';
  import Part from './Application/Part.vue';
  import Xref from './Application/Xref.vue';

  export default {
    components: {
      appFilter: Filter,
      appPart: Part,
      appXref: Xref,
    },
    created() {
      this.$store.dispatch('setVendor', this.$route.params.vendor);
      this.$store.dispatch('fetchMakes');
    },
    computed: {
      ...mapGetters([
        'vendor'
      ])
    },
    methods: {
      ...mapActions([
        'fetchMakes'
      ]),
    }
  }
</script>

<style scoped>
</style>
