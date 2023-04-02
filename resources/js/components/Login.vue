<template>
    <va-modal
        v-model="showModalPositionTop"  id="f1" :blur="true">
           <div v-if="!auth">
              <h1 class="title">
                Авторизация
              </h1>
              <div id="form">
                <va-form  action=""  style="width: 300px;" tag="form"
                    @submit.prevent="sendForm">

                        <va-input
                            v-model="login"
                            name="login"
                            label="login"
                        />

                        <va-input

                            v-model="password"
                            class="mt-3"
                            type="password"
                            label="Password"
                        />

                    <footer class="card-footer">
                      <div class="card-footer-item">
                          <va-button
                              id="auth"
                              type="submit"
                              class="mt-4"
                              :disabled="is_invalid"
                              native-type="submit"
                          >
                            Авторизация
                          </va-button>
                      </div>
                    </footer>
                  <Block v-if="auth_error" class="mb-0 mb-2 mr-4 ml-0 mt-4">{{auth_error_message}}</Block>
                </va-form>
              </div>
           </div>
           <Welcome v-if="auth"></Welcome>
    </va-modal>
  <va-button id="show" @click="showModalPositionTop = true; checkAuth()">
    Авторизация
  </va-button>

</template>


<script>
import Block from './Block';
import Welcome from './Welcome';

    export default {
      name: 'Login',
      components: {Welcome, Block},
      data(){
            return {
                login: '',
                password: '',
                is_invalid: true,
                auth_error: false,
                showModalPositionTop: true,
                auth_error_message: '',
                auth:false,
            }
        },
        methods:{
            sendForm(){
                let self = this;

                axios.post('/web_login',{login:self.login,password:self.password})
                    .then(
                        function(response){
                            self.$parent.auth = true;
                            self.auth_error = false;
                            self.auth = self.checkAuth();
                        },
                        function(error){
                            self.auth_error = true;
                            self.auth_error_message = error.response.data.message;
                        }
                    );
            },
            checkAuth(){
              let self = this;
              self.loading = true;

              axios.get('/cms/auth_check').
                then(
                  function(response){

                    self.loading = false;
                    self.auth = response.data;
                  },
                  function(error){
                    self.loading = false;
                    self.is_error = true;
                    self.err_message = error;

                  }
                )
            },
            // reloadPage() {
            //   window.location.reload();
            // }
        },
        mounted(){
          this.checkAuth();
        },
        watch: {
            login() {
                if (this.login && this.password) {
                    this.is_invalid = false;
                } else {
                    this.is_invalid = true;
                }
            },
            password() {
                if (this.login && this.password) {
                    this.is_invalid = false;
                } else {
                    this.is_invalid = true;
                }
            },

        }
    }
</script>

<style>
.va-modal__footer{
  display: none !important;
}
h1{
  margin-left: 30% !important;
  margin-bottom: 20px !important;
}
#form{
  margin-left: 7% !important;
}
#auth {
  margin-left: 20% !important;
}
#show{
  margin-left: 90% !important;
}
Block{
  width: 100% !important;
  margin-top: 7% !important;
  margin-left: -5% !important;
}

</style>