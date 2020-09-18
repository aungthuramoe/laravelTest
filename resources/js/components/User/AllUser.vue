<template>
  <div class="card">
    <div class="card-header">
      <div class="row">
        <div class="col-md-2">
          <input class="form-control" id='name' name="name" type="text"  placeholder="Search By Name">
        </div>
        <div class="col-md-2">
           <input class="form-control" name="email" type="text" placeholder="Search By Email">
        </div>
        <div class="col-md-2">
          <input class="form-control" id="from" name="from" type="date">
        </div>
        <div class="col-md-2">
          <input class="form-control" id="from" name="from" type="date">
        </div>
        <div>
          <button class="btn btn-primary float-right">
           Search
          </button>
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
      <table class="table table-responsive-sm table-hover table-outline mb-0">
        <thead class="thead-dark">
          <tr>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Created User</th>
            <th scope="col">Phone</th>
            <th scope="col">Birthdate</th>
            <th scope="col">Address</th>
            <th scope="col">Created Date</th>
            <th scope="col">Updated Date</th>
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
              <button class="btn btn-sm btn-primary">
                View
                <i class="fa fa-eye"></i>
              </button>
              <button class="btn btn-sm btn-danger active">
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
      <!-- <pagination :data="posts" @pagination-change-page="getPostList">
        <span slot="prev-nav">&lt; Previous</span>
        <span slot="next-nav">Next &gt;</span>
      </pagination>-->
      <pagination :data="users" @pagination-change-page="getUserList"></pagination>
    </div>
  </div>
</template>
<script>
export default {
  data() {
    return {
      users: {},
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
      console.log("get user List method is working");
      axios
        .get("/api/users?page=" + page)
        .then((response) => {
          this.users = response["data"];
          console.log("RESPONSE :: Show Users -> ", response["data"]);
        })
        .catch((error) => {
          console.log("ERROR :: ", error);
        });
    },
  },
};
</script>
