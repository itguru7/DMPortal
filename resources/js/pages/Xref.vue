<template>
  <div class="py-3">
    <div class="row">
      <div class="col-md-2 col-6">
        <v-text-field
          placeholder="CROSS REF"
          solo
          v-model="xRef"
          @keyup.enter="searchInterchanges"
        ></v-text-field>
      </div>
      <div class="col-md-1 col-6">
        <v-btn
          color="error"
          @click="searchInterchanges"
          >
          Go
        </v-btn>
      </div>
    </div>
    <div class="row" v-if="visibleInterchangesTable">
      <div class="col-xs-12">
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
  </div>
</template>

<script>
  import { mapState } from 'vuex';

  export default {
    data() {
      return {
        columns: [
          { label: 'Part Number', field: 'Part_Number', sortable: false},
          { label: 'Brand', field: 'Brand', sortable: false},
          { label: 'Interchange', field: 'Interchange_Part_Number', sortable: false},
        ],
        page: 1,
        per_page: 10,
      }
    },
    computed: {
    ...mapState({
        subdomainID:                state => state.global.subdomainID,
        visibleInterchangesTable:   state => state.global.visibleInterchangesTable,
      }),
      xRef: {
        get() {
          return this.$store.state.global.xRef;
        },
        set(payload) {
          this.$store.commit('updateXRef', payload);
        }
      },
    },
    methods: {
      searchInterchanges() {
        this.$store.dispatch('updateInterchangesTableVisibility', true);
      },
      getData(params, setRowData) {
        if (params.page_number <= 0 || !params.page_length) {
          return;
        }
        var url = SERVER_URL + '/fetchInterchanges';
        var formData = {
          'Subdomain_ID': this.subdomainID,
          'xRef': this.xRef,
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
      selectRow(row) {
        this.$store.commit('updateActivePage', 1);
        this.$store.commit('updatePartNumber', row.Part_Number);
        this.$store.dispatch('updateSelectedPart', {partID: row.Part_Target_ID, partNumber: row.Part_Number});
        this.$store.dispatch('updatePartsTableVisibility', true);
      },
    }
  }
</script>

<style scoped>
</style>
