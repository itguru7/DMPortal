<template>
  <div class="p-3">
    <h2>{{selectedPartNumber}}</h2>
    <template v-if="assets && assets.length">
      <template v-if="!isMobile()">
        <div class="row mb-3">
          <div class="col-9">
            <vue-magnifier :src="getAssetImageLarge(selectedAssetIndex)" :src-large="getAssetImageLarge(selectedAssetIndex)"/>
          </div>
          <div class="col-3">
            <ZoomImage
              id="zoomImage"
              imageWidth="150"
              imageHeight="150"
              :src="getAssetImageLarge(selectedAssetIndex)"
            />
          </div>
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
      <template v-else>
        <div class="mb-3">
          <v-img :src="getAssetImageSmall(selectedAssetIndex)" width="100%"></v-img>
        </div>
        <carousel :per-page="2" :navigation-enabled="true" :autoplay="true">
          <slide v-for="(asset, index) in assets" :key="'image-'+index">
            <v-card>
              <v-container>
                <v-img @click="selectAsset(index)" :src="getAssetImageSmall(index)" height="50"></v-img>
              </v-container>
            </v-card>
          </slide>
        </carousel>
      </template>
    </template>
  </div>
</template>

<script>
  import { mapState, mapActions } from 'vuex';
  import { Carousel, Slide } from 'vue-carousel';
  import vueMagnifier from "../../../components/vue-magnifier";
  import ZoomImage from "../../../components/ZoomImage";
  import { isMobile } from "../../../functions";

  export default {
    components: {
      vueMagnifier,
      Carousel,
      Slide,
      ZoomImage,
    },
    data() {
      return {
        assets: [],
        selectedAssetIndex: 0,
      }
    },
    computed: {
      ...mapState({
        vendor:             state => state.global.vendor,
        selectedPartID:     state => state.global.selectedPartID,
        selectedPartNumber: state => state.global.selectedPartNumber,
      }),
    },
    mounted() {
      this.fetchAssets();
    },
    methods: {
      isMobile,
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
        return 'assets/' + this.vendor + '/small/' + this.assets[index]['File_Name'];
      },
      getAssetImageLarge(index) {
        return 'assets/' + this.vendor + '/large/' + this.assets[index]['File_Name'];
      },
      selectAsset(index) {
        this.selectedAssetIndex = index;
      },
    },
  }

</script>

<style>
  .vue-magnifier-container .preview {
    z-index: 1;
    width: 100% !important;
    height: 300px !important;
  }
  #zoomImage img {
    z-index: 1;
  }
</style>
