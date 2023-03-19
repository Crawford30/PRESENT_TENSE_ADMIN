<template>
    <div class="pt-3 px-3">
        <div class="row m-0 mx-0 my-0">
            <div
                class="col-md-12"
                style="padding: 0 !important;"
            >
                <nav
                    class="nav nav-fill nav-tab"
                    id="present-tense-tabs-settings"
                >
                    <a
                        data-tab="0"
                        class="nav-item nav-link active"
                    >Audio DVDS Permissions</a>
                        <a
                            data-tab="1"
                            class="nav-item nav-link"
                        >Video DVDS Permissions</a>
                            </nav>
        </div>
        <div
            class="col-md-12 m-0 mx-0 my-0"
            style="padding: 0 !important;"
        >
            <div
                class="staff-card shadow mb-4"
                style="margin-top: 6px;"
            >
                <AudioDVDPermissionSetting
                    v-if="tab == 0"
                    key="audio-dvd-settings"
                />
                <VideoDVDPermissionSetting
                    v-if="tab == 1"
                    key="video-dvd-setting"
                />

    </div>
    </div>
    </div>
    </div>
</template>

<script>
import AudioDVDPermissionSetting from "./DVDSETTINGS/AudioDVDPermission";
import VideoDVDPermissionSetting from "./DVDSETTINGS/VideoDVDPermission";

export default {
  name: "Settings",
  //   props: ["user"],
  components: {
    AudioDVDPermissionSetting,
    VideoDVDPermissionSetting
  },
  data() {
    return {
      tab: 0,
      session: null
    };
  },
  mounted() {
    let app = this;
    // app.session = JSON.parse(app.user);

    $("#present-tense-tabs-settings a").click(function() {
      var t = $(this).attr("data-tab");
      app.tab = parseInt(t);
      $(this)
        .addClass("active")
        .siblings()
        .removeClass("active");
    });
  },
  methods: {}
};
</script>

<style scoped>
.nav-link {
  color: #666666 !important;
  font-size: 15px !important;
  cursor: pointer !important;
  font-weight: 500;
  border-bottom: 1px solid #999999;
}

.nav-link.active {
  border-bottom-color: #666666 !important;
}
</style>
