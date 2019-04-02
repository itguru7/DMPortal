<template>
  <div>
    <h2>{{selectedPartNumber}}</h2>
    <br>
    <h4>Part Information</h4>
    <hr>
    <template v-for="info in information">
      <div>
        {{info['Information']}}
      </div>
    </template>
    <br>
    <h4>Part Attributes</h4>
    <hr>
    <template v-for="attribute in attributes">
      <div>
        {{attribute['Attribute']}}
      </div>
    </template>
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
        selectedPartNumber:       state => state.global.selectedPartNumber,
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
          'partNumber': this.selectedPartNumber,
        }
        axios.post(url, formData)
          .then(res  => {
            this.information = res.data['data'];
          })
      },
      fetchAttributes() {
        var url = SERVER_URL + '/fetchAttributes';
        var formData = {
          'partNumber': this.selectedPartNumber,
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
</style>
