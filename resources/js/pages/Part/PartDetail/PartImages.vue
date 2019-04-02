<template>
  <div v-if="assets && assets.length">
    <div>
      <h2>{{selectedPartNumber}}</h2>
    </div>
    <div>
      <vue-magnifier v-bind:src="getAssetThumbnail(selectedAssetIndex)" v-bind:src-large="getAssetImage(selectedAssetIndex)" />
    </div>
    <p>{{getAssetThumbnail(selectedAssetIndex)}}</p>
  </div>
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
    },
  }

</script>

<style scoped>
</style>
