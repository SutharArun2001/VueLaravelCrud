<template>
  <div class="container">
    <div class="title">Sign Up</div>
    <form action="#">
      <div class="user_details">
        <div class="input_pox">
          <span class="datails" >First Name</span>
          <input type="text" placeholder="enter your name" v-model="user.firstName">
          <span class="error">{{ error.firstName }}</span>
        </div>
        <div class="input_pox">
          <span class="datails">Last Name</span>
          <input type="text" placeholder="enter your name" v-model="user.lastName">
          <span class="error">{{ error.lastName }}</span>
        </div>
        <div class="input_pox">
          <span class="datails">Username</span>
          <input type="text" placeholder="enter your Username" v-model="user.userName">
          <span class="error">{{ error.userName }}</span>
        </div>
        <div class="input_pox">
          <span class="datails">Email</span>
          <input type="text" placeholder="enter your Email" v-model="user.email">
          <span class="error">{{ error.email }}</span>
        </div>
        <div class="input_pox">
          <span class="datails">Phone Number</span>
          <input type="text" placeholder="enter your Phone" v-model="user.phoneNumber">
          <span class="error">{{ error.phoneNumber }}</span>
        </div>
        <div class="input_pox">
          <input type="radio" name="gender" id="dot-1" value="male" v-model="user.gender">
          <input type="radio" name="gender" id="dot-2" value="female" v-model="user.gender">
          <input type="radio" name="gender" id="dot-3" value="other" v-model="user.gender">
          <span class="gender_title"> Gender</span>
          <div class="category">
            <label for="dot-1">
              <span class="dot one"></span>
              <span class="gender">Male</span>
            </label>
            <label for="dot-2">
              <span class="dot two"></span>
              <span class="gender">Female</span>
            </label>
            <label for="dot-3">
              <span class="dot three"></span>
              <span class="gender">Other</span>
            </label>
          </div>
          <span class="error">{{ error.gender }}</span>
        </div>
        <div class="input_pox">
          <span class="datails">Password</span>
          <input type="text" placeholder="enter your Password" v-model="user.passWord">
          <span class="error">{{ error.passWord }}</span>
        </div>
        <div class="input_pox">
          <span class="datails">Confirm Password</span>
          <input type="text" placeholder="Confirm your Password" v-model="user.confirmPassWord">
          <span class="error">{{ error.confirmPassWord }}</span>
        </div>
      </div>
      <ButtonComponent @submit-form="signup">
        Sign Up
      </ButtonComponent>
    </form>
  </div>
</template>

<script setup>
import ButtonComponent from '../components/layout/widget/Button.vue';
import axios from "axios";

const user = {
  firstName : '',
  lastName : '',
  userName : '',
  email : '',
  phoneNumber : '',
  gender : '',
  passWord : '',
  confirmPassWord : ''
}

const error = {
  firstName : '',
  lastName : '',
  userName : '',
  email : '',
  phoneNumber : '',
  gender : '',
  passWord : '',
  confirmPassWord : '',
}

function validation() {
  return true;
}
function signup() {
  const checkValidation = validation();
  if(!checkValidation) return;
  var newUser = user;
  axios.post('api/user/create')
    .then(function () {
      console.log('success');
    })
    .catch(function () {
      console.log('error');
    });
}
</script>
<style scoped>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
    font-family: 'Poppins', sans-serif;
  }

  .container {
    max-width: 700px;
    width: 100%;
    background: #fff;
    padding: 25px 30px;
    border-radius: 5px;
  }

  .container .title {
    font-size: 25px;
    font-weight: 500;
    position: relative;
  }

  .container form .user_details {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
  }

  form .user_details .input_pox {
    margin-bottom: 15px;
    margin: 20px 0 12px 0;
    width: calc(100% / 2 - 20px);
  }

  .user_details .input_pox .datails {
    display: block;
    font-weight: 500;
    margin-bottom: 5px;
  }

  .user_details .input_pox input {
    height: 45px;
    width: 100%;
    outline: none;
    border-radius: 5px;
    border: 1px solid #ccc;
    padding-left: 15px;
    font-size: 16px;
    border-bottom-width: 2px;
    transition: all 0.3s ease;

  }

  .user_details .input_pox input:focus,
  .user_details .input_pox input:valid {
    border-color: #9b59b6;
  }

  form .input_pox .gender_title {
    font-size: 20px;
    font-weight: 500;
  }

  form .input_pox .category {
    display: flex;
    width: 80%;
    margin: 14px 0;
    justify-content: space-between;
  }
  .error {
    color: red;
  }

  .input_pox .category label {
    display: flex;
  }

  .input_pox .category .dot {
    height: 18px;
    width: 18px;
    background: #d9d9d9;
    border-radius: 50%;
    margin-right: 10px;
    border: 5px solid transparent;
  }

  #dot-1:checked~.category label .one,
  #dot-2:checked~.category label .two,
  #dot-3:checked~.category label .three {
    border-color: #d9d9d9;
    background-color: #9b59b6;
  }

  form input[type="radio"] {
    display: none;
  }

  form .button {
    height: 45px;
    margin: 45px 0;
  }

  form .button input {
    height: 100%;
    width: 100%;
    outline: none;
    color: #fff;
    border: none;
    font-size: 18px;
    font-weight: 500;
    border-radius: 5px;
    letter-spacing: 1px;
    background: linear-gradient(123deg, #71b8e7, #9b59b6);

  }

  form .button input :hover {
    background: linear-gradient(-123deg, #71b8e7, #9b59b6);
  }

  @media (max-width: 584px) {
    .container {
      max-width: 100%;
    }

    form .user_details .input_pox {
      margin-bottom: 15px;
      width: 100%;
    }

    form .input_pox .category {
      width: 100%;
    }

    .container form .user_details {
      max-height: 300px;
      overflow: scroll;
    }

    .user_details::-webkit-scrollber {
      width: 0;
    }
  }
</style>