<template>
  <v-container>
    <h2>{{selectedPartNumber}}</h2>
    <div class="row" v-if="assets && assets.length">
      <div class="col-xs-8">
        <vue-magnifier :src="getAssetThumbnail(selectedAssetIndex)" :src-large="getAssetImage(selectedAssetIndex)" />
      </div>
      <div class="col-xs-offset-2 col-xs-2 image-scrollview">
        <v-card class="mb-2" v-for="(asset, index) in assets" :key="'image-'+index">
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
        return 'http://'+this.subdomain+'.aftermarketdata.com/wp-content/thumbnails/'+this.assets[index]['File_Name'];
      },
      getAssetImage(index) {
        return 'http://'+this.subdomain+'.aftermarketdata.com/wp-content/assets/'+this.assets[index]['File_Name'];
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
