<script setup>
import { inject, onMounted, onUnmounted, ref } from 'vue';

const x = ref(0);
const y = ref(0);
// const user = inject('username','Buuton');


const update = e => {
  x.value = e.pageX;
  y.value = e.pageY;
};

onMounted(() => {
  window.addEventListener('mousemove', update)
});

onUnmounted(() => {
  window.addEventListener('mousemove', update)
});

</script>

<template>
  <!-- {{ user }} -->
  <slot :x="x" :y="y" />
</template>