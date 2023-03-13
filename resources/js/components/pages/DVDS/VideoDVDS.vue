<template>
    <div class="dvd-view">
        <div class="container">
            <div class="row my-3">
                <div class="col-md-9 text-left">
                    <h4>Video DVDS</h4>
                </div>

                <div class="col-md-3">
                    <div
                        class="btn-group add-new-dropdown"
                        style="width: 100%"
                    >
                        <div
                            class="btn-group w-100"
                            role="group"
                        >
                            <button
                                type="button"
                                class="btn btn-primary"
                                @click="showUploadVideo"
                            >
                                Upload Video DVD
                                </button>
                </div>
            </div>
        </div>
    </div>

    <div class="card">
        <!-- <div class="col-11 ml-0 pl-0" v-if="checkPermission(current_user)"> -->
        <div class="staff-card shadow-sm table-padding">
            <div class="row justify-content-center">
                <table class="table table-sm present-tense-table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th class="text-justify">VIDEO DVD NAME</th>
                            <th class="text-center">VIEWS</th>
                            <th>DATE CREATED</th>
                            <th>ACTIONS</th>
                        </tr>
                    </thead>
                    <tr
                        v-for="(dvdVideo, index) in dvdVideos.results"
                        :key="dvdVideo.id + '_' + index"
                    >
                        <td>{{ index + 1 }}</td>

                        <td class="text-justify text-uppercase">
                            {{ dvdVideo.video_dvd_name }}
                            <!-- <a @click.prevent="showVideo(dvdVideo)" href="#">{{
                    dvdVideo.video_dvd_name
                  }}</a> -->
                        </td>

                        <td class="text-center">{{ dvdVideo.views_count }}</td>

                        <td>{{ dvdVideo.creation_date | myDate }}</td>
                        <td>
                            <a href="#">
                                <i
                                    class="fas fa-pencil-alt"
                                    style="color: #999; font-size: 18px"
                                ></i>
                            </a>

                            <a
                                @click.prevent="deleteVideoDVD(dvdVideo.id)"
                                href="#"
                                style="margin-left: 8px"
                            >
                                <i
                                    class="far fa-trash-alt"
                                    style="color: #999; font-size: 18px"
                                ></i>
                                    </a>

                                    <a
                                        href="#"
                                        style="margin-left: 8px"
                                    >
                                        <i
                                            class="fas fa-ellipsis-v"
                                            style="color: #999; font-size: 18px"
                                        ></i>
                                            </a>
                        </td>
                        </tr>
                </table>
            </div>

            <!-- </div> -->
        </div>
    </div>
    </div>

    <div
        class="modal fade"
        id="single-song-modal-detail"
    >
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body p-4">
                    <button
                        type="button"
                        style="position: absolute; right: 1.5rem; top: 1.5rem"
                        class="close"
                        @click="closeModel"
                    >
                        &times;
                        </button>
                        <h5 style="text-align: center; font-weight: bold">Song Details</h5>

                        <br />
                        <hr />

                        <form
                            id="song-form"
                            ref="songRef"
                        >
                            <div class="form-group">
                                <!-- <label>Song</label> -->
                                <vue-editor
                                    id="song-body"
                                    :disabled="true"
                                    v-model="songBody"
                                    :editorToolbar="defaultToolbar"
                                ></vue-editor>
                            </div>
                            </form>
                </div>
            </div>
        </div>
        </div>
        <!-------Add Single Song  End------>

        <div
            class="modal fade"
            id="modal-upload-video"
        >
            <div class="modal-dialog">
                <div class="modal-content">
                    <!-- Modal body -->
                    <form
                        enctype="multipart/form-data"
                        id="videos-form"
                        method="post"
                    >
                        <div class="modal-body px-4 mb-3">
                            <button
                                type="button"
                                style="position: absolute; right: 1.5rem; top: 1.5rem"
                                class="close"
                                @click="closeModel"
                            >
                                &times;
                                </button>
                                <h5 class="text-center">Add Video DVD</h5>
                                <!-- <hr /> -->
                                <div class="form-group">
                                    <label for="">Video DVD Name</label>
                                    <input
                                        required
                                        v-model="selectedVideo.video_dvd_name"
                                        name="video_dvd_name"
                                        class="form-control"
                                        placeholder="Video DVD Name"
                                        type="text"
                                    />
                                </div>

                                <label for="">Video DVD File</label>
                                <DropFile
                                    ref="dropFile"
                                    inline-template
                                    v-cloak
                                >
                                    <div class="text-muted">
                                        <div
                                            v-if="!hasFile"
                                            v-bind:style="{ backgroundImage: backgroundImage }"
                                            v-on:drop.prevent="dragDrop"
                                            v-on:dragover.prevent="dragOver"
                                            class="drag-drop-area px-5 py-3"
                                            style="margin-left: 0; margin-right: 0"
                                        >
                                            <div class="text-center drop-zone">
                                                <img
                                                    class="icon-img"
                                                    src="/images/icons/upload_gray.png"
                                                />
                                                <h6 style="color: #bbbbbb; margin-bottom: 0.2rem">
                                                    DRAG &amp; DROP
                                                </h6>
                                            </div>
                                            <div class="text-center">
                                                <p style="
                          color: #bbbbbb;
                          margin-bottom: 0;
                          padding-bottom: 0;
                          font-size: 12px;
                        ">
                                                    the video DVD, or if you prefer
                                                </p>
                                                <div class="position-relative">
                                                    <button
                                                        type="button"
                                                        class="btn btn-primary position-relative"
                                                        style="font-size: 12px; margin-top: 5px"
                                                    >
                                                        Choose files
                                                        <input
                                                            type="file"
                                                            style="
                              position: absolute;
                              left: 0;
                              top: 0;
                              opacity: 0;
                              cursor: pointer;
                            "
                                                            accept="video/mp4,video/x-m4v,video/*"
                                                            id="videoFile"
                                                            class="opactiy-none"
                                                            @change="fileChanged"
                                                            name="file"
                                                            ref="FileInput"
                                                        />
                                                        </button>
                                                </div>
                                            </div>
                                    </div>
                                    <div
                                        v-else
                                        class="border p-5"
                                    >
                                        <h6 class="text-center te xt-black-50">{{ fileName }}</h6>
                                        <div class="text-center">
                                            <button
                                                @click.prevent="removeFile()"
                                                style="
                          font-size: 24px;
                          color: #666666;
                          background: #ffffff;
                          outline: none;
                          border: none;
                          cursor: pointer;
                        "
                                            >
                                                <i class="far fa-trash-alt"></i>
                                                </button>
                                        </div>
                        </div>
                </div>
                </DropFile>
                <div class="form-group mt-3">
                    <!-- <label for="">Date Created</label> -->
                    <label for="">
                        <label>Date Created</label>
                        <!-- <Tooltip
                    id="fi-doc-number"
                    title=""
                    content="e.g 2019-12-30 for 30-DEC-2019"
                  /> -->
                    </label>
                    <input
                        v-model="selectedVideo.creation_date"
                        name="creation_date"
                        required
                        class="form-control"
                        placeholder="e.g 2019-12-30 for 30-DEC-2019"
                        type="text"
                    />
                </div>

                <input
                    hidden
                    :value="selectedVideo.id"
                    name="video_id"
                    type="text"
                />
                <div class="form-group text-center">
                    <button
                        @click.prevent="uploadVideo"
                        :disabled="isProcessing"
                        class="present-tense-btn present-tense-primary px-6 mt-3 mb-3"
                    >
                        <span>
                            <i
                                v-if="isProcessing"
                                class="fa fa-spinner fa-spin"
                            ></i>
                        </span>
                        SAVE CHANGES
                        </button>
                </div>
            </div>
            </form>
            </div>
            </div>
            </div>

            <div
                class="modal"
                id="showVideo"
            >
                <div class="modal-dialog modal-lg">
                    <div
                        v-if="displayVideo"
                        class="modal-content px-2 py-2"
                    >
                        <p class="text-lg">{{ displayVideo.video_dvd_name }}</p>
                        <!-- {{selectedVideo}} -->
                        <iframe
                            id="vid-show"
                            autoplay="false"
                            width="100%"
                            height="400px"
                            :src="
              displayVideo.video_path
                ? '/storage' + displayVideo.video_dvd_path
                : displayVideo.video_dvd_path
            "
                            frameborder="0"
                            gesture="media"
                            allow="encrypted-media"
                            allowfullscreen
                        ></iframe>
                </div>
                </div>
                </div>
                </div>
</template>

<script>
import { VueEditor } from "vue2-editor";
import Swal from "sweetalert2";
import dragAndDropHelper from "./../../mixin/dragAndDropHelper";
import Izitoast from "./../../mixin/IziToast";
import DropFile from "./../../common/DropFile";
import Tooltip from "./../../common/DropFile";

export default {
  components: {
    VueEditor,
    DropFile,
    Tooltip
  },
  mixins: [dragAndDropHelper, Izitoast],
  data() {
    return {
      dvdVideos: [],
      selectedVideo: {},
      displayVideo: null,
      uploadedVideo: null,
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
            header: [false, 1, 2, 3, 4, 5, 6]
          }
        ],
        ["bold", "italic", "underline", "strike"],
        [
          {
            align: ""
          },
          {
            align: "center"
          },
          {
            align: "right"
          },
          {
            align: "justify"
          }
        ],
        [
          {
            list: "ordered"
          },
          {
            list: "bullet"
          }
        ],
        [
          {
            indent: "-1"
          },
          {
            indent: "+1"
          }
        ]
      ]
    };
  },

  mounted() {
    let app = this;
    app.getAllDVDVideos();
    app.$on("video-uploaded", data => {
      app.uploadedVideo = data;
      //   console.log("VIDEO DATA: ", data);
    });

    app.$on("video-removed", () => {
      app.uploadedVideo = null;
    });

    console.log("Uploaded vdeo: ", app.uploadedVideo);
    app.getTenMajorSongs();
  },
  methods: {
    showVideo(video) {
      console.log("VIDE: ", video);
      this.displayVideo = video;
      $("#showVideo").modal("show");
    },

    getAllDVDVideos() {
      let app = this;
      $.ajax({
        url: "/api/video-dvd/list",
        success(data) {
          app.dvdVideos = data;
        }
      });
      console.log("DVD VIDEOS", app.dvdVideos);
    },
    isValid() {
      if (!this.selectedVideo.video_dvd_name) {
        Swal.fire(
          "Failed!",
          "<p style='font-size: 14px;'>DVD name is required!</p>",
          "warning"
        );
        // this.showErrorMessage("DVD name is required");
        return false;
      }
      if (!this.selectedVideo.creation_date) {
        Swal.fire(
          "Failed!",
          "<p style='font-size: 14px;'>DVD creation date is required!</p>",
          "warning"
        );
        // this.showErrorMessage("DVD creation date is required");
        return false;
      }
      if (!this.uploadedVideo) {
        Swal.fire(
          "Failed!",
          "<p style='font-size: 14px;'>Browse and Upload a video!</p>",
          "warning"
        );
        // this.showErrorMessage("Browse and Upload a video");
        return false;
      }
      return true;
    },

    uploadVideo() {
      let app = this;
      let form = $("#videos-form");
      let modal = $("#modal-upload-video");
      if (form.valid()) {
        if (!this.isValid()) {
          return;
        }
        app.isProcessing = true;
        var formData = new FormData(document.getElementById("videos-form"));
        formData.append("file", app.uploadedVideo);
        $.ajax({
          processData: false,
          contentType: false,
          enctype: "multipart/form-data",
          type: "post",
          url: "/api/video-dvd/create-video-dvd",
          data: formData,
          success(data) {
            app.isProcessing = false;
            Swal.fire(
              "<p style='font-size: 14px;'>Video Successfully Saved</p>",
              "",
              "success"
            );
            app.getAllDVDVideos();
            modal.modal("hide");
            document.getElementById("videos-form").reset();
            $("#videos-form").trigger("reset");
            this.uploadedVideo = null;
            app.selectedVideo.video_dvd_name = "";
            app.selectedVideo.creation_date = "";

            // form.reset();
          },
          error(e) {
            modal.modal("hide");
            app.isProcessing = false;

            Swal.fire(
              "<p style='font-size: 14px;'>Error Occured</p>",
              e,
              "warning"
            );
            app.showErrorMessage(app.formatAjaxError(e));
          }
        });
      }
    },

    saveSong() {
      let app = this;
      let form = $("#song-form");
      let formModal = $("#single-song-modal");

      let songFormData = new FormData();
      if (this.editmode) {
        songFormData.append("song_id", this.selectedSong.id),
          songFormData.append("song_number", this.selectedSong.song_number),
          songFormData.append("song_title", this.songTitle),
          songFormData.append("song_body", this.songBody);
      } else {
        songFormData.append("song_number", this.songNumber),
          songFormData.append("song_title", this.songTitle),
          songFormData.append("song_body", this.songBody);
      }

      if (form.valid()) {
        app.isProcessing = true;
        //console.log("SERIALIZED: ", form.serialize());
        axios({
          method: "post",
          url: "/api/ten-major/create-ten-major-song",
          data: songFormData
          //form.serialize(),
        })
          .then(response => {
            app.isProcessing = false;
            app.getTenMajorSongs();
            formModal.modal("hide");
            //======dismiss the model
            this.closeModel();
            Swal.fire({
              icon: "success",
              title: "Success",
              html:
                "<p class='font-size: 13px'>Song Successfully Submitted</p>",
              showConfirmButton: true,
              allowOutsideClick: false,
              showCloseButton: true,
              confirmButtonText: "Ok",
              confirmButtonColor: "#32CD32"
            }).then(result => {
              if (result.isConfirmed) {
                // window.location.href = "/list";
              }
            });
          })
          .catch(error => {
            app.isProcessing = false;
            this.errors = error.response.data.errors;
            formModal.modal("hide");
            app.showErrorMessage(error.response.data.errors);
          });
      }
      //   let app = this;
      //   app.editmode = true;

      //   if (app.selectedSong != null) {
      //     app.requestFormData.append("bsc_request_id", app.request.id);
      //     app.requestFormData.append("edited_request", true);
      //   }
    },

    updateSong(item) {
      let app = this;
      app.editmode = true;
      app.selectedSong = item;
      app.songTitle = item.song_title;
      app.songBody = item.song_body;
      $("#single-song-modal").modal("show");
    },

    viewSongDetail(item) {
      let app = this;
      app.editmode = true;
      app.selectedSong = item;
      app.songTitle = item.song_title;
      app.songBody = item.song_title + "<br/>" + item.song_body;
      $("#single-song-modal-detail").modal("show");
    },

    deleteVideoDVD(id) {
      let app = this;
      Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "question",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
      }).then(result => {
        if (result.isConfirmed) {
          $.ajax({
            url: "/api/video-dvd/delete-video-dvd",
            type: "post",
            data: {
              video_id: id
            },
            success(data) {
              Swal.fire(
                "<p style='font-size: 14px;'>Video Deleted Successfully</p>",
                "",
                "success"
              );
              app.getAllDVDVideos();
            },
            error(e) {
              //   app.showAjaxError(e);
            }
          });
        }
      });
    },

    getTenMajorSongs() {
      let app = this;
      axios
        .get("api/ten-major/list")
        .then(response => {
          app.tenMajorSongs = response.data;
        })
        .catch(error => {
          //   app.showErrorMessage(error.response.data);
        });
    },

    uploadFile() {
      let app = this;
      app.isProcessing = true;
      let formData = new FormData();
      formData.append("file", app.file);

      axios({
        method: "post",
        url: "api/ten-major/import-ten-major-songs",
        data: formData,
        headers: {
          "Content-Type": "multipart/form-data"
        }
      })
        .then(response => {
          app.isProcessing = false;
          app.importResults = response.data;
          app.getTenMajorSongs();
          app.closeDialog();
          Swal.fire({
            icon: "success",
            title: "Success",
            html: "<p class='font-size: 13px'>Song  Successfully Submitted</p>",
            showConfirmButton: true,
            allowOutsideClick: false,
            showCloseButton: true,
            confirmButtonText: "Ok",
            confirmButtonColor: "#32CD32"
          }).then(result => {
            if (result.isConfirmed) {
              // window.location.href = "/list";
            }
          });
        })
        .catch(error => {
          this.isProcessing = false;
          //   app.showErrorMessage(error.response.data);
          this.errors = error.response.data.errors;
        });
    },

    downloadSongTemplate() {
      window.location.href = "/download-song-template";
    },

    //   const url = URL.createObjectURL(new Blob([response.data], {
    //         type: 'application/vnd.ms-excel'
    //     }))
    downloadTemplate() {
      let app = this;
      let file = "song_template.xlsx";

      axios
        .get("/api/user/download-song-template", {
          params: {
            fileName: "song_template.xlsx"
          },
          responseType: "blob"
        })
        .then(response => {
          const url = window.URL.createObjectURL(new Blob([response.data]));
          const link = document.createElement("a");
          link.href = url;
          link.setAttribute("download", file);
          document.body.appendChild(link);
          link.click();
        })
        .catch(error => {
          //app.showErrorMessage(error.response.data);
        });
    },

    showAddSingleSongModal() {
      let app = this;
      app.selectedSong = null;
      (app.songBody = ""),
        (app.songTitle = ""),
        $("#single-song-modal").modal("show");
    },

    closeModel() {
      $("#single-song-modal").modal("hide");
      $("#single-song-modal-detail").modal("hide");
      $("#modal-upload-video").modal("hide");
    },

    showUploadExcel() {
      $("#modal-upload-song-excel").modal(
        {
          backdrop: "static",
          keyboard: false
        },
        "show"
      );
    },

    showUploadVideo() {
      $("#modal-upload-video").modal(
        {
          backdrop: "static",
          keyboard: false
        },
        "show"
      );
    },

    processSelectedFile(fileData) {
      let app = this;
      if (
        fileData.ext.toLowerCase() !== "xls" &&
        fileData.ext.toLowerCase() !== "xlsx"
      ) {
        app.file = null;
        app.hasFile = false;
        Swal.fire({
          icon: "error",
          title: "Invalid File",
          text: "File must be in excel format"
        });
      } else {
        app.file = fileData.file;
        app.hasFile = true;
      }
    },

    removeFile() {
      (this.file = null), (this.hasFile = false);
    },
    onBrowseFile(e) {
      let app = this;
      app.processSelectedFile(app.fileData(e, "browse"));
    },

    closeDialog() {
      let app = this;
      app.file = null;
      app.hasFile = false;
      app.isProcessing = false;
      $("#modal-upload-song-excel").modal("hide");
    }
  }
};
</script>



<style lang="scss" scoped>
.present-tense-table th,
.present-tense-table td {
  font-size: 13px !important;
}

#song-title .ql-editor {
  height: 20px;
}

.dropdown-toggle::after {
  display: inline-block;
  margin-left: 0.255em;
  vertical-align: 0.255em;
  content: "";
  border-top: 0.3em solid;
  border-right: 0.3em solid transparent;
  border-bottom: 0;
  border-left: 0.3em solid transparent;
  //   float: right !important;
  margin-top: 8px !important;
  margin-right: 5px;
}

.img-logo {
  height: 30px !important;
}

.dropdown-menu {
  min-width: 8rem !important;
}

.container {
  text-align: center;
}

.progress-container {
  display: flex;
  justify-content: space-between;
  position: relative;
  max-width: 100%;
  width: 150px;
  margin-bottom: 2.5em;

  &::before {
    content: "";
    position: absolute;
    top: 50%;
    left: 0;
    height: 4px;
    width: 150px;
    background-color: #bdbdbd;
    z-index: 1;
  }
}

.progress-indicator {
  position: absolute;
  top: 50%;
  left: 0;
  width: 0;
  height: 4px;
  background-color: #2c6ec8;
  z-index: 1;
  transition: all 0.5s ease-in;
}

.circle-item {
  background-color: #fff;
  height: 20px;
  width: 20px;
  display: flex;
  justify-content: center;
  align-items: center;
  border: 2px solid #bdbdbd;
  border-radius: 50%;
  transition: all 0.4s ease-in;
  z-index: 2;

  &.completed {
    border-color: #2c6ec8;
    background-color: #2c6ec8;
    color: #fff;
    box-shadow: 0 0 31px -2px rgba(44, 110, 200, 0.62);
  }
}

.done {
  width: 100% !important;
}

.alert-dismissible .close {
  position: absolute;
  top: 0;
  z-index: 2;
  padding: 0.75rem 1.25rem;
  color: inherit;
  left: 0;
  margin-right: 30px;
}

.alert {
  position: relative;
  padding: 0.75rem 3.95rem;
  margin-bottom: 1rem;
  border: 1px solid transparent;
  border-radius: 0.25rem;
  text-align: left;
}

#loader {
  position: absolute;
  left: 50%;
  top: 50%;
  z-index: 1;
  width: 50px;
  height: 50px;
  margin: 1px 0 0 -26px;
  border: 8px solid #f3f3f3;
  border-radius: 50%;
  border-top: 8px solid #3498db;
  -webkit-animation: spin 2s linear infinite;
  animation: spin 2s linear infinite;
}

@-webkit-keyframes spin {
  0% {
    -webkit-transform: rotate(0deg);
  }

  100% {
    -webkit-transform: rotate(360deg);
  }
}

@keyframes spin {
  0% {
    transform: rotate(0deg);
  }

  100% {
    transform: rotate(360deg);
  }
}

.hideLoader {
  display: none;
}
</style>
