<template>
  <div>
    <div class="text-center" v-if="length == 0">
      <div class="text-center"><h1>No Post</h1></div>
    </div>
    <div v-else class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-2">
            <input
              class="form-control"
              type="text"
              v-model="search"
              placeholder="Search"
            />
          </div>
          <div>
            <button class="btn btn-primary" @click="searchPost()">
              Search
            </button>
          </div>
          <div v-if="isLogin" class="pl-3">
            <router-link to="/upload" class="btn btn-primary">
              Upload
              <i class="fa fa-upload"></i>
            </router-link>
          </div>
          <div v-if="isLogin" class="pl-3">
            <export-excel
              class="btn btn-primary pl-3"
              :fetch="fetchData"
              name="posts.xls"
            >
              Download
              <i class="fa fa-download"></i>
            </export-excel>
          </div>
          <div v-if="isLogin" class="col">
            <router-link
              to="/post-create"
              class="btn btn-success float-right active"
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
              <th v-if="isLogin" scope="col">Status</th>
              <th scope="col">Posted User</th>
              <th scope="col">Posted Date</th>
              <th v-if="isLogin" class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody v-for="post in posts.data" :key="post.id">
            <tr>
              <td>
                <strong>{{ post.title }}</strong>
              </td>
              <td>
                <strong>{{ post.description }}</strong>
              </td>
              <td v-if="isLogin">
                <strong>{{ post.status }}</strong>
              </td>
              <td>
                <strong>{{ post.create_user_id }}</strong>
              </td>
              <td>
                <strong>{{ post.created_at.split("T")[0] }}</strong>
              </td>
              <td class="text-right" v-if="isLogin && currentUser.type == 1">
                <button
                  class="btn btn-sm btn-primary"
                  v-if="post.create_user_id == currentUser.id"
                  @click="viewPostModal(post, false)"
                >
                  View
                  <i class="fa fa-eye"></i>
                </button>
                <button
                  class="btn btn-sm btn-primary"
                  v-if="post.create_user_id == currentUser.id"
                  @click="viewPostModal(post, true)"
                >
                  Edit
                  <i class="fa fa-edit"></i>
                </button>
                <button
                  v-if="post.create_user_id == currentUser.id"
                  class="btn btn-sm btn-danger active"
                  @click="showDeleteModal(post.id)"
                >
                  Delete
                  <i class="fa fa-trash"></i>
                </button>
              </td>
              <td class="text-right" v-if="isLogin && currentUser.type == 0">
                <button
                  class="btn btn-sm btn-primary"
                  @click="viewPostModal(post, false)"
                >
                  View
                  <i class="fa fa-eye"></i>
                </button>
                <button
                  class="btn btn-sm btn-primary"
                  @click="viewPostModal(post, true)"
                >
                  Edit
                  <i class="fa fa-edit"></i>
                </button>
                <button
                  class="btn btn-sm btn-danger active"
                  @click="showDeleteModal(post.id)"
                >
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
              <button
                type="button"
                class="btn btn-secondary"
                data-dismiss="modal"
              >
                Close
              </button>
              <button
                type="button"
                class="btn btn-success"
                @click="deletePost()"
              >
                Delete
              </button>
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
              <button
                type="button"
                class="close text-danger"
                data-dismiss="modal"
                aria-label="Close"
              >
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form @submit.prevent="updatePost()">
              <div class="modal-body">
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Post Title</label>
                  <div class="col-sm-8 col-lg-6">
                    <input
                      type="text"
                      :readonly="!edit"
                      :class="custom"
                      value="Post Title"
                      name="title"
                      v-model="post.title"
                      id="title"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label"
                    >Post Description</label
                  >
                  <div class="col-sm-8 col-lg-6">
                    <input
                      type="text"
                      :readonly="!edit"
                      :class="custom"
                      v-model="post.description"
                      name="description"
                      id="description"
                    />
                  </div>
                </div>
                <div class="form-group row" v-if="!edit">
                  <label class="col-sm-4 col-form-label">Posted Date</label>
                  <div class="col-sm-8 col-lg-6">
                    <input
                      type="text"
                      readonly
                      class="form-control-plaintext"
                      v-model="post.postedDate"
                      name="post_date"
                      id="post_date"
                    />
                  </div>
                </div>
                <div class="form-group row" v-if="edit">
                  <label class="col-sm-4 col-lg-4 col-form-label"
                    >Post Status</label
                  >
                  <div class="col-sm-8 col-lg-6">
                    <toggle-button
                      :value="post.status == 0 ? false : true"
                      v-model="post.status"
                      color="#00AB66"
                      :sync="true"
                    />
                  </div>
                </div>
                <div class="form-group row float-right mr-3">
                  <button v-if="edit" class="btn btn-primary btn-success">
                    Update
                  </button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>

      <div class="d-flex justify-content-center">
        <!-- <pagination :data="posts" @pagination-change-page="getAllPost">
        <span slot="prev-nav">&lt; Previous</span>
        <span slot="next-nav">Next &gt;</span>
        </pagination>-->
        <pagination
          :data="posts"
          @pagination-change-page="getAllPost"
        ></pagination>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      length: -1,
      posts: {},
      post: {
        id: "",
        title: "",
        description: "",
        status: "",
        postedDate: "",
      },
      date: "",
      deletePostID: -1,
      search: "",
      edit: true,
      custom: "",
    };
  },
  computed: {
    currentUser() {
      return this.$store.state.UsersModule.currentUser;
    },
    isLogin() {
      return this.$store.state.UsersModule.isLogin;
    },
  },
  created() {
    this.getAllPost();
  },
  mounted(){
console.log(localStorage.getItem("token"));
  },
  methods: {
    getAllPost(page = 1) {
      axios
        .get("/api/posts?page=" + page)
        .then((response) => {
          this.posts = response["data"];
          if (this.posts.total != 0) {
            this.length = this.posts.total;
          }
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
        });
    },
    viewPostModal(post, edit) {
      if (edit) {
        this.custom = "form-control";
      } else {
        this.custom = "form-control-plaintext";
      }
      this.edit = edit;
      $("#view-post").modal("show");
      var modal = $(this);
      this.post.id = post.id;
      this.post.title = post.title;
      this.post.description = post.description;
      this.post.status = post.status;
      if (post.status == 0) {
        this.post.status = false;
      } else {
        this.post.status = true;
      }
      this.post.postedDate = post.created_at.split("T")[0];
    },
    showDeleteModal(id) {
      $("#delete-post").modal("show");
      this.deletePostID = id;
    },
    deletePost() {
      $("#delete-post").modal("hide");
      axios
        .delete("/api/posts/" + this.deletePostID)
        .then((response) => {
          this.$store.dispatch("error", "Delete successful", { root: true });
          this.getAllPost();
        })
        .catch((error) => {
          console.log("Delete ERROR :: ", error);
        });
    },
    searchPost() {
      console.log("search text ", this.search);
      axios
        .post("api/posts/search", { q: this.search })
        .then((response) => {
          this.posts = response["data"];
          if (this.posts.data.length == 0) {
            this.search = "";
            this.getAllPost();
          }
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
        });
    },
    updatePost() {
      axios
        .put(`/api/posts/${this.post.id}`, this.post)
        .then((response) => {
          this.getAllPost();
          $("#view-post").modal("hide");
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
          $("#view-post").modal("hide");
        });
    },
    async fetchData() {
      axios.defaults.headers.common[
        "Authorization"
      ] = `Bearer ${localStorage.getItem("token")}`;
      const response = await axios.get("/api/export");
      console.log("data 1", response["data"].posts);
      console.log("data 2", this.posts.data);
      return response["data"].posts;
    },
  },
};
</script>