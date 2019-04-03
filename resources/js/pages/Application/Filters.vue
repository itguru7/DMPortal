<template>
  <div class="row">
    <div class="col-md-3 col-sm-6">
      <div class="form-group">
        <h3 class="text-center">Make</h3>
        <select
          id="filter_makes"
          class="form-control"
          v-model="selectedMake"
          size="10"
        >
          <option v-for="make in makes" :key="make">
            {{ make }}
          </option>
        </select>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="form-group">
        <h3 class="text-center">Model</h3>
        <select
          id="filter_models"
          class="form-control"
          v-model="selectedModel"
          size="10"
        >
          <option v-for="model in models" :key="model">
            {{ model }}
          </option>
        </select>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="form-group">
        <h3 class="text-center">Year</h3>
        <select
          id="filter_years"
          class="form-control"
          v-model="selectedYear"
          size="10"
        >
          <option v-for="year in years" :key="year">
            {{ year }}
          </option>
        </select>
      </div>
    </div>
    <div class="col-md-3 col-sm-6">
      <div class="form-group">
        <h3 class="text-center">Engine</h3>
        <select
          id="filter_engines"
          class="form-control"
          v-model="selectedEngine"
          size="10"
        >
          <option v-for="engine in engines" :key="engine">
            {{ engine }}
          </option>
        </select>
      </div>
    </div>
  </div>
</template>

<script>
  import { mapState } from 'vuex';

  export default {
    computed: {
      ...mapState({
        subdomainID:  state => state.global.subdomainID,
        makes:        state => state.filters.makes,
        models:       state => state.filters.models,
        years:        state => state.filters.years,
        engines:      state => state.filters.engines,
      }),
      selectedMake: {
        get() {
          return this.$store.state.filters.selectedMake;
        },
        set(payload) {
          this.$store.commit('selectMake', payload);
        },
      },
      selectedModel: {
        get() {
          return this.$store.state.filters.selectedModel;
        },
        set(payload) {
          this.$store.commit('selectModel', payload);
        },
      },
      selectedYear: {
        get() {
          return this.$store.state.filters.selectedYear;
        },
        set(payload) {
          this.$store.commit('selectYear', payload);
        },
      },
      selectedEngine: {
        get() {
          return this.$store.state.filters.selectedEngine;
        },
        set(payload) {
          this.$store.commit('selectEngine', payload);
        },
      },
    },
    watch: {
      subdomainID(newValue, oldValue) {
        if (newValue > 0) {
          this.$store.dispatch('fetchMakes');
        } else {
          this.$store.commit('updateMakes', []);
        }
      },

      makes(newValue, oldValue) {
        this.$store.commit('selectMake', null);
      },
      models(newValue, oldValue) {
        this.$store.commit('selectModel', null);
      },
      years(newValue, oldValue) {
        this.$store.commit('selectYear', null);
      },
      engines(newValue, oldValue) {
        this.$store.commit('selectEngine', null);
      },

      selectedMake(newValue, oldValue) {
        if (newValue) {
          this.$store.dispatch('fetchModels');
        } else {
          this.$store.commit('updateModels', []);
        }
      },
      selectedModel(newValue, oldValue) {
        if (newValue) {
          this.$store.dispatch('fetchYears');
        } else {
          this.$store.commit('updateYears', []);
        }
      },
      selectedYear(newValue, oldValue) {
        if (newValue) {
          this.$store.dispatch('fetchEngines');
        } else {
          this.$store.commit('updateEngines', []);
        }
      },
      selectedEngine(newValue, oldValue) {
        if (newValue) {
          this.$store.dispatch('updateApplicationsTableVisibility', true);
        } else {
          this.$store.dispatch('updateApplicationsTableVisibility', false);
        }
      },
    },
  }
</script>

<style scoped>
</style>
