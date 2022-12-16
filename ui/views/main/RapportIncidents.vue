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
            Signalement d'incidents
          </div>
        </v-col>
        <v-col cols="12">
          <v-text-field
              label="Heure"
              type="time"
              v-model="incident.heure"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-textarea
              counter
              label="Incidents observés"
              :rules="rules"
              v-model="incident.details"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
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
            Signaler
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
import {useUserStore} from '@/stores/user/user-store'
import {signalerIncident} from '@/services/incident/incident_services'

const router = useRouter()
const alertStore = useAlertStore()
const userStore = useUserStore()

alertStore.reset()

const incident = ref({
  id: 0,
  heure: '',
  details: '',
})

const form = ref()
const loading = ref(false)
const valid = ref(false)
const rules = [v => v.length >= 3 || 'Minimum 03 caractères']

const back = () => {
  router.back()
}
const resetData = () => {
  incident.value = {
    id: 0,
    heure: '',
    details: '',
  }
}
const validate = async () => {
  valid.value = await form.value.validate()

  if (valid.value) {
    try {
      console.log(incident.value)
      incident.value = await signalerIncident(incident.value)
      await userStore.initialize()
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
