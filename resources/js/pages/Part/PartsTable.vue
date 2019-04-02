<template>
  <div>
    <div class="row">
      <div class="col-4">
        <v-text-field
          placeholder="Part Number"
          solo
          v-model="partNumber"
          @keyup.enter="searchParts"
        ></v-text-field>
      </div>
      <div class="col-2">
        <v-btn
          color="error"
          @click="searchParts"
          >
          Go
        </v-btn>
      </div>
    </div>
    <div class="row" v-if="visiblePartsTable">
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
  </div>
</template>

<script>
  import { mapState } from 'vuex';

  export default {
    data() {
      return {
        columns: [
          { label: 'Part_Number', field: 'Part_Number', sortable: false},
          { label: 'Part_Terminology', field: 'Part_Terminology', sortable: false},
        ],
        page: 1,
        per_page: 10,
      }
    },
    computed: {
    ...mapState({
        visiblePartsTable:   state => state.global.visiblePartsTable,
      }),
      partNumber: {
        get() {
          return this.$store.state.global.partNumber;
        },
        set(payload) {
          this.$store.commit('updatePartNumber', payload);
        }
      },
    },
    methods: {
      searchParts() {
        this.$store.dispatch('updatePartsTableVisibility', true);
      },
      getData(params, setRowData) {
        if (params.page_number <= 0 || !params.page_length) {
          return;
        }
        var url = SERVER_URL + '/fetchParts';
        var formData = {
          'partNumber': this.partNumber,
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
            if (res.data['length'] == '1') {
              this.$store.dispatch('updateSelectedPartNumber', res.data['data'][0]['Part_Number']);
            } else {
              this.$store.dispatch('updateSelectedPartNumber', null);
            }
          })
      },
      selectRow(row) {
        this.$store.dispatch('updateSelectedPartNumber', row.Part_Number);
      },
    }
  }
</script>

<style scoped>
</style>
