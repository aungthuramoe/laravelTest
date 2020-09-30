<template>
  <div class="jumbotron">
    <div class="container">
      <div class="row">
        <div class="col-sm-8 offset-sm-2">
          <div class="mb-4">
            <h2>Create Post Confirm</h2>
          </div>
          <div>
            <form @submit.prevent="createPost()">
              <div class="form-group row">
                <label class="col-md-3 col-form-label">Post Title</label>
                <div class="col-md-6">
                  <input
                    type="text"
                    readonly
                    class="form-control-plaintext bg-light pl-2"
                    name="title"
                    v-model="title"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label for="description" class="col-md-3 col-form-label"
                  >Post Description</label
                >
                <div class="col-md-6">
                  <textarea
                    class="form-control bg-light"
                    id="description"
                    name="description"
                    rows="3"
                    disabled
                    v-model="description"
                  ></textarea>
                </div>
              </div>
              <div class="form-group">
                <button class="col-md-3 btn btn-success active">
                  Create Post
                </button>
              </div>
            </form>
            <button @click="cancelPost()" class="col-md-3 btn btn-dark">
              Cancel Post
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      post: {
        title: "",
        description: "",
      },
    };
  },
  mounted() {
    console.log("Confirm is mounted");
  },
  computed: {
    title() {
      return this.$store.state.PostsModule.post.title;
    },
    description() {
      return this.$store.state.PostsModule.post.description;
    },
  },
  methods: {
    createPost() {
      const post = {
        title: this.title,
        description: this.description,
      };
      axios
        .post("/api/posts", post)
        .then((response) => {
          console.log("POST RESPONSE ::: ", response);
          if (response["data"].status == "success") {
            post.title = "";
            post.description = "";
            console.log("empty post", this.post);
            this.$store.dispatch("addPost", this.post);
          }
          this.$router.push({
            name: "posts",
          });
        })
        .catch((error) => {
          console.log("POST ERROR ::: ", error);
          this.$router.push({
            name: "post-create",
          });
        });
    },
    cancelPost() {
      this.$router.back();
    },
  },
};
</script>