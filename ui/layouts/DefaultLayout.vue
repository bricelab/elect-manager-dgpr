<template>
  <v-app theme="light">

    <v-app-bar
        color="purple"
        prominent
    >
<!--      <template v-slot:prepend>-->
<!--        <v-app-bar-nav-icon></v-app-bar-nav-icon>-->
<!--      </template>-->
      <v-app-bar-title class="text-uppercase text-center text-h4">
        Elect Manager
      </v-app-bar-title>

<!--      <template v-slot:append>-->
<!--        <v-btn icon="mdi-dots-vertical"></v-btn>-->
<!--      </template>-->
    </v-app-bar>

    <v-main>
      <v-container class="mt-5 mx-auto text-center" v-if="!userStore.isInitialized" style="margin-top: 100px!important;">
        <v-progress-circular
            :size="70"
            :width="7"
            color="purple"
            indeterminate
        ></v-progress-circular>
      </v-container>
      <router-view v-else />
    </v-main>
  </v-app>
</template>

<script setup>
import {useUserStore} from '@/stores/user/user-store'

const userStore = useUserStore()

userStore.initialize()

console.log(userStore.fullName)
</script>

<style scoped>
</style>
