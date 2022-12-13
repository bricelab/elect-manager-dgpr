<template>
  <v-container>
    <v-card class="mx-auto px-6 py-8" max-width="344">
      <v-form
          v-model="form"
          @submit.prevent="onSubmit"
      >
        <v-text-field
            class="mb-2"
            clearable
            label="Email"
        ></v-text-field>

        <v-text-field
            clearable
            label="Password"
            placeholder="Enter your password"
        ></v-text-field>

        <br>

        <v-btn
            block
            color="success"
            size="large"
            type="submit"
            variant="elevated"
        >
          Sign In
        </v-btn>
      </v-form>
    </v-card>
  </v-container>
</template>

<script setup>
</script>

<style scoped>

</style>
