<template>
  <v-container>
    <v-tabs
      v-model="activePage"
      color="purple"
      dark
      slider-color="white"
    >
      <v-tab>
        Application
      </v-tab>
      <v-tab>
        Part Number
      </v-tab>
      <v-tab>
        Xref
      </v-tab>
      <v-tab-item>
        <app-application></app-application>
      </v-tab-item>
      <v-tab-item>
        <app-part></app-part>
      </v-tab-item>
      <v-tab-item>
        <app-xref></app-xref>
      </v-tab-item>
    </v-tabs>
  </v-container>
</template>

<script>
  import { mapState, mapActions } from 'vuex';

  import Application  from './Application/Application.vue';
  import Part         from './Part/Part.vue';
  import Xref         from './Xref/Xref.vue';

  export default {
    components: {
      appApplication: Application,
      appPart:        Part,
      appXref:        Xref,
    },
    computed: {
      activePage: {
        get() {
          return this.$store.state.global.activePage;
        },
        set(payload) {
          this.$store.commit('updateActivePage', payload);
        },
      },
    },
    methods: {
      ...mapActions([
        'fetchMakes'
      ]),
    },
    created() {
      this.$store.commit('updateVendor', this.$route.params.vendor);
      this.$store.dispatch('fetchMakes');
    },

  }
</script>

<style scoped>
</style>
