<template>
  <v-container v-if="assets && assets.length">
    <h2>{{selectedPartNumber}}</h2>
    <div class="row">
      <div class="col-xs-8">
        <vue-magnifier :src="getAssetThumbnail(selectedAssetIndex)" :src-large="getAssetImage(selectedAssetIndex)" />
      </div>
      <div class="col-xs-offset-2 col-xs-2 image-scrollview">
        <v-card v-for="(asset, index) in assets" :key="index" class="mb-2">
          <v-img @click="selectAsset(index)" :src="getAssetThumbnail(index)"></v-img>
        </v-card>
      </div>
    </div>
  </v-container>
</template>

<script>
  import { mapState, mapActions } from 'vuex';
  import vueMagnifier from "../../../components/vue-magnifier";

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
        vendor:               state => state.filters.vendor,
        selectedPartNumber:   state => state.global.selectedPartNumber,
      }),
    },
    mounted() {
      this.fetchAssets();
    },
    methods: {
      fetchAssets() {
        var url = SERVER_URL + '/fetchAssets';
        var formData = {
          'partNumber': this.selectedPartNumber,
        }
        axios.post(url, formData)
          .then(res  => {
            this.assets = res.data['data'];
            this.selectedAssetIndex = 0;
          })
      },
      getAssetThumbnail(index) {
        return 'http://'+this.vendor+'.aftermarketdata.com/wp-content/thumbnails/'+this.assets[index]['File_Name'];
      },
      getAssetImage(index) {
        return 'http://'+this.vendor+'.aftermarketdata.com/wp-content/assets/'+this.assets[index]['File_Name'];
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
  .image-scrollview {
    height: 300px;
    overflow-y: scroll;
  }
</style>
