<template>
  <div class="p-3">
    <h2>{{selectedPartNumber}}</h2>
    <div class="row" v-if="assets && assets.length">
      <template v-if="isMobile">
        <div class="col-12">
          <vue-magnifier :src="getAssetThumbnail(selectedAssetIndex)" :src-large="getAssetImage(selectedAssetIndex)" />
        </div>
        <div class="col-12">
          <v-card class="col-3 mb-2" v-for="(asset, index) in assets" :key="'image-'+index">
            <v-img @click="selectAsset(index)" :src="getAssetThumbnail(index)"></v-img>
          </v-card>
        </div>
      </template>
      <template v-else>
        <div class="col-xl-10 col-sm-8">
          <vue-magnifier :src="getAssetThumbnail(selectedAssetIndex)" :src-large="getAssetImage(selectedAssetIndex)" />
        </div>
        <div class="col-xl-2 col-sm-4 image-scrollview-desktop">
          <v-card class="col-sm-12 mb-2" v-for="(asset, index) in assets" :key="'image-'+index">
            <v-img @click="selectAsset(index)" :src="getAssetThumbnail(index)"></v-img>
          </v-card>
        </div>
      </template>
    </div>
  </div>
</template>

<script>
  import { mapState, mapActions } from 'vuex';
  import vueMagnifier from "../../../components/vue-magnifier";
  import { isMobile } from 'mobile-device-detect';

  export default {
    components: {
      vueMagnifier
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
      getAssetThumbnail(index) {
        return 'assets/' + this.subdomain + '/small/' + this.assets[index]['File_Name'];
      },
      getAssetImage(index) {
        return 'assets/' + this.subdomain + '/large/' + this.assets[index]['File_Name'];
      },
      selectAsset(index) {
        this.selectedAssetIndex = index;
      }
    },
  }

</script>

<style>
  .vue-magnifier-container .preview {
    width: 100% !important;
    height: 300px !important;
  }
</style>

<style scoped>
  .image-scrollview-desktop {
    height: 300px;
    overflow-y: scroll;
  }
</style>
