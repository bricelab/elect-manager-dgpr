<template>
  <v-container>
    <v-row dense>
      <v-col cols="12">
        <v-card theme="light">
          <v-card-title class="text-h5">
            Rapport d'ouverture
          </v-card-title>

          <v-card-text>Envoyer le rapport d'ouverture du scrutin au niveau de votre arrondissement.</v-card-text>

          <v-card-actions>
            <v-btn
                variant="flat"
                color="purple"
                append-icon="mdi-send"
                elevation="2"
                @click.stop.prevent="startOpenReport"
                class="mb-3"
            >
              Envoyer maintenant
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>

      <v-col cols="12">
        <v-card theme="light">
          <v-card-title class="text-h5">
            Incidents
          </v-card-title>

          <v-card-text>Signaler tout au long du scrutin un incident.</v-card-text>

          <v-card-actions >
            <v-btn
                variant="flat"
                color="purple"
                append-icon="mdi-send"
                elevation="2"
                @click.stop.prevent="startIncidentReport"
                class="mb-3"
            >
              Signaler un incident
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>

      <v-col cols="12">
        <v-card theme="light">
          <v-card-title class="text-h5">
            Remontée des résultats
          </v-card-title>

          <v-card-text>Remonter les résultats issus du dépouillement au niveau des postes de vote.</v-card-text>

          <v-card-actions >
            <v-btn
                variant="flat"
                color="purple"
                append-icon="mdi-send"
                elevation="2"
                @click.stop.prevent="startResultReport"
                class="mb-3"
            >
              Remonter maintenant
            </v-btn>
          </v-card-actions>
        </v-card>
      </v-col>

    </v-row>
  </v-container>
</template>

<script setup>
import {useRouter} from 'vue-router'

const router = useRouter()

const startOpenReport = () => {
  router.push('/rapport-d-ouverture')
}
const startIncidentReport = () => {
  router.push('/rapport-d-incident')
}
const startResultReport = () => {
  router.push('/remontees-resultats')
}
</script>

<style scoped>

</style>
