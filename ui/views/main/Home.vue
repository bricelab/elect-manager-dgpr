<template>
  <v-container>
    <v-row dense>
      <v-col cols="12">
        <h3 class="text-subtitle-2 text-purple">
          Arrondissement de <span class="fw-bold">{{ userStore.arrondissementName }}</span>
        </h3>
      </v-col>
      <v-col cols="12">
        <h1 class="text-h3 text-purple mt-5 mb-2">
          Bienvenue {{ userStore.fullName }}
        </h1>
      </v-col>

      <v-col cols="12" class="mt-5" v-if="alertStore.show">
        <v-alert :type="alertStore.type" :title="alertStore.title" closable>{{ alertStore.message }}</v-alert>
      </v-col>

      <v-col cols="12" class="mt-3 mb-3">
        <v-card theme="light">
          <v-card-text>
            <div v-if="userStore.rapportOuvertureRempli" class="mb-3">
              <b>Rapport d'ouverture :</b>
              <span>
                <v-badge
                    color="success"
                    content="envoyé"
                    inline
                ></v-badge>
              </span>
            </div>
            <div class="mb-3">
              <b>Incidents déclarés :</b>
              <span>
                <v-badge
                    :color="userStore.arrondissementIncidentsSignales > 0 ? 'error' : 'success'"
                    :content="userStore.arrondissementIncidentsSignales"
                    inline
                ></v-badge>
              </span>
            </div>
            <div class="mb-3">
              <b>Total centres de vote :</b>
              <span>
                <v-badge
                    color="info"
                    :content="userStore.arrondissementCentresTotal"
                    inline
                ></v-badge>
              </span>
            </div>
            <div class="mb-3">
              <b>Centres de vote restants :</b>
              <span>
                <v-badge
                    :color="userStore.arrondissementCentresRestant > 0 ? 'warning' : 'success'"
                    :content="userStore.arrondissementCentresRestant"
                    inline
                ></v-badge>
              </span>
            </div>
            <div class="mb-3">
              <b>Total postes de vote :</b>
              <span>
                <v-badge
                    color="info"
                    :content="userStore.arrondissementPostesTotal"
                    inline
                ></v-badge>
              </span>
            </div>
            <div class="mb-3">
              <b>Postes de vote restants :</b>
              <span>
                <v-badge
                    :color="userStore.arrondissementPostesRestant > 0 ? 'warning' : 'success'"
                    :content="userStore.arrondissementPostesRestant"
                    inline
                ></v-badge>
              </span>
            </div>
            <div class="mb-3">
              <b>Postes de vote remontés :</b>
              <span>
                <v-badge
                    color="success"
                    :content="userStore.arrondissementPostesRemontes"
                    inline
                ></v-badge>
              </span>
            </div>
          </v-card-text>
        </v-card>
      </v-col>

      <v-col cols="12" class="mb-3" v-if="!userStore.rapportOuvertureRempli">
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

      <v-col cols="12" class="mb-3">
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

      <v-col cols="12" class="mb-3" v-if="userStore.arrondissementPostesRestant > 0">
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
import {useAlertStore} from '@/stores/alert-store'
import {useUserStore} from '@/stores/user-store'

const router = useRouter()
const alertStore = useAlertStore()
const userStore = useUserStore()

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
