<template>
  <v-container>
    <v-layout row wrap>
      <v-flex xs12 class="table-responsive">
        <datatable :columns="columns" :data="getData"></datatable>
      </v-flex>
      <v-flex xs12 class="table-responsive">
        <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';

  export default {
    data() {
      return {
        columns: [
          { label: 'Year', field: 'Year', sortable: false},
          { label: 'Make', field: 'Make', sortable: false},
          { label: 'Model', field: 'Model', sortable: false},
          { label: 'Part Terminology', field: 'Part_Terminology', sortable: false},
          { label: 'Engine_Info', field: 'Engine_Info', sortable: false},
          { label: 'Notes', field: 'Notes', sortable: false},
          { label: 'Quantity', field: 'Quantity', sortable: false},
          { label: 'Part_Number', field: 'Part_Number', sortable: false},
        ],
        rows: window.rows,
        page: 1,
        per_page: 10,
      }
    },
    computed: {
      ...mapGetters([
        'vendor',
        'selectedMake',
        'selectedModel',
        'selectedYear',
        'selectedEngine',
      ]),
    },
    methods: {
      getData(params, setRowData){
        var url = SERVER_URL + '/fetchParts';
        var formData = {
          'filters': {
            // 'Vendor': vendor,
            'Make': selectedMake,
            'Model': selectedModel,
            'Year': selectedYear,
            'Engine_Info': selectedEngine,
          },
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
      }
    }
  }
</script>

<style scoped>
</style>
