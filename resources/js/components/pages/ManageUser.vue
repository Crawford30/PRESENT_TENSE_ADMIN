<template>
  <div class="container">
    <div class="row" v-if="$gate.isAdmin()">
      <div class="col-md-12">
        <div class="row mt-5">
          <div class="col-md-9">
            <h3 style="font-weight: 500; color: #333; font-size: 1.575rem">
              Manage Users
            </h3>
          </div>
          <div class="col-md-3">
            <button
              @click="newModal()"
              type="button"
              style="width: 100%"
              class="btn btn-primary"
            >
              Create New User
            </button>
          </div>
        </div>

        <div class="card mt-3">
          <div class="form-view">
            <div>
              <div class="row mt-3">
                <div class="col-md-12">
                  <div class="form-card shadow-sm table-padding">
                    <div class="row justify-content-center">
                      <table class="table table-sm unicef-forms-list">
                        <thead>
                          <tr>
                            <th>#</th>
                            <th>NAME</th>
                            <th>E-MAIL</th>
                            <th>STATUS</th>
                            <th>TYPE</th>
                            <th>DATE CREATED</th>
                            <th class="text-right">ACTIONS</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr
                            v-for="(user, index) in users.data"
                            :key="user.id"
                          >
                            <td>{{ index + 1 }}</td>
                            <td>{{ user.name }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.user_status | upText }}</td>
                            <td>{{ user.type | upText }}</td>
                            <td>{{ user.created_at | myDate }}</td>

                            <td class="text-right">
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
                              <span v-if="user.user_status === 'DEACTIVATED'">
                                <a
                                  href="#"
                                  @click="activateUser(user)"
                                  style="margin-left: 8px"
                                >
                                  <i
                                    class="fa fa-toggle-off"
                                    style="color: #999; font-size: 18px"
                                  ></i>
                                </a>
                              </span>
                              <span v-else>
                                <a
                                  href="#"
                                  @click="deactivateUser(user)"
                                  style="margin-left: 8px"
                                >
                                  <i
                                    class="fa fa-toggle-on"
                                    style="color: #999; font-size: 18px"
                                  ></i>
                                </a>
                              </span>
                              <!-- <span v-if="item.owner_ids.includes(session.id) || item.user_id == session.id">
                                                <a href="#" @click.prevent="editForm(item.id)">
                                                    <i class="fas fa-pencil-alt" style="color: #999; font-size: 18px;"></i>
                                                </a>
                                                <a @click.prevent="deleteForm(item.id)" href="#" style="margin-left: 8px;">
                                                    <i class="far fa-trash-alt" style="color: #999; font-size: 18px;"></i>
                                                </a>
                                            </span> -->
                            </td>
                          </tr>
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="card-footer">
            <pagination
              :data="users"
              @pagination-change-page="getResults"
            ></pagination>
          </div>
        </div>

        <!-- <div class="supply-view">
          <div class="card">
            <div class="row mt-3">
              <div class="col-md-12">
                <div class="form-card shadow-sm">
                  <div class="row justify-content-center">
                    <table
                      class="table table-sm unicef-forms-list table-padding"
                    >
                      <thead>
                        <tr>
                          <th>#</th>
                          <th>NAME</th>
                          <th>E-MAIL</th>
                          <th>TYPE</th>
                          <th>DATE CREATED</th>
                          <th>ACTIONS</th>
                        </tr>
                      </thead>

                      <tr v-for="(user, index) in users.data" :key="user.id">
                        <td>{{ index + 1 }}</td>
                        <!-- <td>{{ user.id }}</td> -->
        <!-- <td>{{ user.name }}</td>
                        <td>{{ user.email }}</td>
                        <td>{{ user.type | upText }}</td> -->
        <!-- <td>{{ user.user_status | upText }}</td> -->
        <!-- <td>
                          {{ user.created_at | myDate }}
                        </td>

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
                          <span v-if="user.user_status === 'DEACTIVATED'">
                            <a
                              href="#"
                              @click="activateUser(user)"
                              style="margin-left: 8px"
                            >
                              <i
                                class="fa fa-toggle-off"
                                style="color: #999; font-size: 18px"
                              ></i>
                            </a>
                          </span>
                          <span v-else>
                            <a
                              href="#"
                              @click="deactivateUser(user)"
                              style="margin-left: 8px"
                            >
                              <i
                                class="fa fa-toggle-on"
                                style="color: #999; font-size: 18px"
                              ></i>
                            </a>
                          </span>
                        </td>
                      </tr>
                    </table>
                  </div>
                </div>
                <div class="card-footer">
                  <pagination
                    :data="users"
                    @pagination-change-page="getResults"
                  ></pagination>
                </div>
              </div>
            </div>
          </div>
        </div>  -->

        <!-- <div
            class="card-body table-responsive p-0 supply-form"
            v-if="users != null && users != undefined"
          >
            <table class="table table-hover">
              <tbody>
                <thead>
                  <tr>
                    <th>#</th>
                    <th class="text-center">NAME</th>
                    <th class="text-center">E-MAIL</th>
                    <th class="text-center">TYPE</th>
                    <th class="text-center">DATE CREATED</th>
                    <th class="text-right">ACTIONS</th>
                  </tr>
                </thead>

                <tr v-for="(user, index) in users.data" :key="user.id">
                  <td>{{ index + 1 }}</td>
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
                    <span v-if="user.user_status === 'DEACTIVATED'">
                      <a
                        href="#"
                        @click="activateUser(user)"
                        style="margin-left: 8px"
                      >
                        <i
                          class="fa fa-toggle-off"
                          style="color: #999; font-size: 18px"
                        ></i>
                      </a>
                    </span>
                    <span v-else>
                      <a
                        href="#"
                        @click="deactivateUser(user)"
                        style="margin-left: 8px"
                      >
                        <i
                          class="fa fa-toggle-on"
                          style="color: #999; font-size: 18px"
                        ></i>
                      </a>
                    </span>
                  </td>
                </tr>
              </tbody>
            </table>
          </div> -->
        <!-- /.card-body -->
        <!-- <div class="card-footer">
            <pagination
              :data="users"
              @pagination-change-page="getResults"
            ></pagination>
          </div> -->

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
import axios from "axios";

import Swal from "sweetalert2";

export default {
  mixins: [Izitoast],
  data() {
    return {
      errors: null,
      isProcessing: false,
      editmode: false,
      isUserActivated: false,
      users: {},
      form: new Form({
        id: "",
        name: "",
        email: "",
        password: "",
        type: "",
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

          Swal.fire(
            "<p style='font-size: 14px;'>User Updated Successfully</p>",
            "",
            "success"
          );
          app.loadUsers();
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

    deactivateUser(user) {
      console.log("DEACITVATE USER: ", user.user_status);
      this.isUserActivated = false;

      let app = this;
      Swal.fire({
        title: "Deactivate User",
        html: `<p style="font-size: 13px;">Would you like to deactivate <span style="font-size: 13px; font-weight: bold; color: #000000;">${user.email}</span>?</p>`,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No, Cancel",
        confirmButtonText: "Yes, Deactivate",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/api/user/update-user-status",
            type: "post",
            data: {
              user_id: user.id,
              user_status: 0,
            },
            success(data) {
              Swal.fire(
                "<p style='font-size: 14px;'>User Deactivated Successfully</p>",
                "",
                "success"
              );
              app.loadUsers();
            },
            error(e) {
              Swal.fire(
                "Failed!",
                "<p style='font-size: 14px;'>There was something wrong!</p>",
                "warning"
              );
              // app.showAjaxError(e);
            },
          });
        }
      });
    },

    activateUser(user) {
      this.isUserActivated = true;
      let app = this;
      Swal.fire({
        title: "Activate User",
        html: `<p style="font-size: 13px;">Would you like to activate <span style="font-size: 13px; font-weight: bold; color: #000000;">${user.email}</span>?</p>`,
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No, Cancel",
        confirmButtonText: "Yes, Activate",
      }).then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/api/user/update-user-status",
            type: "post",
            data: {
              user_id: user.id,
              user_status: 1,
            },
            success(data) {
              Swal.fire(
                "<p style='font-size: 14px;'>User Activated Successfully</p>",
                "",
                "success"
              );
              app.loadUsers();
            },
            error(e) {
              Swal.fire(
                "Failed!",
                "<p style='font-size: 14px;'>There was something wrong!</p>",
                "warning"
              );
            },
          });
        }
      });
    },

    deleteUser(id) {
      let app = this;
      app.isProcessing = true;
      Swal.fire({
        title: "Delete User",
        html: "<p style='font-size: 14px;'>You won't be able to revert this!</p>",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        cancelButtonText: "No, Cancel",
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
              app.isProcessing = false;
              Swal.fire(
                "<p style='font-size: 14px;'>User Deleted Successfully</p>",
                "",
                "success"
              );
              app.loadUsers();
            },
            error(e) {
              app.isProcessing = false;
              Swal.fire(
                "Failed!",
                "<p style='font-size: 14px;'>There was something wrong!</p>",
                "warning"
              );
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
          Swal.fire(
            "<p style='font-size: 14px;'>User account created successfully</p>",
            "",
            "success"
          );
          app.loadUsers();
          app.$Progress.finish();
        })
        .catch((e) => {
          Swal.fire(
            "Failed!",
            "<p style='font-size: 14px;'>There was something wrong!</p>",
            "warning"
          );
        });
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



<style scoped>
.table thead {
  background-color: #f5f6fa;
  color: #a6a9b7;
}

.modal {
  overflow-y: auto !important;
}

.form-view,
.form-card {
  background: #fff;
}

.form-view .table-padding {
  padding: 25px 35px;
}

.shadow-sm {
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}
.unicef-forms-list tr th,
.unicef-forms-list tr td {
  font-size: 13px;
}

/* .supply-view,
.form-card {
  background: #fff;
}
.supply-view table thead {
  background-color: #f5f6fa;
  color: #a6a9b7;
}

.supply-view .table-padding {
  padding: 25px 35px;
} */

/* .shadow-sm {
  box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075) !important;
}

.unicef-forms-list tr th,
.unicef-forms-list tr td {
  font-size: 13px;
} */

.table-padding {
  padding: 25px 35px;
}
</style>
