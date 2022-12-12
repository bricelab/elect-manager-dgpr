<template>
  <v-app theme="light">
    <v-app-bar
        color="purple"
        prominent
    >
      <v-app-bar-title class="text-uppercase">
        Elect Manager
      </v-app-bar-title>
    </v-app-bar>

    <v-main>
      <v-card class="mx-auto px-6 py-8 mt-5" max-width="344">
        <v-alert type="error" v-if="isError">{{ error }}</v-alert>
        <v-form
            v-model="form"
            method="post"
        >
<!--        <form>-->
          <v-text-field
              v-model="email"
              :rules="[required]"
              class="mb-2"
              clearable
              label="Adresse email"
              variant="underlined"
              name="_username"
          ></v-text-field>

          <v-text-field
              :rules="[required]"
              clearable
              label="Mot de passe"
              placeholder="Entrez votre mot de passe"
              variant="underlined"
              name="_password"
              type="password"
          ></v-text-field>

          <br>

          <v-btn
              :disabled="!form"
              block
              color="purple"
              size="large"
              type="submit"
              variant="outlined"
          >
            Se connecter
          </v-btn>
        </v-form>
<!--        </form>-->
      </v-card>
    </v-main>
  </v-app>
</template>

<script setup>
import {ref} from 'vue'

const form = ref(false)
const email = ref(window.lastUsername)
const error = ref(null)
const isError = ref(false)

if (window.error) {
  error.value = window.error
  isError.value = true
}

const required = (v) => !!v || 'Field is required'
</script>
