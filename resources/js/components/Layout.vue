<template>
    <div ref="layout">
        <b-navbar :mobile-burger="false" fixed-top shadow>
            <template slot="brand">
                <b-navbar-item @click="open = true">
                    <b-icon icon="menu" >
                    </b-icon>
                </b-navbar-item>
                <b-navbar-item @click="selectItem({path:'/',name:'home'})">
                    Управление сайтом
                </b-navbar-item>
            </template>
            <template slot="end">
                <b-navbar-item href="/cms/logout">
                    <b-icon icon="power">
                    </b-icon>
                </b-navbar-item>
            </template>
        </b-navbar>

        <b-sidebar fullheight overlay v-model="open">
            <b-menu class="p15">
                <b-menu-list label="Меню">
                    <b-menu-item v-for="(item,key) in menu" v-if="item.in_menu" v-bind:key="key" :label="item.title" :icon="item.icon" :active="$route.name === item.name" @click="selectItem(item)">
                    </b-menu-item>
                    <hr>
                    <b-menu-item tag="a" href="/cms/logout" label="Выход" icon="power">
                    </b-menu-item>
                </b-menu-list>
            </b-menu>
        </b-sidebar>
        <div class="container">
            <router-view>
            </router-view>
        </div>
    </div>
</template>
<script>



    export default {
        data() {
            return {
                open: false,
                me:{},
                menu:[],
            }
        },
        methods:{
            selectItem(item){
                if(this.$route.name != item.name){
                    this.$router.push(item.path);
                    this.open = false;
                }
            },

            getPersonal() {
                self = this;
                let preloader = self.$buefy.loading.open({
                    container: self.$refs.layout.$el
                });
                axios.get('/cms/personal').then(
                    function(response){
                        preloader.close();
                        self.me = response.data.user;
                        response.data.menu.forEach(function(item, k){
                            self.menu.push(
                                item
                            );
                            self.$router.addRoute(
                                {
                                    path: item.path,
                                    name: item.name,
                                    component : ()=> import('./'+item.component /* webpackChunkName: "[request]" */),

                                }
                            );
                        });
                    },
                    function(error){
                        preloader.close();
                        self.$buefy.snackbar.open({
                            message: error,
                            type: 'is-danger',
                            position: 'is-bottom',
                            actionText: 'ok',
                        })
                    }
                )
            }
        },
        mounted() {
            this.getPersonal();
        }
    }
</script>
