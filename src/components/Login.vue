<template>
  <div class="container-fluid ">
    <div class="row mb-0 pb-0 g-0">
      <div class=" d-flex p-sm-5 p-4">
        <div class="w-100">
          <div class="d-flex flex-column h-100">
            <div class="my-auto">
              <div class="text-center">
                <h5 class="mb-0">Welcome Back !</h5>
                <p class="text-muted mt-2">Login in to continue.</p>
              </div>
              <form class="custom-form mt-4 pt-2">
                <div class="mb-3">
                  <label class="form-label">email</label>
                  <input type="text" class="form-control" id="email" placeholder="Enter email" v-model="email" autocomplete="email">
                </div>
                <div class="mb-3">
                  <label class="form-label">Password</label>
                  <input type="password" class="form-control" id="password" placeholder="Enter Password" v-model="password">
                </div>
                <button type="button" class="btn btn-success text-white" @click="login">Login</button>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
    <p v-if="error" class="text-danger">{{ error }}</p>
    <p v-if="success">{{ success }}</p>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Login',
  data() {
    return {
      email: '',
      password: '',
      success: '',
      error: '',
    };
  },
  //methods call in method apis are calling
  methods: {
    login() {
      axios.post(`http://127.0.0.1:8000/api/login`, {
        email: this.email,
        password: this.password,
      }).then(response => {
        // Handle successful login here
        this.success = response.data?.message;
        setTimeout(() => {
          this.$route.push('/post');
        }, 1000);
      })
          .catch(error => {
            //handle error message here
            this.error = error.response.data.message;
          });
    },
  },
};
</script>
