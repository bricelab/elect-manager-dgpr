<template>
  <v-app-bar
      color="purple"
      prominent
  >
    <v-app-bar-title class="text-uppercase text-center text-h5">
      Elect Manager
    </v-app-bar-title>

    <v-menu v-if="isConnectedUserPage">
      <template v-slot:activator="{ props }">
        <v-btn icon="mdi-dots-vertical" v-bind="props" color="purple"></v-btn>
      </template>

      <v-list color="purple" class="bg-purple mt-3">
        <v-list-item>
          <v-list-item-title>
            <a href="/logout">Se déconnecter</a>
          </v-list-item-title>
        </v-list-item>
      </v-list>
    </v-menu>

  </v-app-bar>
</template>

<script setup>
defineProps({
  isConnectedUserPage: {
    type: Boolean,
    required: true,
  }
})
</script>

<style scoped>
</style>
