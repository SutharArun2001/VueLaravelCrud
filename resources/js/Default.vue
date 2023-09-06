<template>
    <div class="main-header">
        <Header />
    </div>
    <RouterView></RouterView>
</template>

<script setup>
import { RouterView } from 'vue-router';
import Header from './components/layout/Header.vue';
</script>

<style scoped>
 /* --------- Non-flexbox related styles --------- */
 .main-header {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 10px;
    border-bottom: 1px solid #cccccc;
  }
</style>