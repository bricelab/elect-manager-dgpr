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
            Signalement d'incidents
          </div>
        </v-col>
        <v-col cols="12">
          <v-text-field
              label="Heure"
              type="time"
              :model-value="hour"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-textarea
              counter
              label="Incidents observés"
              :rules="rules"
              :model-value="incidents"
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

const router = useRouter()
const alertStore = useAlertStore()

alertStore.reset()

const hour = ref('')
const incidents = ref('')

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
