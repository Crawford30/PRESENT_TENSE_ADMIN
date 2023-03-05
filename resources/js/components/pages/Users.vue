<template>
  <div class="container">
    <div class="row mt-5" v-if="$gate.isAdmin()">
      <div class="col-md-12">
        <div class="card">
          <div class="card-header">
            <h3 class="card-title">Manage Users</h3>

            <div class="card-tools">
              <button class="btn btn-success" @click="newModal()">
                Add New
                <i class="fas fa-user-plus fa-fw"></i>
              </button>
            </div>
          </div>
          <!-- /.card-header -->
          <div
            class="card-body table-responsive p-0"
            v-if="users != null && users != undefined"
          >
            <table class="table table-hover">
              <tbody>
                <tr>
                  <th>No</th>
                  <!-- <th>ID</th> -->
                  <th>Name</th>
                  <th>Email</th>
                  <th>Type</th>
                  <th>Date Created</th>
                  <th>Actions</th>
                </tr>

                <tr v-for="(user, index) in users.data" :key="user.id">
                  <td>{{ index + 1 }}</td>
                  <!-- <td>{{ user.id }}</td> -->
                  <td>{{ user.name }}</td>
                  <td>{{ user.email }}</td>
                  <td>{{ user.type | upText }}</td>
                  <td>{{ user.created_at | myDate }}</td>

                  <td>
                    <a href="#" @click="editModal(user)">
                      <i
                        class="fas fa-pencil-alt"
                        style="color: #999; font-size: 18px"
                      ></i>
                    </a>

                    <a
                      href="#"
                      @click="deleteUser(user.id)"
                      style="margin-left: 8px"
                    >
                      <i
                        class="far fa-trash-alt"
                        style="color: #999; font-size: 18px"
                      ></i>
                    </a>

                    <a
                      href="#"
                      @click="deleteUser(user.id)"
                      style="margin-left: 8px"
                    >
                      <i
                        class="fa fa-ban"
                        style="color: #999; font-size: 18px"
                      ></i>
                    </a>
                  </td>
                </tr>
              </tbody>
            </table>
          </div>
          <!-- /.card-body -->
          <div class="card-footer">
            <pagination
              :data="users"
              @pagination-change-page="getResults"
            ></pagination>
          </div>
        </div>
        <!-- /.card -->
      </div>
    </div>

    <div v-if="!$gate.isAdmin()">
      <not-found></not-found>
    </div>

    <!-- Modal -->
    <div
      class="modal fade"
      id="addNew"
      tabindex="-1"
      role="dialog"
      aria-labelledby="addNewLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <div v-show="!editmode">
              <h5 class="modal-title" id="addNewLabel">Add User</h5>
            </div>
            <div v-show="editmode">
              <h5 class="modal-title" id="addNewLabel">Update User's Info</h5>
            </div>
            <button
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <form @submit.prevent="editmode ? updateUser() : createUser()">
            <div class="modal-body">
              <div class="form-group">
                <input
                  v-model="form.name"
                  type="text"
                  name="name"
                  placeholder="Name"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('name') }"
                />
                <has-error :form="form" field="name"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.email"
                  type="email"
                  name="email"
                  placeholder="Email Address"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('email') }"
                />
                <has-error :form="form" field="email"></has-error>
              </div>

              <div class="form-group">
                <textarea
                  v-model="form.bio"
                  name="bio"
                  id="bio"
                  placeholder="Short bio for user (Optional)"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('bio') }"
                ></textarea>
                <has-error :form="form" field="bio"></has-error>
              </div>

              <div class="form-group">
                <select
                  name="type"
                  v-model="form.type"
                  id="type"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('type') }"
                >
                  <option value="">Select User Role</option>
                  <option value="admin">Admin</option>
                  <option value="user">Standard User</option>
                  <option value="author">Author</option>
                </select>
                <has-error :form="form" field="type"></has-error>
              </div>

              <div class="form-group">
                <input
                  v-model="form.password"
                  type="password"
                  name="password"
                  id="password"
                  class="form-control"
                  :class="{ 'is-invalid': form.errors.has('password') }"
                />
                <has-error :form="form" field="password"></has-error>
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-danger" data-dismiss="modal">
                Close
              </button>
              <button v-show="editmode" type="submit" class="btn btn-success">
                Update
              </button>
              <button v-show="!editmode" type="submit" class="btn btn-primary">
                Create
              </button>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
// import Form from "vform";

import Izitoast from "../mixin/IziToast";
import ToolTip from "./../Helpers/Tooltip.vue";

import Swal from "sweetalert2";

export default {
  mixins: [Izitoast],
  data() {
    return {
      editmode: false,
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
        bio: "",
        photo: "",
      }),
    };
  },

  methods: {
    getResults(page = 1) {
      axios.get("api/user/get-user?page=" + page).then((response) => {
        console.log("RESPONSE On NEXT PAGE: ", response);
        this.users = response.data.results;
      });
    },
    updateUser() {
      let app = this;
      app.$Progress.start();
      app.form
        .post("api/user/update-user")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");

          Swal.fire("User updated Successfully!", "", "success");
          app.loadUsers();
          //   toast({
          //     type: "success",
          //     title: "User Updated successfully"
          //   });
          app.$Progress.finish();
        })
        .catch(() => {});
    },
    editModal(user) {
      this.editmode = true;
      this.form.reset();
      $("#addNew").modal("show");
      //Fill the user modal
      this.form.fill(user);
    },
    newModal() {
      this.editmode = false;
      this.form.reset();
      $("#addNew").modal("show");
    },

    deleteUser(id) {
      let app = this;
      Swal.fire({
        title: "Are you sure?",
        html: "<p style='font-size: 14px;'>You won't be able to revert this!</p>",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, Delete it!",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/api/user/delete-user",
            type: "post",
            data: {
              user_id: id,
            },
            success(data) {
              Swal.fire("User Deleted Successfully!", "", "success");
              app.loadUsers();
            },
            error(e) {
              Swal.fire("Failed!", "There was something wrong.", "warning");
              //   app.showAjaxError(e);
            },
          });
        }
      });
    },

    loadUsers() {
      if (this.$gate.isAdmin()) {
        let app = this;
        axios
          .get("api/user/get-user")
          .then(({ data }) => (app.users = data.results));
        //   console.log("USER DATA: ", app.users);
      }
    },

    createUser() {
      let app = this;
      app.$Progress.start();
      app.form
        .post("api/user/create")
        .then(() => {
          Fire.$emit("AfterCreate");
          $("#addNew").modal("hide");
          toast({
            type: "success",
            title: "User Created in successfully",
          });
          app.$Progress.finish();
        })
        .catch(() => {});
    },
  },
  created() {
    Fire.$on("searching", () => {
      let query = this.$parent.search;
      axios
        .get("api/user/findUser?q=" + query)
        .then((data) => {
          this.users = data.data;
        })
        .catch(() => {});
    });
    this.loadUsers();
    Fire.$on("AfterCreate", () => {
      this.loadUsers();
    });
    // setInterval(() => this.loadUsers(), 3000);
  },
  mounted() {
    //this.$Progress.finish();
  },
};
</script>
