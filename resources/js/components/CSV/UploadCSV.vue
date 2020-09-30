<template>
  <div class="card bg-light mt-3">
    <div class="card-header">
      <strong>Upload CSV</strong>
    </div>
    <div class="card-body">
      <div class="form-group row">
        <div class="col-xs-2">
          <input
            type="file"
            accept=".csv"
            class="form-control"
            :class="{ ' is-invalid': error.message }"
            id="input-file-import"
            name="file_import"
            ref="import_file"
            required
            @change="onFileChange"
          />
          <div v-if="error.message" class="invalid-feedback"></div>
        </div>
      </div>
      <div class="my-2">
        <span v-if="!isUpload" class="text-danger"
          >Error occur uploading csv file</span
        >
        <span v-if="!$v.import_file.required" class="invalid-feedback"
          >CSV file is required</span
        >
      </div>
      <button class="btn btn-success active mt-2" @click="uploadCSV()">
        Upload CSV
      </button>
      <button class="btn btn-success active mt-2" @click="showUserInfo()">
        Show User Info
      </button>
    </div>
  </div>
</template> 
 <!--<template>
  <div class="row">
    <div class="form-row">
      <div class="col-md-12">
        <label class="form-control-label" for="input-file-import">Upload Excel File</label>
        <input
          type="file"
          accept=".csv"
          class="form-control"
          :class="{ ' is-invalid' : error.message }"
          id="input-file-import"
          name="file_import"
          ref="import_file"
          @change="onFileChange"
        />
        <div v-if="error.message" class="invalid-feedback"></div>
        <div class="my-2">
          <span v-if="!isUpload" class="text-danger">Error occur uploading csv file</span>
        </div>

        <button class="btn btn-success active mt-2" @click="proceedAction()">Import Data</button>
      </div>
    </div>
  </div>
</template>-->
<script>
import { required } from "vuelidate/lib/validators";
export default {
  data() {
    return {
      error: {},
      import_file: "",
      isUpload: true,
    };
  },
  validations: {
    import_file: { required },
  },
  methods: {
    onFileChange(e) {
      this.isUpload = true;
      this.import_file = e.target.files[0];
    },
    showUserInfo() {
      console.log("show user info");
       axios.defaults.headers.common["Authorization"] = `Bearer ${localStorage.getItem("token")}`;
      axios
        .post("http://localhost:8000/api/auth/me")
        .then((response) => {
          console.log(response);
        })
        .catch((error) => {
          console.log(error);
        });
    },
    uploadCSV() {
      console.log("upload");
      this.$v.$touch();
      if (this.$v.$invalid) {
        console.log("upload error");
        return;
      }
      let formData = new FormData();
      formData.append("csvfile", this.import_file);
      axios
        .post("/api/import", formData, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then((response) => {
          if (response.status === 200) {
            let upload = response["data"];
            if (upload.status == false) {
              this.isUpload = false;
            } else {
              this.isUpload = true;
              this.$router.push({
                name: "posts",
              });
            }
          }
        })
        .catch((error) => {
          this.uploading = false;
          this.error = error.response.data;
        });
    },
  },
};
</script>
