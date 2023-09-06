<template>
  <h2 class="py-2">Mouse Tracker</h2>
  <keepAlive>
    <MouseTracker v-slot="{x, y}">
      Mouse at :- {{ x }} {{ y }} 
    </MouseTracker>
  </keepAlive>
</template>
<script setup>
import { onMounted } from 'vue';
import MouseTracker from '../components/layout/widget/MouseTracker.vue';
import { useAuthStore } from '../composable/auth';
const authStore = useAuthStore();
onMounted(async () => {
    await authStore.getUser();
});

</script>