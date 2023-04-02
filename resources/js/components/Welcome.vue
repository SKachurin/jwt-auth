<template>
<h2>Welcome</h2>
  <va-file-upload v-if="!thanks"
      v-model="basic"
      type="single"
      dropzone
      file-types="xls,xlsx"
      v-on:fileAdded="fileAdded()"
  />
  <h2 v-if="thanks" >and</h2>
  <h2 v-if="thanks" v-html="thanks"></h2>

  <Block v-if="err_message" class="mb-0 mb-2 mr-4 ml-0 mt-4">{{err_message}}</Block>

  <h2 v-if="loaded" class="mb-0 mb-2 mr-4 ml-0 mt-4" v-html="loaded"></h2>
  <va-button v-if="loaded"
      onclick="window.location.href='/get_rows'"
      id="auth"

      class="mt-4"

  >
    See file
  </va-button>
</template>

<script type="module">
import Block from './Block';

  export default {
    components: {Block},
    data() {
      return {
        basic: [],
        thanks: '',
        loaded: '',
        file:'',
        err_message:'',
      };
    },
    methods:{
      fileAdded(){
        if(this.basic) {
          // console.log(this.basic)
          this.thanks = 'Thanks';
        }
        this.storeFile();
      },
      storeFile(){
        let self = this;
        self.loading = true;

        let formData = new FormData();
        formData.append('file', this.basic);
        axios.post('/store',formData,
            {
              headers: {
                'Content-Type': 'multipart/form-data'
              }
            }).
        then(
            function(response){
              self.loaded = response.data;

            },
            function(error){
              self.is_error = true;
              self.err_message = error;

            }
        )
      },
    },
    mounted() {
      console.log(this.basic)
    }
  }
</script>