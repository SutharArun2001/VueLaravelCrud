<template>
  <div class="form-container">
    <form class="fr">
      <h1>login</h1>
      <div class="username-container">
        <label for='username'>User Name</label>
        <input type="text" id="username" name="username" class="elem" v-model="userName" @input="setUserName"
          v-focuss="{ color: 'white', text: 'usernameFocus' }">
      </div>
      <div class='password-container'>
        <label for='password'>Password</label>
        <input type="text" id="password" name="password" class="elem" @input="setPassword">
      </div>
      <div class='email-container'>
        <label for='email'>email</label>
        <input :is="keepAlive" type="text" id="email" name="email" class="elem" @input="setemail">
      </div>

      <ButtonComponent @submit-form="onSubmitForm" classList="sign-in" text="Create account">
        Sign In
      </ButtonComponent>

      <Teleport to="#portaler">
        <Transition name="modals">
          <div v-if="open" class="modalss">
            <p>Hello from the modal!</p>
            <button @click="open = false">Close</button>
          </div>
        </Transition>
      </Teleport>
    </form>
  </div>
</template>
<script setup>
import { ref, shallowRef } from 'vue';
import ButtonComponent from '../components/layout/widget/Button.vue';

const userName = ref('');
const passWord = ref('');
const keepAlive = shallowRef('');
const open = ref(false)
const vFocuss = {
  mounted: (el) => {
    el.focus();
  }
};

// provide('username', userName);
// emitted event by child-component
function onSubmitForm() {
  open.value = true;
}

function setUserName(e) {
  userName.value = e.target.value;
}

// check password validation
function setPassword(e) {
  passWord.value = e.target.value;
}

</script>

<style scoped>
.modalss {
  position: fixed;
  padding: 22px 24px;
  border-radius: 8px;
  box-shadow: #cccccc;
  margin-bottom: 1.2em;
  transition: background-color .5s ease;
  background-color: #fff;
  z-index: 999;
  top: 20%;
  left: 50%;
  width: 300px;
  margin-left: -150px;
}

.modalss button {
  background-color: #cccccc;
  transition: background-color .5s;
  padding: 5px 12px;
  border: 1px solid #cccccc;
  border-radius: 8px;
  font-size: .9em;
  font-weight: 600;
}

.modals-enter-active,
.modals-leave-active {
  transition: all 0.5s ease;
}

.modals-enter-from,
.modals-leave-to {
  opacity: 0;
  /* transform: translateY(5px); */
  transform: scale(1.1);
}
</style>