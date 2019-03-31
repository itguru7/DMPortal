<template>
  <v-container>
    <v-layout row wrap>
      <v-flex md3>
        <v-card class="pa-3">
          <h3 class="text-center">Make</h3>
          <select
            id="filter_makes"
            class="form-control"
            v-model="selectedMake"
            size="10"
          >
            <option
              v-for="make in makes"
            >
              {{ make }}
            </option>
          </select>
        </v-card>
      </v-flex>
      <v-flex md3>
        <v-card class="pa-3">
          <h3 class="text-center">Model</h3>
          <select
            id="filter_models"
            class="form-control"
            v-model="selectedModel"
            size="10"
          >
            <option
              v-for="model in models"
            >
              {{ model }}
            </option>
          </select>
        </v-card>
      </v-flex>
      <v-flex md3>
        <v-card class="pa-3">
          <h3 class="text-center">Year</h3>
          <select
            id="filter_years"
            class="form-control"
            v-model="selectedYear"
            size="10"
          >
            <option
              v-for="year in years"
            >
              {{ year }}
            </option>
          </select>
        </v-card>
      </v-flex>
      <v-flex md3>
        <v-card class="pa-3">
          <h3 class="text-center">Engine</h3>
          <select
            id="filter_engines"
            class="form-control"
            v-model="selectedEngine"
            size="10"
          >
            <option
              v-for="engine in engines"
            >
              {{ engine }}
            </option>
          </select>
        </v-card>
      </v-flex>
    </v-layout>
  </v-container>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';

  export default {
    computed: {
      ...mapGetters([
        'makes',
        'models',
        'years',
        'engines',
      ]),
      selectedMake: {
        get() {
          return this.$store.getters.selectedMake;
        },
        set(payload) {
          this.$store.commit('selectMake', payload);
        },
      },
      selectedModel: {
        get() {
          return this.$store.getters.selectedModel;
        },
        set(payload) {
          this.$store.commit('selectModel', payload);
        },
      },
      selectedYear: {
        get() {
          return this.$store.getters.selectedYear;
        },
        set(payload) {
          this.$store.commit('selectYear', payload);
        },
      },
      selectedEngine: {
        get() {
          return this.$store.getters.selectedEngine;
        },
        set(payload) {
          this.$store.commit('selectEngine', payload);
        },
      },
    },
    watch: {
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
          this.$store.dispatch('updatePartsTableVisibility', true);
        } else {
          this.$store.dispatch('updatePartsTableVisibility', false);
        }
      },

    },
  }
</script>

<style scoped>
</style>
