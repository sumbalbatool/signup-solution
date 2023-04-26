<template>
  <div>
    <h1>Posts</h1>
    <div v-if="isLoading">Loading...</div>
    <div v-else>
      <table class="table table-light">
        <thead>
        <tr>
          <th scope="col">#</th>
          <th scope="col">Title</th>
          <th scope="col">Description</th>
          <th scope="col">Comment</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="post in posts" :key="post.id">
          <td>{{ post.id }}</td>
          <td>{{ post.title }}</td>
          <td>{{ post.description }}</td>
          <td>{{ post?.comments[0]?.comment }}{{ post?.comments[0]?.post_id }}</td>

        </tr>
        </tbody>
      </table>
    </div>
  </div>
</template>

<script>
import Post from './Post.vue';
import axios from 'axios';

export default {
  name: 'ShowAllPosts',
  components: {
    Post,
  },
  data() {
    return {
      posts: [],
      isLoading: true,
    };
  },
  methods: {
    fetchPosts() {
      axios
          .get(`http://127.0.0.1:8000/api/posts`)
          .then(response => {
            this.posts = response.data?.data;
            console.log(this.posts.comments)
          })
          .finally(() => {
            this.isLoading = false;
          });
    },
  },
  mounted() {
    this.fetchPosts();
  },
};
</script>
