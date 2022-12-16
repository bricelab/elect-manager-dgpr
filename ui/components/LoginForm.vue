<template>
  <v-form
      v-model="form"
      method="post"
  >
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
        variant="flat"
    >
      Se connecter
    </v-btn>
  </v-form>
</template>

<script setup>
import {ref} from 'vue'

const form = ref(false)
const email = ref(window.lastUsername)

const required = (v) => !!v || 'Ce champ est obligatoire.'
</script>

<style scoped>

</style>
