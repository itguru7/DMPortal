<template>
  <v-container>
    <v-tabs
      v-model="activePage"
      color="cyan"
      dark
      slider-color="yellow"
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
    </v-tabs>
    <v-tabs-items v-model="activePage">
      <v-tab-item>
        <div class="tab-item-wrapper">
          <app-application></app-application>
        </div>
      </v-tab-item>
      <v-tab-item>
        <div class="tab-item-wrapper">
          <app-part></app-part>
        </div>
      </v-tab-item>
      <v-tab-item>
        <div class="tab-item-wrapper">
          <app-xref></app-xref>
        </div>
      </v-tab-item>
    </v-tabs-items>
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
      appPart: Part,
      appXref: Xref,
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
