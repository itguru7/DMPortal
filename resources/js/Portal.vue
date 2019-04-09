<template>
  <div :class="{'container': !isMobile}">
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
        CROSS REF
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
  </div>
</template>

<script>
  import { isMobile } from 'mobile-device-detect';

  import { mapState } from 'vuex';

  import Application  from './pages/Application.vue';
  import Part         from './pages/Part.vue';
  import Xref         from './pages/Xref.vue';

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
    created() {
      // var vendor = this.$route.params.vendor;

      const parts = window.location.host.split('.');
      if (parts.length != 3) {
        return;
      }
      var vendor = parts[0];

      this.$store.dispatch('fetchSubdomain', vendor);
    },

  }
</script>

<style scoped>
</style>
