<template>
    <div ref="main">
<!--        <Layout v-if="auth && !loading"></Layout>-->
        <Login v-if="!loading"></Login>
<!--        <Block v-if="is_error">{{err_message}}</Block>-->
    </div>
</template>
<script>
    import Layout from './Layout';
    import Login from './Login';
    import Block from './Block';


    export default {
        name: 'App',
        data(){
            return {
                loading:false,
                is_error:false,
                err_message:'',
            }
        },
        methods:{

        },
        mounted() {

        },
        components: {
            Block,
            Layout,
            Login
        }
    }
</script>
