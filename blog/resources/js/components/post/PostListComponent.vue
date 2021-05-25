<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">Example Component</div>

                    <div class="card-body">
                        test Post List
                        {{ info }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                info:null
            }
        },
        methods:{
            getPostList:function(routePath){
                let path = this.$appRootPath + routePath.replace(this.$appPath , this.$appApiPrefix)

                axios
                .get(path)
                .then(response => (this.info = response.data))
            }
        },
        created(){
            this.getPostList(this.$route.path)
        }
    }
</script>
