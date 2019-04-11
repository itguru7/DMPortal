<template>
  <div class="p-3">
    <h2>{{selectedPartNumber}}</h2>
    <template v-if="assets && assets.length">
      <div class="mb-3">
        <vue-magnifier :src="getAssetImageLarge(selectedAssetIndex)" :src-large="getAssetImageLarge(selectedAssetIndex)" />
      </div>
      <carousel :per-page="4" :navigation-enabled="true" :autoplay="true">
        <slide v-for="(asset, index) in assets" :key="'image-'+index">
          <v-card>
            <v-container>
              <v-img @click="selectAsset(index)" :src="getAssetImageSmall(index)" height="100"></v-img>
            </v-container>
          </v-card>
        </slide>
      </carousel>
    </template>
  </div>
</template>

<script>
  import { Carousel, Slide } from 'vue-carousel';
  import vueMagnifier from "../../../components/vue-magnifier";
  import { mapState, mapActions } from 'vuex';

  export default {
    components: {
      vueMagnifier,
      Carousel,
      Slide,
    },
    data() {
      return {
        assets: [],
        selectedAssetIndex: 0,
      }
    },
    computed: {
      ...mapState({
        subdomain:          state => state.global.subdomain,
        selectedPartID:     state => state.global.selectedPartID,
        selectedPartNumber: state => state.global.selectedPartNumber,
      }),
    },
    mounted() {
      this.fetchAssets();
    },
    methods: {
      fetchAssets() {
        var url = SERVER_URL + '/fetchAssets';
        var formData = {
          'Part_ID': this.selectedPartID,
        }
        axios.post(url, formData)
          .then(res  => {
            this.assets = res.data['data'];
            this.selectedAssetIndex = 0;
          })
      },
      getAssetImageSmall(index) {
        return 'http://osc.aftermarketdata.com/assets/' + this.subdomain + '/small/' + this.assets[index]['File_Name'];
      },
      getAssetImageLarge(index) {
        return 'http://osc.aftermarketdata.com/assets/' + this.subdomain + '/large/' + this.assets[index]['File_Name'];
      },
      selectAsset(index) {
        this.selectedAssetIndex = index;
      },
    },
  }

</script>

<style>
  .vue-magnifier-container .preview {
    width: 100% !important;
    height: 300px !important;
  }
</style>
