<template>
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-6">
          <h2>Value from state -> {{ test }}</h2>
        </div>
      </div>
      <div class="row">
        <div class="col-md-6">
          <h2>Post Lists</h2>
        </div>
        <div class="col-md-6 d-flex justify-content-end">
          <router-link
            to="/post-create"
            class="btn btn-success float-right d-none d-md-block active"
          >
            Add Post
            <i class="fa fa-plus fa-lg"></i>
          </router-link>
        </div>
      </div>
    </div>
    <div class="card-body">
      <table class="table table-responsive-sm table-hover table-outline mb-0">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Status</th>
            <th scope="col">Posted User</th>
            <th scope="col">Posted Date</th>
            <th class="text-center">Actions</th>
          </tr>
        </thead>
        <tbody v-for="post in posts.data" :key="post.id">
          <tr v-if="post.status == 1">
            <td>
              <strong>{{ post.title }}</strong>
            </td>
            <td>
              <strong>{{ post.description }}</strong>
            </td>
            <td>
              <strong>{{ post.status }}</strong>
            </td>
            <td>
              <strong>{{ post.create_user_id }}</strong>
            </td>
            <td>
              <strong>{{ post.created_at.split('T')[0] }}</strong>
            </td>
            <td class="text-center">
              <button
                class="btn btn-sm btn-primary"
                @click="viewPostModal(post.title,post.description,post.created_at)"
              >
                View
                <i class="fa fa-eye"></i>
              </button>
              <button class="btn btn-sm btn-primary">
                Edit
                <i class="fa fa-edit"></i>
              </button>
              <button class="btn btn-sm btn-danger active" @click="showDeleteModal(post.id)">
                Delete
                <i class="fa fa-trash"></i>
              </button>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    <div class="modal" id="delete-post" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title">
              <strong>Are you sure you want to delete ?</strong>
            </h5>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            <button type="button" class="btn btn-success" @click="deletePost()">Delete</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Modal -->
    <div class="modal" id="view-post" tabindex="-1">
      <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-primary text-center w-100">
              <strong>Post Details</strong>
            </h5>
            <button type="button" class="close text-danger" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form>
            <div class="modal-body">
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Post Title</label>
                <div class="col-sm-8 col-lg-6">
                  <input
                    type="text"
                    readonly
                    class="form-control-plaintext"
                    name="title"
                    id="title"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Post Description</label>
                <div class="col-sm-8 col-lg-6">
                  <input
                    type="text"
                    readonly
                    class="form-control-plaintext"
                    name="description"
                    id="description"
                  />
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label">Posted Date</label>
                <div class="col-sm-8 col-lg-6">
                  <input
                    type="text"
                    readonly
                    class="form-control-plaintext"
                    name="post_date"
                    id="post_date"
                  />
                </div>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>

    <div class="d-flex justify-content-center">
      <!-- <pagination :data="posts" @pagination-change-page="getPostList">
        <span slot="prev-nav">&lt; Previous</span>
        <span slot="next-nav">Next &gt;</span>
      </pagination>-->
      <pagination :data="posts" @pagination-change-page="getPostList"></pagination>
    </div>
  </div>
</template>

<script>
const postModule = "PostsModule";
export default {
  data() {
    return {
      posts: {},
      deletePostID: -1,
      form: new Form({
        id: "",
        category: "",
        name: "",
        description: "",
        tags: [],
        photo: "",
        category_id: "",
        price: "",
        photoUrl: "",
      }),
    };
  },
  mounted() {
    console.log(this.$store.state[postModule].title);
    this.getPostList();
  },
  computed: {
    test() {
        return this.$store.state[postModule].title;
    }
  },
  methods: {
    getPostList(page = 1) {
      console.log("get post list method");
      axios
        .get("/api/posts?page=" + page)
        .then((response) => {
          this.posts = response["data"];
          console.log("RESPONSE :: Show Post -> ", response["data"]);
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
        });
    },
    viewPostModal(title, description, created_at) {
      $("#view-post").modal("show");
      var modal = $(this);
      modal.find("#title").val(title);
      modal.find("#post_date").val(post_date);
      modal.find("#description").val(description);
    },
    showDeleteModal(id) {
      $("#delete-post").modal("show");
      this.deletePostID = id;
      console.log("Post id is ", id);
    },
    deletePost() {
      $("#delete-post").modal("hide");
      axios
        .delete("/api/posts/" + this.deletePostID)
        .then((response) => {
          console.log("Successfully Deleted", response);
          this.getPostList();
          this.$emit("sendingInfo", "Successfully Deleted");
        })
        .catch((error) => {
          console.log("Delete ERROR :: ", error);
        });
    },
  },
};
</script>
