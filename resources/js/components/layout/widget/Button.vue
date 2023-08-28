<template>
  <button @click.prevent="$emit('submit-form')" class="btn" :class=classList>
      <slot></slot>
  </button>
</template>
<script setup>
import { inject } from 'vue';

/**
* define component properties
*/
const props = defineProps({
  classList: {
      type: String,
      default: 'ss',
  },
  text: String
});
const username = inject('username', 'Button');

/**
* define emit events in array
*/
defineEmits(['submit-form']);
</script>

<style scoped>
button {
  padding: 10px 20px;
  background-color: #fff;
  border: 2px solid #9b59b6;
  color: #9b59b6;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.4s ease;
  border-radius: 5px;
}

button:hover {
  background-color: #9b59b6;
  color: #fff;
}
</style>