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
                                    <!-- <th>Status</th> -->
                                    <th>Date Created</th>
                                    <th>Actions</th>
                                </tr>

                                <tr
                                    v-for="(user, index) in users.data"
                                    :key="user.id"
                                >
                                    <td>{{ index + 1 }}</td>
                                    <!-- <td>{{ user.id }}</td> -->
                                    <td>{{ user.name }}</td>
                                    <td>{{ user.email }}</td>
                                    <td>{{ user.type | upText }}</td>
                                    <!-- <td>{{ user.user_status | upText }}</td> -->
                                    <td>{{ user.created_at | myDate }}</td>

                                    <td>
                                        <a href="#" @click="editModal(user)">
                                            <i
                                                class="fas fa-pencil-alt"
                                                style="
                                                    color: #999;
                                                    font-size: 18px;
                                                "
                                            ></i>
                                        </a>

                                        <a
                                            href="#"
                                            @click="deleteUser(user.id)"
                                            style="margin-left: 8px"
                                        >
                                            <i
                                                class="far fa-trash-alt"
                                                style="
                                                    color: #999;
                                                    font-size: 18px;
                                                "
                                            ></i>
                                        </a>
                                        <span
                                            v-if="
                                                user.user_status ===
                                                'DEACTIVATED'
                                            "
                                        >
                                            <a
                                                href="#"
                                                @click="activateUser(user)"
                                                style="margin-left: 8px"
                                            >
                                                <i
                                                    class="fa fa-toggle-off"
                                                    style="
                                                        color: #999;
                                                        font-size: 18px;
                                                    "
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
                                                    style="
                                                        color: #999;
                                                        font-size: 18px;
                                                    "
                                                ></i>
                                            </a>
                                        </span>
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
                            <h5 class="modal-title" id="addNewLabel">
                                Add User
                            </h5>
                        </div>
                        <div v-show="editmode">
                            <h5 class="modal-title" id="addNewLabel">
                                Update User's Info
                            </h5>
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
                    <form
                        @submit.prevent="editmode ? updateUser() : createUser()"
                    >
                        <div class="modal-body">
                            <div class="form-group">
                                <label>Name:</label>
                                <input
                                    v-model="form.name"
                                    type="text"
                                    name="name"
                                    placeholder="Name"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('name'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="name"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>E-mail:</label>
                                <input
                                    v-model="form.email"
                                    type="email"
                                    name="email"
                                    placeholder="Email Address"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('email'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="email"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>User Type:</label>
                                <select
                                    name="type"
                                    v-model="form.type"
                                    id="type"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('type'),
                                    }"
                                >
                                    <option value="">Select User Role</option>
                                    <option value="admin">Admin</option>
                                    <option value="user">Standard User</option>
                                    <!-- <option value="author">Author</option> -->
                                </select>
                                <has-error
                                    :form="form"
                                    field="type"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>User DVD Access Status:</label>
                                <select
                                    name="dvd_access_status"
                                    v-model="form.dvd_access_status"
                                    id="dvd_access_status"
                                    class="form-control"
                                    :class="{
                                        'is-invalid': form.errors.has('dvd_access_status'),
                                    }"
                                >
                                    <option value="">Select DVD Access Status</option>
                                    <option value="ALL_DVD">Both Audio and Video DVD</option>
                                    <option value="AUDIO_DVD">Audio DVD Access Only</option>
                                    <option value="VIDEO_DVD">Video DVD Access Only</option>
                                    <option value="NONE">No Access</option>
                                    <!-- <option value="author">Author</option> -->
                                </select>
                                <has-error
                                    :form="form"
                                    field="dvd_access_status"
                                ></has-error>
                            </div>

                            <div class="form-group">
                                <label>Password:</label>
                                <input
                                    v-model="form.password"
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control"
                                    :class="{
                                        'is-invalid':
                                            form.errors.has('password'),
                                    }"
                                />
                                <has-error
                                    :form="form"
                                    field="password"
                                ></has-error>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button
                                type="button"
                                class="btn btn-danger"
                                data-dismiss="modal"
                            >
                                Close
                            </button>
                            <button
                                v-show="editmode"
                                type="submit"
                                class="btn btn-success"
                            >
                                Update
                            </button>
                            <button
                                v-show="!editmode"
                                type="submit"
                                class="btn btn-primary"
                            >
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
                dvd_access_status: ""
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
