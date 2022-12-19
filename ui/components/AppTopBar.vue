<template>
  <v-app-bar
      color="purple"
      prominent
  >
    <v-app-bar-title class="text-uppercase">
      Elect Manager
    </v-app-bar-title>

<!--    <v-spacer></v-spacer>-->

<!--    <v-avatar color="purple">-->
<!--      <v-icon icon="mdi-account-circle"></v-icon>-->
<!--    </v-avatar>-->
<!--    <h5 class="text-subtitle-2 ml-1">{{ userStore.fullName }}</h5>-->

    <v-menu v-if="isConnectedUserPage">
      <template v-slot:activator="{ props }">
<!--        <v-btn icon="mdi-dots-vertical" v-bind="props" color="purple"></v-btn>-->
<!--        <v-avatar color="purple" v-bind="props" id="logout__menu" class="mr-2">-->
<!--          <v-icon icon="mdi-account-circle"></v-icon>-->
<!--        </v-avatar>-->
        <a href="/logout" class="mr-3">
          <v-icon icon="mdi-logout"></v-icon>
        </a>
      </template>

<!--      <v-list color="purple" class="bg-purple mt-3">-->
<!--        <v-list-item>-->
<!--          <v-list-item-title>-->
<!--            <a href="/logout">-->
<!--              <v-icon icon="mdi-logout"></v-icon>-->
<!--              Se déconnecter-->
<!--            </a>-->
<!--          </v-list-item-title>-->
<!--        </v-list-item>-->
<!--      </v-list>-->
    </v-menu>

  </v-app-bar>
</template>

<script setup>
// import {useUserStore} from '@/stores/user-store'

// const userStore = useUserStore()

defineProps({
  isConnectedUserPage: {
    type: Boolean,
    required: true,
  }
})
</script>

<style scoped>
#logout__menu {
  cursor: pointer;
}
</style>
