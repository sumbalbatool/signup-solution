<template>
  <div class="container-fluid">
    <h2>{{ post.title }}</h2>
    <p>{{ post.description }}</p>
    <button type="button" @click="showComments = !showComments">
      {{ showComments ? 'Hide' : 'Show' }} comments
    </button>
    <div v-if="showComments">
      <ul>
        <li v-for="comment in comments" :key="comment.id">
          <p>{{ comment.post_id }}</p>
          <h3>{{ comment.comment }}</h3>
        </li>
      </ul>
    </div>
  </div>
</template>

<script>
import axios from "axios";

export default {
  name: 'Comment',
  props: ['post'],
  data() {
    return {
      comments: [],
      showComments: false,
    };
  },
  methods: {
    fetchComments() {
      axios
          .get(`http://127.0.0.1:8000/api/comments`)
          .then(response => {
            this.comments = response.data;
            console.log(this.comments)
          })
          .catch(error => {
            console.error(error);
          });
    },
  },
  mounted() {
    this.fetchComments();
  },
};
</script>
