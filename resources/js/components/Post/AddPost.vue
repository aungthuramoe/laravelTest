<template>
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 offset-sm-2">
          <div>
            <h2>Create Post</h2>
            <form @submit.prevent="handleSubmit">
              <div class="form-group">
                <label for="title">Post Title</label>
                <input
                  type="text"
                  v-model="post.title"
                  id="title"
                  name="title"
                  class="form-control"
                  :class="{ 'is-invalid': submitted && $v.post.title.$error }"
                />
                <div
                  v-if="submitted && !$v.post.title.required"
                  class="invalid-feedback"
                >Post title is required</div>
              </div>
              <div class="form-group">
                <label for="description">Post Description</label>
                <textarea
                  class="form-control"
                  id="description"
                  name="description"
                  rows="5"
                  v-model="post.description"
                  :class="{ 'is-invalid': submitted && $v.post.description.$error }"
                ></textarea>
                <div
                  v-if="submitted && !$v.post.description.required"
                  class="invalid-feedback"
                >Post description is required</div>
              </div>
              <div class="form-group">
                <button type="reset" class="col-md-3 btn btn-dark">Clear</button>
                <button class="col-md-3 btn btn-success active">Confirm</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
import { required, minLength, maxLength } from "vuelidate/lib/validators";
const postModule = "PostsModule";
export default {
  data() {
    return {
      post: {
        title: "",
        description: "",
      },
      submitted: false,
    };
  },
  validations: {
    post: {
      title: { required },
      description: { required, maxLength: maxLength(200) },
    },
  },
  mounted() {
    console.log(" add post is mounted ");
    if (this.$store.state[postModule].post.title !== undefined) {
      this.post.title = this.$store.state[postModule].post.title;
      this.post.description = this.$store.state[postModule].post.description;
    }
  },
  methods: {
    handleSubmit(e) {
      this.submitted = true;
      // stop here if form is invalid
      this.$v.$touch();
      if (this.$v.$invalid) {
        return;
      }
      this.$store.dispatch("addPost", this.post);
    },
  },
};
</script>