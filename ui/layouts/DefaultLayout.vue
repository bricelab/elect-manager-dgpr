<template>
  <v-app theme="light">

    <AppTopBar :is-connected-user-page="true" />

    <v-main>
      <LoadingPage v-if="!userStore.isInitialized" />
      <router-view v-else />
    </v-main>
  </v-app>
</template>

<script setup>
import {useUserStore} from '@/stores/user/user-store'
import LoadingPage from '@/components/LoadingPage.vue'
import AppTopBar from '@/components/AppTopBar.vue'

const userStore = useUserStore()

userStore.initialize()
</script>

<style scoped>
</style>
