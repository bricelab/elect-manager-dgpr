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
            Arrondissement de <span class="fw-bold">{{ userStore.arrondissementName }}</span>
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
              v-model="rapportOuverture.ouverture"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
              :readonly="loading"
          ></v-textarea>

          <v-textarea
              counter
              label="Incidents observés"
              :rules="rules"
              v-model="rapportOuverture.incidents"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
              :readonly="loading"
          ></v-textarea>

          <v-textarea
              counter
              label="Difficultés rencontrées"
              :rules="rules"
              v-model="rapportOuverture.difficultes"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
              :readonly="loading"
          ></v-textarea>
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
import {envoyerRapportOuverture} from '@/services/rapport-ouverture/rapport-ouverture_services'
import {useAlertStore} from '@/stores/alert/alert-store'
import {useUserStore} from '@/stores/user/user-store'

const router = useRouter()
const alertStore = useAlertStore()
const userStore = useUserStore()

alertStore.reset()

const rapportOuverture = ref({
  id: 0,
  arrondissement: '/api/arrondissements/156',
  ouverture: '',
  incidents: '',
  difficultes: '',
})

const form = ref()
const loading = ref(false)
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
    difficultes: '',
  }
}
const validate = async () => {
  loading.value = true
  valid.value = await form.value.validate()

  if (valid.value) {
    try {
      rapportOuverture.value = await envoyerRapportOuverture(rapportOuverture.value)
      alertStore.type = 'success'
      alertStore.title = 'Succès'
      alertStore.message = 'Informations soumises avec succès !'
    } catch (e) {
      alertStore.type = 'error'
      alertStore.title = 'Erreur'
      alertStore.message = 'Une erreur s\'est produite. Veuillez réessayer plus tard svp !'
    }
    alertStore.show = true
    resetData()
    loading.value = false
    back()
  }
}
</script>

<style scoped>

</style>
