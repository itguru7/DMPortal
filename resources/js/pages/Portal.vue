<template>
  <v-app>
    <h2>Hello {{ vendor }}</h2>
    <v-container>
      <v-tabs
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
          <div class="tab-item-wrapper">
            <app-application></app-application>
          </div>
        </v-tab-item>
        <v-tab-item :value="'part'">
          <div class="tab-item-wrapper">
            <app-part></app-part>
          </div>
        </v-tab-item>
        <v-tab-item :value="'xref'">
          <div class="tab-item-wrapper">
            <app-xref></app-xref>
          </div>
        </v-tab-item>
      </v-tabs>
    </v-container>
  </v-app>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';

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
      ...mapGetters([
        'vendor'
      ])
    },
    methods: {
      ...mapActions([
        'fetchMakes'
      ]),
    },
    created() {
      this.$store.dispatch('updateVendor', this.$route.params.vendor);
      this.$store.dispatch('fetchMakes');
    },

  }
</script>

<style scoped>
</style>
