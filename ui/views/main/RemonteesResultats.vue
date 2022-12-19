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
            Remontée de résultats du scrutin
          </div>
        </v-col>
        <v-col cols="12">
<!--          <v-select-->
<!--              label="Centre de vote"-->
<!--              clearable-->
<!--              clear-icon="mdi-close-circle"-->
<!--              :items="centresVote"-->
<!--              type="object"-->
<!--              item-title="nom"-->
<!--              item-value="id"-->
<!--              variant="underlined"-->
<!--              v-model="centreVote"-->
<!--              @update:modelValue="updatePosteVoteValues"-->
<!--              single-line-->
<!--          ></v-select>-->
          <v-autocomplete

              label="Centre de vote"
              clearable
              clear-icon="mdi-close-circle"
              :items="centresVote"
              type="object"
              item-title="nom"
              item-value="id"
              variant="underlined"
              v-model="centreVote"
              @update:modelValue="updatePosteVoteValues"
          ></v-autocomplete>

          <v-select
              label="Poste de vote"
              clearable
              clear-icon="mdi-close-circle"
              :items="postesVote"
              type="object"
              item-title="nom"
              item-value="id"
              variant="underlined"
              v-model="posteVote"
          ></v-select>

          <v-text-field
              label="Nombre d'inscrits"
              type="number"
              v-model="inscrits"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="Nombre de votants"
              type="number"
              v-model="votants"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <v-text-field
              label="Bulletins nuls"
              type="number"
              v-model="nuls"
              clearable
              clear-icon="mdi-close-circle"
              variant="underlined"
          ></v-text-field>

          <h1 class="text-h5 text-purple mt-3 mb-3">Suffrages obtenus</h1>

          <v-row
              v-for="c in userStore.sortedCandidats"
              :key="c.id"
              class="mt-5"
          >
            <v-col cols="4">
              <v-img
                  :src="`/uploads/candidats/logos/${c.logo}`"
                  aspect-ratio="1"
                  cover
                  style="height: 100px; width: 100px;"
              ></v-img>
            </v-col>
            <v-col cols="8">
              <v-text-field
                  :label="c.sigle"
                  type="number"
                  v-model="suffrages[c.id]"
                  clearable
                  clear-icon="mdi-close-circle"
                  variant="underlined"
              ></v-text-field>
            </v-col>
          </v-row>
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
import {onMounted, ref} from 'vue'
import {useRouter} from 'vue-router'
import {useAlertStore} from '@/stores/alert-store'
import {useUserStore} from '@/stores/user-store'
import {remonterResultats} from "@/services/scrutin-services";

const router = useRouter()
const alertStore = useAlertStore()
const userStore = useUserStore()

alertStore.reset()

onMounted(() => {
  if (userStore.arrondissementPostesRestant < 1) {
    back()
  }
})

const centresVote = ref([])
const postesVote = ref([])
centresVote.value = userStore.centresVote.filter((cv) => {
  return  userStore.postesVote.filter((pv) => {
    return pv.centreVote.id === cv.id && !pv.estRemonte
  }).length > 0
})

const centreVote = ref('')
const posteVote = ref('')
const inscrits = ref('')
const votants = ref('')
const nuls = ref('')

const suffrages = ref([])

const form = ref()
const loading = ref(false)
const valid = ref(false)
const rules = [v => v.length >= 3 || 'Minimum 03 caractères']

const updatePosteVoteValues = () => {
  postesVote.value = userStore.postesVote.filter(pv => !pv.estRemonte && pv.centreVote.id === centreVote.value)
}
const back = () => {
  router.back()
}
const validate = async () => {
  valid.value = await form.value.validate()

  if (valid.value) {
    try {
      await remonterResultats({
        posteVote: posteVote.value,
        inscrits: inscrits.value,
        votants: votants.value,
        nuls: nuls.value,
        suffrages: suffrages.value,
      })
      await userStore.initialize()
      alertStore.type = 'success'
      alertStore.title = 'Succès'
      alertStore.message = 'Informations soumises avec succès !'
    } catch (e) {
      // console.log(e.response.data.detail, e.response)
      alertStore.type = 'error'
      alertStore.title = 'Erreur'
      alertStore.message = `${e.response.data}. Veuillez vérifier svp !`
    }
    alertStore.show = true
    loading.value = false
    back()
  }
}
</script>

<style scoped>

</style>
