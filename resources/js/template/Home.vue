<template>
  <h1>Mouse Tracker</h1>
  <keepAlive>
    <MouseTracker v-slot="{x, y}">
      Mouse at :- {{ x }} {{ y }} 
    </MouseTracker>
  </keepAlive>
</template>
<script setup>
import MouseTracker from '../components/layout/widget/MouseTracker.vue';

</script>