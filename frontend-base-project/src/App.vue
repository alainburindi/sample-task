<template>
  <div class="bg-blue-900 min-h-screen text-white">
    <nav class="bg-red-900 py-4">
      <div class="container mx-auto flex justify-between">
        <router-link to="/rooms" class="text-lg">Rooms</router-link>
        <router-link to="/guests" class="text-lg">Guests</router-link>
      </div>
    </nav>
    <main class="container mx-auto py-8">
      <router-view></router-view>
    </main>
  </div>
</template>

<script lang="ts">
import { defineComponent } from 'vue';

export default defineComponent({});
</script>

<style scoped>
.container {
  max-width: 1200px;
}
</style>
