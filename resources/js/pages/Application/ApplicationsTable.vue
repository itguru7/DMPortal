<template>
  <div class="row" v-if="visibleApplicationsTable">
    <div class="col-xs-12 table-responsive">
      <datatable :columns="columns" :data="getData">
        <template slot-scope="{ row, columns }">
          <tr @click="selectRow(row)">
            <template>
              <datatable-cell v-for="(column, j) in columns" :key="j" :column="column" :row="row"></datatable-cell>
            </template>
          </tr>
        </template>
      </datatable>
    </div>
    <div class="col-xs-12 form-inline">
      <datatable-pager v-model="page" type="abbreviated" :per-page="per_page"></datatable-pager>
    </div>
  </div>
</template>

<script>
  import { mapState } from 'vuex';

  export default {
    data() {
      return {
        columns: [
          { label: 'Product', field: 'Part_Terminology', filterable: false, sortable: false},
          { label: 'Notes', field: 'Notes', sortable: true},
          { label: 'Quantity', field: 'Quantity', sortable: false},
          { label: 'Part Number', field: 'Part_Number', sortable: false},
          { label: 'Engine Type', field: 'Engine_Info', sortable: false},
        ],
        page: 1,
        per_page: 10,
      }
    },
    computed: {
      ...mapState({
        subdomainID:        state => state.global.subdomainID,
        selectedMake:       state => state.filters.selectedMake,
        selectedModel:      state => state.filters.selectedModel,
        selectedYear:       state => state.filters.selectedYear,
        selectedEngine:     state => state.filters.selectedEngine,
        visibleApplicationsTable:   state => state.global.visibleApplicationsTable,
      }),
    },
    methods: {
      getData(params, setRowData) {
        if (params.page_number <= 0 || !params.page_length) {
          return;
        }
        var url = SERVER_URL + '/fetchApplications';
        var formData = {
          'filters': {
            'Subdomain_ID': this.subdomainID,
            'Make': this.selectedMake,
            'Model': this.selectedModel,
            'Year': this.selectedYear,
            'Engine_Info': this.selectedEngine,
          },
          'limit': {
            'offset': (params.page_number - 1) * params.page_length,
            'count': params.page_length,
          },
          'sort': {
            sort_by: params.sort_by,
            sort_dir: params.sort_dir,
          },
        }
        axios.post(url, formData)
          .then(res  => {
            setRowData(
              res.data['data'],
              res.data['length'],
            );
          })
      },
      selectRow(row) {
        this.$store.commit('updateActivePage', 1);
        this.$store.commit('updatePartNumber', row.Part_Number);
        this.$store.commit('updateSelectedPart', {partID: row.Part_Target_ID, partNumber: row.Part_Number});
        this.$store.dispatch('updatePartsTableVisibility', true);
      },
    }
  }
</script>

<style scoped>
</style>
