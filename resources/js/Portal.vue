<template v-if="subdomainID > 0">
  <div v-if="access==1" class="container portal-container" :style="{backgroundImage: backgroundImage}">
    <h2>{{ name }}</h2>
    <v-img :src="logoImage" class="logo"></v-img>
    <v-tabs
      v-model="activePage"
      :color="color"
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
  <div v-else class="container">
    <div class="row">
      <div class="col-md-4 col-6">
        <v-text-field
          placeholder="Type password here..."
          solo
          v-model="pwd"
          :type="'password'"
          @keyup.enter="enterPassword"
        ></v-text-field>
      </div>
      <div class="col-md-2 col-6">
        <v-btn color="default" @click="enterPassword">Enter</v-btn>
      </div>
    </div>
  </div>
</template>

<script>
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
    data() {
      return {
        pwd: '',
      }
    },
    computed: {
      ...mapState({
        subdomain:          state => state.global.subdomain,
        subdomainID:        state => state.global.subdomainID,
        name:               state => state.global.name,
        color:              state => state.global.color,
        logo:               state => state.global.logo,
        background:         state => state.global.background,
        access:             state => state.global.access,
        password:           state => state.global.password,
      }),
      activePage: {
        get() {
          return this.$store.state.global.activePage;
        },
        set(payload) {
          this.$store.commit('updateActivePage', payload);
        },
      },
      logoImage() {
        return this.logo ? 'assets/' + this.subdomain + '/' + this.logo : '';
      },
      backgroundImage() {
        return this.background ? 'url(assets/' + this.subdomain + '/' + this.background + ')' : '';
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
    methods: {
      enterPassword() {
        if (this.pwd === this.password) {
          this.$store.commit('updateAccess', 1);
        } else {
          alert('Wrong password');
          this.pwd = '';
        }
      }
    }

  }
</script>

<style scoped>
  .logo {
    width: 100px;
    height: 50px;
  }
  .portal-container{
    background-size: cover;
  }
</style>
