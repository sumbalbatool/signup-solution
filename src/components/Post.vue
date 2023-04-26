<template>
  <div class="container-fluid">
    <div class="row mb-0 pb-0 g-0">
      <div class=" d-flex p-sm-5 p-4">
        <div class="w-100">
          <div class="d-flex flex-column h-100">
            <div class="my-auto">
              <div class="text-center">
                <h5 class="mb-0">Create Post</h5>
              </div>
              <form class="custom-form mt-4 pt-2">
                <div class="mb-3">
                  <label class="form-label">Title</label>
                  <input type="text" class="form-control" id="title" placeholder="Enter title" v-model="title" autocomplete="title">
                </div>
                <div class="mb-3">
                  <label class="form-label">Description</label>
                  <textarea type="text" class="form-control" id="description" placeholder="Enter Description" v-model="description"></textarea>
                </div>
                <div class="mb-3">
                  <label class="form-label">Image</label><br>
                  <input type="file" id="image" class="photo" @change="onImageChange">
                </div>
                <button type="button" class="btn btn-primary text-white" @click="createPost">Post</button>
              </form>
              <p v-if="error" class="text-danger">{{ error }}</p>
              <p v-if="success">{{ success }}</p>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from 'axios';

export default {
  name: 'Post',
  data() {
    return {
      title: '',
      description: '',
      error: '',
      success: '',
    };
  },
  methods: {
    onImageChange(event) {
      this.image = event.target.files[0];
    },
    createPost() {
      this.error = "";
      this.success = '';
      const formData = new FormData();
      formData.append('title', this.title);
      formData.append('description', this.description);
      formData.append('image', this.image);

      axios
          .post(`http://127.0.0.1:8000/api/posts`, formData)
          .then(response => {
            this.success = response.data.message;
            this.title = '';
            this.description = '';
            this.image = '';
          })
          .catch(error => {
            this.success = '';
            this.error = error.response.data.message;
          });
    },
  },
};
</script>
