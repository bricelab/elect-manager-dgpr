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
            Rapport d'ouverture de scrutin
          </div>
        </v-col>
        <v-col cols="12">
          <v-textarea
              counter
              label="Ouverture"
              :rules="rules"
              :model-value="ouverture"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-textarea>

          <v-textarea
              counter
              label="Incidents observés"
              :rules="rules"
              :model-value="incidents"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-textarea>

          <v-textarea
              counter
              label="Difficultés rencontrées"
              :rules="rules"
              :model-value="difficultes"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-textarea>
        </v-col>
        <v-col cols="6">
          <v-btn
              color="grey"
              variant="outlined"
              @click="back"
          >
            Annuler
          </v-btn>
        </v-col>
        <v-col
            cols="6"
            class="text-end"
        >
          <v-btn
              color="success"
              @click="validate"
          >
            Envoyer
          </v-btn>
        </v-col>
      </v-row>
    </v-form>
  </v-container>
</template>

<script setup>
import {ref} from 'vue'
import {useRouter} from 'vue-router'
import {envoyerRapportOuverture} from "../services/rapport-ouverture";

const router = useRouter()

const rapportOuverture = ref({
  id: 0,
  arrondissement: '/api/arrondissements/156',
  ouverture: '',
  incidents: '',
  difficulties: '',
})

const form = ref()
const valid = ref(false)
const rules = [v => v.length >= 3 || 'Minimum 03 caractères']

const back = () => {
  router.back()
}
const resetData = () => {
  rapportOuverture.value = {
    id: 0,
    arrondissement: '/api/arrondissements/156',
    ouverture: '',
    incidents: '',
    difficulties: '',
  }
}
const validate = async () => {
  valid.value = await form.value.validate()

  if (valid.value) {
    rapportOuverture.value = await envoyerRapportOuverture(rapportOuverture.value)
    resetData()
  }
}
</script>

<style scoped>

</style>
