<template>
  <div class="dvd-view">
    <div class="container p-2">
      <div class="row my-3">
        <div class="col-md-9 text-left my-1">
          <h4>Video DVDS :: Permissions</h4>
        </div>

        <div class="col-md-3">
          <div class="btn-group add-new-dropdown" style="width: 100%">
            <div class="btn-group w-100" role="group"></div>
          </div>
        </div>
      </div>

      <div class="staff-card shadow-sm table-padding">
        <div class="row justify-content-center m-0">
          <div class="table table-sm">
            <div>
              <div class="row">
                <div class="col-md-1 th" style="text-align: left">#</div>
                <div class="col-md-5 th" style="text-align: left">
                  Video DVD Name
                </div>
                <div class="col-md-6">
                  <div class="row">
                    <div class="col th" style="text-align: center">EAF</div>
                    <div class="col th" style="text-align: center">IND</div>
                    <div class="col th" style="text-align: center">SAF</div>
                    <div class="col th" style="text-align: center">EUR</div>
                    <div class="col th" style="text-align: center">ALL</div>
                  </div>
                </div>
              </div>
            </div>
            <form id="permissions-form">
              <div
                v-for="(videoDVD, index) in dvdVideos.results"
                v-bind:key="'video-dvd-' + videoDVD.id + index"
                style="width: 100% !important"
              >
                <div
                  class="p-0 m-0"
                  style="
                    padding-left: 0 !important;
                    padding-right: 0 !important;
                  "
                >
                  <div class="table table-sm m-0 p-0" style="text-align: left">
                    <div>
                      <div class="row tbody mx-0">
                        <div class="col-md-1 px-0" style="text-align: left">
                          {{ index + 1 }}
                        </div>
                        <div class="col-md-5 px-0">
                          {{ videoDVD.video_dvd_name }}
                        </div>

                        <div class="col-md-6">
                          <div class="row">
                            <div
                              class="col"
                              style="padding: 0rem 2rem !important"
                            >
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input
                                    type="checkbox"
                                    :data-user="videoDVD.id"
                                    data-group="1"
                                    class="custom-control-input"
                                    :id="
                                      'permission-video-dvd-east-africa' +
                                      videoDVD.id
                                    "
                                    :name="'permissions[' + videoDVD.id + '][]'"
                                    value="video_eaf"
                                    :checked="
                                      videoDVD.video_dvd_permissions.includes(
                                        'video_eaf'
                                      )
                                    "
                                  />
                                  <label
                                    class="custom-control-label"
                                    :for="
                                      'permission-video-dvd-east-africa' +
                                      videoDVD.id
                                    "
                                  ></label>
                                </div>
                              </div>
                            </div>

                            <div
                              class="col"
                              style="padding: 0rem 2rem !important"
                            >
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input
                                    type="checkbox"
                                    :data-user="videoDVD.id"
                                    data-group="2"
                                    class="custom-control-input"
                                    :id="
                                      'permission-video-dvd-india' + videoDVD.id
                                    "
                                    :name="'permissions[' + videoDVD.id + '][]'"
                                    value="video_ind"
                                    :checked="
                                      videoDVD.video_dvd_permissions.includes(
                                        'video_ind'
                                      )
                                    "
                                  />
                                  <label
                                    class="custom-control-label"
                                    :for="
                                      'permission-video-dvd-india' + videoDVD.id
                                    "
                                  ></label>
                                </div>
                              </div>
                            </div>

                            <!-- <div
                              class="col"
                              style="padding: 0rem 2rem !important"
                            >
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input
                                    type="checkbox"
                                    class="custom-control-input"
                                  />

                                  <label class="custom-control-label"></label>
                                </div>
                              </div>
                            </div> -->

                            <div
                              class="col"
                              style="padding: 0rem 2rem !important"
                            >
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input
                                    type="checkbox"
                                    :data-user="videoDVD.id"
                                    data-group="3"
                                    class="custom-control-input"
                                    :id="
                                      'permission-video-dvd-south' + videoDVD.id
                                    "
                                    :name="'permissions[' + videoDVD.id + '][]'"
                                    value="video_saf"
                                    :checked="
                                      videoDVD.video_dvd_permissions.includes(
                                        'video_saf'
                                      )
                                    "
                                  />
                                  <label
                                    class="custom-control-label"
                                    :for="
                                      'permission-video-dvd-south' + videoDVD.id
                                    "
                                  ></label>
                                </div>
                              </div>
                            </div>

                            <div
                              class="col"
                              style="padding: 0rem 2rem !important"
                            >
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input
                                    type="checkbox"
                                    :data-user="videoDVD.id"
                                    data-group="4"
                                    class="custom-control-input"
                                    :id="
                                      'permission-video-dvd-europe' +
                                      videoDVD.id
                                    "
                                    :name="'permissions[' + videoDVD.id + '][]'"
                                    value="viideo_eur"
                                    :checked="
                                      videoDVD.video_dvd_permissions.includes(
                                        'video_eur'
                                      )
                                    "
                                  />
                                  <label
                                    class="custom-control-label"
                                    :for="
                                      'permission-video-dvd-europe' +
                                      videoDVD.id
                                    "
                                  ></label>
                                </div>
                              </div>
                            </div>

                            <div
                              class="col"
                              style="padding: 0rem 1.6rem !important"
                            >
                              <div class="form-group">
                                <div class="custom-control custom-checkbox">
                                  <input
                                    type="checkbox"
                                    :data-user="videoDVD.id"
                                    data-group="5"
                                    class="custom-control-input"
                                    :id="
                                      'permission-video-dvd-all' + videoDVD.id
                                    "
                                    :name="'permissions[' + videoDVD.id + '][]'"
                                    value="video_all"
                                    :checked="
                                      videoDVD.video_dvd_permissions.includes(
                                        'video_all'
                                      )
                                    "
                                  />
                                  <label
                                    class="custom-control-label"
                                    :for="
                                      'permission-video-dvd-all' + videoDVD.id
                                    "
                                  ></label>
                                </div>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
              <div class="text-right mt-4">
                <button
                  :disabled="isProcessing"
                  @click.prevent="savePermissions"
                  class="present-tense-btn present-tense-primary px-6"
                >
                  <span>
                    <i v-if="isProcessing" class="fa fa-spinner fa-spin"></i>
                  </span>
                  Save Changes
                </button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import Swal from "sweetalert2";
import dragAndDropHelper from "./../../../mixin/dragAndDropHelper";
import Izitoast from "./../../../mixin/IziToast";
import DropFile from "./../../../common/DropFile";
import Tooltip from "./../../../common/DropFile";

export default {
  components: {
    VueEditor,
    DropFile,
    Tooltip,
  },
  mixins: [dragAndDropHelper, Izitoast],
  data() {
    return {
      dvdVideos: [],
      selectedAudio: {},
      displayAudio: null,
      uploadedAudio: null,
      file: null,
      editmode: false,
      selectedSong: null,
      hasFile: false,
      tenMajorSongs: [],
      isProcessing: false,
      songTitle: "",
      songBody: "",
      songNumber: "",
      errors: null,
      selectedSong: null,
      importResults: {},
      defaultToolbar: [
        [
          {
            header: [false, 1, 2, 3, 4, 5, 6],
          },
        ],
        ["bold", "italic", "underline", "strike"],
        [
          {
            align: "",
          },
          {
            align: "center",
          },
          {
            align: "right",
          },
          {
            align: "justify",
          },
        ],
        [
          {
            list: "ordered",
          },
          {
            list: "bullet",
          },
        ],
        [
          {
            indent: "-1",
          },
          {
            indent: "+1",
          },
        ],
      ],
    };
  },

  mounted() {
    let app = this;
    app.getAllDVDVideos();
  },
  methods: {
    savePermissions() {
      let app = this;
      app.isProcessing = true;

      let form = $("#permissions-form");

      console.log("PERMISSION FORM: ", form);

      let formData = new FormData(form[0]);
      console.log("FORM DATA: ", formData);

      $.ajax({
        type: "post",
        url: "/api/user/permission/create-video-permission",
        data: formData,
        processData: false,
        contentType: false,
        success(data) {
          app.isProcessing = false;
          Swal.fire(
            "<p style='font-size: 14px;'>Changes Saved Successfully</p>",
            "",
            "success"
          );

          app.getAllDVDVideos();
        },
        error(e) {
          app.isProcessing = false;
          Swal.fire(
            "Failed!",
            "<p style='font-size: 14px;'>An Error has occured</p>",
            "warning"
          );
          //  app.showAjaxError(e);
        },
      });
    },

    getAllDVDVideos() {
      let app = this;
      $.ajax({
        url: "/api/video-dvd/list",
        success(data) {
          app.dvdVideos = data;
        },
      });
    },
  },
};
</script>

<style scoped>
.hide {
  display: none;
}

[data-toggle="toggle"] {
  display: none;
}

tbody {
  width: 100% !important;
}

th,
td {
  font-size: 11px !important;
}

.table-sm .th {
  border: none !important;
  padding: 0.5rem 0.5rem !important;
  text-transform: uppercase;
  background-color: #f5f6fa;
  color: #a6a9b7;
  font-size: 11px !important;
  font-weight: bold;
}

.table-sm .th.col-md-1 {
  text-align: center;
}

.table-sm .tbody {
  padding: 0.5rem 0rem !important;
  border-bottom: 1px solid rgb(222, 226, 230);
}

.form-group {
  margin-bottom: 0 !important;
}

.table-sm .col-md-1 {
  text-align: center;
}

.legend-table tr td:first-child {
  font-weight: bold;
  padding-left: 0 !important;
}

.custom-checkbox-else
  .custom-control-input:checked
  ~ .custom-control-label::after {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' height='1792' viewBox='0 0 1792 1792' width='1792'%3E%3Cpath fill='white' d='M1600 736v192q0 40-28 68t-68 28h-1216q-40 0-68-28t-28-68v-192q0-40 28-68t68-28h1216q40 0 68 28t28 68z'/%3E%3C/svg%3E");
}

.custom-checkbox {
  margin-left: 15px !important;
}

.hideLoader {
  display: none;
}

.custom-checkbox-else
  .custom-control-input:checked
  ~ .custom-control-label::after {
  background-image: url("data:image/svg+xml;charset=utf8,%3Csvg xmlns='http://www.w3.org/2000/svg' height='1792' viewBox='0 0 1792 1792' width='1792'%3E%3Cpath fill='white' d='M1600 736v192q0 40-28 68t-68 28h-1216q-40 0-68-28t-28-68v-192q0-40 28-68t68-28h1216q40 0 68 28t28 68z'/%3E%3C/svg%3E");
}

.custom-checkbox {
  margin-left: 15px !important;
}
</style>
