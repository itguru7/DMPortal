<template>
  <div>
    <h3>Filter</h3>
    <v-container>
      <v-layout row wrap>
        <v-flex md3>
          <label for="filter_makes">Make</label>
          <select
            id="filter_makes"
            class="form-control"
            v-model="selectedMake"
            size="4"
          >
            <option
              v-for="make in makes"
            >
              {{ make }}
            </option>
          </select>
        </v-flex>
        <v-flex md3>
          <label for="filter_models">Model</label>
          <select
            id="filter_models"
            class="form-control"
            v-model="selectedModel"
            size="4"
          >
            <option
              v-for="model in models"
            >
              {{ model }}
            </option>
          </select>
        </v-flex>
        <v-flex md3>
          <label for="filter_years">Year</label>
          <select
            id="filter_years"
            class="form-control"
            v-model="selectedYear"
            size="4"
          >
            <option
              v-for="year in years"
            >
              {{ year }}
            </option>
          </select>
        </v-flex>
        <v-flex md3>
          <label for="filter_engines">Engine</label>
          <select
            id="filter_engines"
            class="form-control"
            v-model="selectedEngine"
            size="4"
          >
            <option
              v-for="engine in engines"
            >
              {{ engine }}
            </option>
          </select>
        </v-flex>
      </v-layout>
    </v-container>
    <p>{{selectedMake}}</p>
  </div>
</template>

<script>
  import { mapGetters, mapActions } from 'vuex';

  export default {
    computed: {
      ...mapGetters([
        'vendor',
        'makes',
        'models',
        'years',
        'engines'
      ]),
      selectedMake: {
        get() {
          return this.$store.getters.selectedMake;
        },
        set(payload) {
          this.$store.dispatch('selectMake', payload);
        }
      },
      selectedModel: {
        get() {
          return this.$store.getters.selectedModel;
        },
        set(payload) {
          this.$store.dispatch('selectModel', payload);
        }
      },
      selectedYear: {
        get() {
          return this.$store.getters.selectedYear;
        },
        set(payload) {
          this.$store.dispatch('selectYear', payload);
        }
      },
      selectedEngine: {
        get() {
          return this.$store.getters.selectedEngine;
        },
        set(payload) {
          this.$store.dispatch('selectEngine', payload);
        }
      }
    },
  }
</script>

<style scoped>
</style>
