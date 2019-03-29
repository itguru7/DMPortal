<template>
  <div>
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
