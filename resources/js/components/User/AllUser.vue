<template>
  <div>
    <!-- <div class="text-center" v-if="users['data'].length == 0">
      <h2>Empty User</h2>
    </div> -->
    <div class="card">
      <div class="card-header">
        <div class="row">
          <div class="col-md-2">
            <input
              class="form-control"
              id="name"
              name="name"
              type="text"
              v-model="name"
              placeholder="Search By Name"
            />
          </div>
          <div class="col-md-2">
            <input
              class="form-control"
              name="email"
              v-model="email"
              type="text"
              placeholder="Search By Email"
            />
          </div>
          <div class="col-md-2">
            <input class="form-control" id="from" name="from" v-model="from" type="date" />
          </div>
          <div class="col-md-2">
            <input class="form-control" id="from" name="from" v-model="to" type="date" />
          </div>
          <div>
            <button @click="searchUser()" class="btn btn-primary float-right">Search</button>
          </div>
          <div class="col-md-3">
            <router-link to="/users-create" class="btn btn-success float-right active">
              Add New
              <i class="fa fa-user-plus fa-lg"></i>
            </router-link>
          </div>
        </div>
      </div>
      <div class="card-body">
        <table class="table table-responsive-sm table-hover table-outline mb-0 table table-striped  table-sm" cellspacing="0"
  width="100%">
          <thead class="thead-dark">
            <tr>
              <th>Name</th>
              <th>Email</th>
              <th>Created User</th>
              <th>Phone</th>
              <th>Birthdate</th>
              <th>Address</th>
              <th>Created Date</th>
              <th>Updated Date</th>
              <th class="text-center">Actions</th>
            </tr>
          </thead>
          <tbody v-for="user in users.data" :key="user.id">
            <tr>
              <td>
                <strong>{{ user.name }}</strong>
              </td>
              <td>
                <strong>{{ user.email }}</strong>
              </td>
              <td>
                <strong>{{ user.create_user_id }}</strong>
              </td>
              <td>
                <strong>{{ user.phone }}</strong>
              </td>
              <td>
                <strong>{{ user.dob }}</strong>
              </td>
              <td>
                <strong>{{ user.address}}</strong>
              </td>
              <td>
                <strong>{{ user.created_at.split('T')[0] }}</strong>
              </td>
              <td>
                <strong>{{ user.updated_at.split('T')[0]}}</strong>
              </td>
              <td class="text-center">
                <button class="btn btn-sm btn-primary mt-1" @click="showUserInformation(user)">
                  View
                  <i class="fa fa-eye"></i>
                </button>
                <button class="btn btn-sm btn-danger active mt-1" @click="showDeleteModal(user.id)">
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
      <div class="d-flex justify-content-center">
        <pagination :data="users" @pagination-change-page="getUserList"></pagination>
      </div>
      <div class="modal" id="delete-user" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">
                <strong>Are you sure you want to delete ?</strong>
              </h5>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="button" class="btn btn-success" @click="deleteUser()">Delete</button>
            </div>
          </div>
        </div>
      </div>
      <div class="modal" id="view-user" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title text-primary text-center w-100">
                <strong>User Information</strong>
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
                  <label class="col-sm-4 col-form-label">Name</label>
                  <div class="col-sm-8 col-lg-6">
                    <input type="text" readonly class="form-control-plaintext" v-model="user.name" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Email</label>
                  <div class="col-sm-8 col-lg-6">
                    <input type="text" readonly class="form-control-plaintext" v-model="user.email" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Birthdate</label>
                  <div class="col-sm-8 col-lg-6">
                    <input
                      type="text"
                      readonly
                      class="form-control-plaintext"
                      v-model="user.birthdate"
                    />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Phone</label>
                  <div class="col-sm-8 col-lg-6">
                    <input type="text" readonly class="form-control-plaintext" v-model="user.phone" />
                  </div>
                </div>
                <div class="form-group row">
                  <label class="col-sm-4 col-form-label">Address</label>
                  <div class="col-sm-8 col-lg-6">
                    <input
                      type="text"
                      readonly
                      class="form-control-plaintext"
                      v-model="user.address"
                    />
                  </div>
                </div>
              </div>
            </form>
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
      users: {},
      user: {
        name: "",
        email: "",
        address: "",
        birthdate: "",
        phone: "",
      },
      name: "",
      email: "",
      from: "",
      to: "",
      deleteUserID: -1,
    };
  },
  created() {
    console.log("Create User");
    this.getUserList();
  },
  mounted() {
    console.log("Mounted User");
  },
  methods: {
    getUserList(page = 1) {
      axios
        .get("/api/users?page=" + page)
        .then((response) => {
          this.users = response["data"];
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
        });
    },
    searchUser() {
      axios
        .post("api/users/search", {
          name: this.name,
          email: this.email,
          from: this.from,
          to: this.to,
        })
        .then((response) => {
          this.users = response["data"];
          if (this.users.data.length == 0) {
            console.log("user not found");
            this.name = "";
            this.email = "";
            this.from = "";
            this.to = "";
            this.getUserList();
          }
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
        });
    },
    showDeleteModal(id) {
      $("#delete-user").modal("show");
      this.deleteUserID = id;
    },
    deleteUser() {
      axios
        .delete("/api/users/" + this.deleteUserID)
        .then((response) => {
          this.getUserList();
          $("#delete-user").modal("hide");
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
          $("#delete-user").modal("hide");
        });
    },
    showUserInformation(user) {
      $("#view-user").modal("show");
      var modal = $(this);
      this.user.name = user.name;
      this.user.email = user.email;
      this.user.birthdate = user.dob;
      this.user.phone = user.phone;
      this.user.address = user.address;
    },
  },
};
</script>
