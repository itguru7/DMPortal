<template>
  <div class="p-3 part-info-container">
    <h2>{{selectedPartNumber}}</h2>
    <br>

    <h4>Part Information</h4>
    <hr>
    <div v-for="(info, index) in information" :key="'information-'+index">
      {{info['Information']}}
    </div>
    <br>
    <br>

    <h4>Part Attributes</h4>
    <hr>
    <div v-for="(attribute, index) in attributes" :key="'attribute-'+index">
      {{attribute['Attribute']}}
    </div>
  </div>
</template>

<script>
  import { mapState } from 'vuex';

  export default {
    data() {
      return {
        information: [],
        attributes: [],
      }
    },
    computed: {
    ...mapState({
        selectedPartID:     state => state.global.selectedPartID,
        selectedPartNumber: state => state.global.selectedPartNumber,
      }),
    },
    mounted() {
      this.fetchInformation();
      this.fetchAttributes();
    },
    methods: {
      fetchInformation() {
        var url = SERVER_URL + '/fetchInformation';
        var formData = {
          'Part_ID': this.selectedPartID,
        }
        axios.post(url, formData)
          .then(res  => {
            this.information = res.data['data'];
          })
      },
      fetchAttributes() {
        var url = SERVER_URL + '/fetchAttributes';
        var formData = {
          'Part_ID': this.selectedPartID,
        }
        axios.post(url, formData)
          .then(res  => {
            this.attributes = res.data['data'];
          })
      },
    }
  }
</script>

<style scoped>
  .part-info-container {
    overflow-y: scroll;
    max-height: calc(100vh - 250px);
  }
</style>
