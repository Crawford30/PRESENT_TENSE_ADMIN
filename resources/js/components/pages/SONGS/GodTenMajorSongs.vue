<template>
  <div class="dvd-view">
    <div class="container">
      <div class="row my-3">
        <div class="col-md-9 text-left">
          <h4>God Ten Major Songs</h4>
        </div>
        <div class="col-md-3">
          <div class="btn-group add-new-dropdown" style="width: 100%">
            <div class="btn-group w-100" role="group">
              <button
                type="button"
                class="btn btn-primary"
                @click="showAddSingleSongModal"
              >
                Add Song
              </button>
              <button
                type="button"
                class="btn btn-primary dropdown-toggle dropdown-toggle-split"
                data-toggle="dropdown"
                aria-haspopup="true"
                aria-expanded="false"
              >
                <div class="dropdown-menu">
                  <div
                    class="border-bottom dropdown-item text-center"
                    @click="showAddSingleSongModal"
                  >
                    <img
                      src="/images/icons/user_folder.png"
                      alt="single image"
                      class="img-logo"
                    />
                    <p class="font-weight-light small mt-1">Single Record</p>
                  </div>
                  <div class="border-bottom dropdown-item text-center">
                    <img
                      src="/images/icons/upload_purple.png"
                      alt="single image"
                      class="img-logo"
                    />
                    <p class="font-weight-light small mt-1">Batch Upload</p>
                  </div>
                  <a class="pt-2 mb-0 dropdown-item text-center">
                    <img
                      src="/images/icons/icon.excel.png"
                      alt="single image"
                      class="img-logo"
                      style="height: 25px !important"
                    />
                    <p class="font-weight-light small mt-1">
                      Download<br />Template
                    </p>
                  </a>
                </div>
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
                  <th>SONG NUMBER</th>
                  <th>SONG TITLE</th>
                  <th>DATE CREATED</th>
                  <th>ACTIONS</th>
                </tr>
              </thead>
            </table>
          </div>

          <!-- </div> -->
        </div>
      </div>
    </div>

    <div class="modal fade" id="single-song-modal">
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
            <h5 style="text-align: center; font-weight: bold">
              Add Ten Major Song
            </h5>
            <br />
            <hr />

            <form id="song-form" ref="songRef">
              <input
                hidden
                name="id"
                v-if="selectedSong != null"
                :value="selectedSong.id"
              />

              <div class="form-group">
                <label>Song Number</label>
                <input
                  v-if="selectedSong != null"
                  :value="selectedSong.song_number"
                  name="song_number"
                  type="text"
                  class="form-control"
                  autocomplete="off"
                  placeholder="Song Number"
                  required
                />
                <input
                  v-else
                  name="song_number"
                  type="text"
                  class="form-control"
                  autocomplete="off"
                  placeholder="Song Number"
                  required
                />
              </div>
              <!-- <p style="color: red">Song number is required</p> -->

              <div class="form-group">
                <label>Song Title</label>
                <vue-editor
                  id="song-title"
                  placeholder="Please Type Song Title Here"
                  :disabled="false"
                  v-model="songTitle"
                  :editorToolbar="defaultToolbar"
                ></vue-editor>
              </div>

              <div class="form-group">
                <label>Song Body</label>
                <vue-editor
                  id="song-body"
                  placeholder="Please Type Song Body Here"
                  :disabled="false"
                  v-model="songBody"
                  :editorToolbar="defaultToolbar"
                ></vue-editor>
              </div>
            </form>

            <div class="row d-flex justify-content-center">
              <div class="col-4 px-6">
                <div class="text-center mt-2">
                  <button
                    type="button"
                    class="present-tense-btn present-tense-secondary"
                    @click="closeModel"
                  >
                    <span> Close</span>
                  </button>
                </div>
              </div>
              <div class="col-4">
                <div class="text-center mt-2">
                  <button
                    :disabled="isProcessing"
                    type="button"
                    class="present-tense-btn present-tense-primary"
                    @click="saveSong"
                  >
                    <i
                      v-if="isProcessing"
                      id="sendlog-spinner-spinner"
                      class="fa fa-spinner fa-spin"
                    ></i>
                    <span>Save</span>
                  </button>
                </div>
              </div>
            </div>

            <!-- <div class="w-100 d-flex justify-content-center text-center">
              <div class="w-100 d-flex justify-content-center text-center mt-3">
                <button
                  :disabled="isProcessing"
                  @click.prevent="saveSong"
                  type="submit"
                  class="present-tense-btn present-tense-primary btn btn-primary px-6 myButton"
                >
                  <span>
                    <i v-if="isProcessing" class="fa fa-spinner fa-spin"> </i>
                    SAVE</span
                  >
                </button>
              </div>
            </div> -->
          </div>
        </div>
      </div>
    </div>
    <!-------Add Single Grant  End------>
  </div>
</template>

<script>
import { VueEditor } from "vue2-editor";

export default {
  components: {
    VueEditor,
  },
  data() {
    return {
      file: null,
      hasFile: false,
      isProcessing: false,
      songTitle: "",
      songBody: "",
      selectedSong: null,
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
    console.log("Component mounted.");
  },
  methods: {
    saveSong() {},

    showAddSingleSongModal() {
      let app = this;
      app.selectedSong = null;
      $("#single-song-modal").modal("show");
    },

    updateGrant(item) {
      let app = this;
      app.selectedSong = item;
      //console.log("UPDATE GRANT: ", app.selectedGrant);
      $("#single-song-modal").modal("show");
    },

    closeModel() {
      $("#single-song-modal").modal("hide");
    },
  },
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
  float: right !important;
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
