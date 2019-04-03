<template>
  <v-container>
    <div>
      <h2>{{selectedPartNumber}}</h2>
    </div>
    <div class="row">
      <div class="col-xs-12 table-responsive">
        <datatable :columns="columns" :data="getData"></datatable>
      </div>
      <div class="col-xs-12 form-inline">
        <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
      </div>
    </div>
  </v-container>
</template>

<script>
  import { mapState } from 'vuex';

  export default {
    data() {
      return {
        columns: [
          { label: 'Make', field: 'Make', sortable: false},
          { label: 'Model', field: 'Model', sortable: false},
          { label: 'Year_Range', field: 'Year_Range', sortable: false},
        ],
        page: 1,
        per_page: 10,
      }
    },
    computed: {
    ...mapState({
        selectedPartID:       state => state.global.selectedPartID,
        selectedPartNumber:   state => state.global.selectedPartNumber,
      }),
    },
    methods: {
      getData(params, setRowData) {
        if (params.page_number <= 0 || !params.page_length) {
          return;
        }
        var url = SERVER_URL + '/fetchBuyerGuide';
        var formData = {
          'Part_ID': this.selectedPartID,
          'limit': {
            'offset': (params.page_number - 1) * params.page_length,
            'count': params.page_length,
          }
        }
        axios.post(url, formData)
          .then(res  => {
            setRowData(
              res.data['data'],
              res.data['length'],
            );
          })
      },
    }
  }
</script>

<style scoped>
</style>
