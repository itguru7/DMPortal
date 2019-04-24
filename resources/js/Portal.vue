<template v-if="subdomainID > 0">
  <div v-if="access==1" class="portal-container" :style="{backgroundImage: backgroundImage}">
    <v-img :src="logoImage" class="logo"></v-img>
    <h2>{{ title ? title : '&nbsp' }}</h2>
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
    <v-footer
      dark
      height="auto"
    >
      <v-card
        class="flex text-center"
        flat
        tile
      >
        <v-card-text>
          <h5>Contact us: <a href="mailto:info@cryomaxusa.com">info@cryomaxusa.com</a></h5>
          <v-divider></v-divider>
          <h6>Catalog provided by DataPoint Inc | all rights reserved</h6>
        </v-card-text>
      </v-card>
    </v-footer>
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
        subdomainID:        state => state.global.subdomainID,
        vendor:              state => state.global.vendor,
        title:              state => state.global.title,
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
        return this.logo ? 'assets/' + this.vendor + '/' + this.logo : '';
      },
      backgroundImage() {
        return this.background ? 'url(assets/' + this.vendor + '/' + this.background + ')' : '';
      },
    },
    created() {
      // var subdomain = this.$route.params.subdomain;

      const parts = window.location.host.split('.');
      if (parts.length != 3) {
        return;
      }
      var subdomain = parts[0];

      this.$store.dispatch('fetchSubdomain', subdomain);
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
  .portal-container{
    background-size: cover;
    height: 100vh;
    padding: 3rem;
  }
  .logo {
    width: 100px;
  }
</style>

<style>
  .content-wrapper {
    padding: 1rem;
    background: rgba(255, 255, 255, .8);
  }
</style>
