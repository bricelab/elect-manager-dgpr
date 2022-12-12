<template>
  <v-app theme="light">

    <v-app-bar
        color="purple"
        prominent
    >
<!--      <template v-slot:prepend>-->
<!--        <v-app-bar-nav-icon></v-app-bar-nav-icon>-->
<!--      </template>-->
      <v-app-bar-title class="text-uppercase">
        Elect Manager
      </v-app-bar-title>

<!--      <template v-slot:append>-->
<!--        <v-btn icon="mdi-dots-vertical"></v-btn>-->
<!--      </template>-->
    </v-app-bar>

    <v-main>
      <router-view />
    </v-main>
  </v-app>
</template>

<script setup>
</script>

<style scoped>
</style>
