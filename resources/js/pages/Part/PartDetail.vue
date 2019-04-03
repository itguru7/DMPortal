<template>
  <v-container v-if="selectedPartID">
    <v-tabs
      v-model="activePartPage"
      color="cyan"
      dark
      slider-color="yellow"
    >
      <v-tab>
        Images
      </v-tab>
      <v-tab>
        Part Info
      </v-tab>
      <v-tab>
        Buyer's Guide
      </v-tab>
      <v-tab-item>
        <app-part-images></app-part-images>
      </v-tab-item>
      <v-tab-item>
        <app-part-info></app-part-info>
      </v-tab-item>
      <v-tab-item>
        <app-part-buyerguide></app-part-buyerguide>
      </v-tab-item>
    </v-tabs>
  </v-container>
</template>

<script>
  import { mapState, mapActions } from 'vuex';

  import PartImages         from './PartDetail/PartImages.vue';
  import PartInfo           from './PartDetail/PartInfo.vue';
  import PartBuyerGuide     from './PartDetail/PartBuyerGuide.vue';

  export default {
    components: {
      appPartImages:      PartImages,
      appPartInfo:        PartInfo,
      appPartBuyerguide:  PartBuyerGuide,
    },
    computed: {
      ...mapState({
        selectedPartID:   state => state.global.selectedPartID,
      }),
      activePartPage: {
        get() {
          return this.$store.state.global.activePartPage;
        },
        set(payload) {
          this.$store.commit('updateActivePartPage', payload);
        },
      },
    },
  }
</script>

<style scoped>
</style>
