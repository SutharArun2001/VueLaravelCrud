<template>
    <div class="main-container">
        <div class="main-header">
            <Header />
        </div>
        <div class="main-body">
            <div class="main-sidebar">
                <Sidebar />
            </div>
            <TransitionGroup name="fadee" tag="div">
                <div class="main-content">
                    <router-view></router-view>
                </div>
            </TransitionGroup>
        </div>
    </div>
</template>
  
<script setup>
import Header from './components/layout/Header.vue';
import Sidebar from './components/layout/sidebar.vue';
</script>
  
<style scoped>


.fadee-enter-active,
.fadee-leave-active {
    transition: all 0.5s ease;
}

.fadee-enter-from,
.fadee-leave-to {
    opacity: 0;
}
.main-container {
    display: flex;
    flex-direction: column;
    height: 100vh;
}


/* --------- Non-flexbox related styles --------- */
.main-header {
    display: flex;
    align-items: center;
    justify-content: flex-end;
    padding: 10px;
    border-bottom: 1px solid #cccccc;
}

.main-body {
    display: flex;
    flex-grow: 1;
}

.main-content {
    flex-grow: 1;
}

</style>
  
  