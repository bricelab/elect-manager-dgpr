<template>
  <v-container>
    <v-form
        ref="form"
        v-model="valid"
        lazy-validation
    >
      <v-row>
        <v-col cols="12">
          <div class="text-subtitle-2 text-purple">
            Arrondissement de Togba
          </div>
          <div class="text-h5 text-purple">
            Remontée de résultats du scrutin
          </div>
        </v-col>
        <v-col cols="12">
          <v-select
              label="Centre de vote"
              clearable
              clear-icon="mdi-close-circle"
              :items="['California', 'Colorado', 'Florida', 'Georgia', 'Texas', 'Wyoming']"
              variant="underlined"
          ></v-select>

          <v-select
              label="Poste de vote"
              clearable
              clear-icon="mdi-close-circle"
              :items="['California2', 'Colorado2', 'Florida2', 'Georgia2', 'Texas2', 'Wyoming2']"
              variant="underlined"
          ></v-select>

          <v-text-field
              label="Nombre d'inscrits"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="Nombre de votants"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="Bulletins nuls"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="MOELE-BÉNIN"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="FCBE"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="Les Démocrates"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="UPR"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="UDBN"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="MPL"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="Bloc Républicain"
              type="number"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>
        </v-col>
        <v-col cols="12" class="text-end">
          <v-btn
              color="grey"
              variant="text"
              class="mr-2"
              @click="back"
          >
            Annuler
          </v-btn>

          <v-btn
              color="success"
              :loading="loading"
              :disabled="!valid"
              @click="validate"
          >
            Valider
          </v-btn>
        </v-col>
      </v-row>
    </v-form>
  </v-container>
</template>

<script setup>
import {ref} from 'vue'
import {useRouter} from 'vue-router'
import {useAlertStore} from '@/stores/alert/alert-store'

const router = useRouter()
const alertStore = useAlertStore()

alertStore.reset()

const hour = ref('')

const form = ref()
const loading = ref(false)
const valid = ref(false)
const rules = [v => v.length >= 3 || 'Minimum 03 caractères']

const back = () => {
  router.back()
}
const validate = async () => {
  valid.value = await form.value.validate()

  if (valid.value) {
    alert('Ok')
  }
}
</script>

<style scoped>

</style>
