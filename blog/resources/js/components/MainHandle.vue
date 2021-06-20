<template>
    <article>
        <keep-alive>
            <router-view
                :token="token"
                :item_obj="item_obj"
                :data_name="data_name"
            ></router-view>
        </keep-alive>
    </article>
</template>

<script>

    export default {
        props: {
            token: String,
            obj:Object,
        },
        data: function () {
            return {
                item_obj:null,
                data_name:null,
            }
        },
        watch:{
            $route(to,from){
                this.changeitem_obj(to.path)
            }
        },
        beforeRouteUpdate(to, from, next) {
            this.current_page = to.query.page
            next()
        },
        methods: {
            // getAPIs:async function () {
            //     // 6/19　laravel側で直接データを注入する
            //     // 結局すべてのresponceを待機することになりPromise.allでawaitする必要性が薄く
            //     // 使用頻度の高いと思われるpostを優先して先にawaitし即代入した方がユーザー利便性に優れると思われる

            //     let path = this.$appRootPath + this.$appApiPrefix

            //     let res1,res2

            //     try {
            //         [res1,res2] = await Promise.all([
            //         axios
            //             .get(path + '/post' ,{params:{api_token:this.token}})
            //             .catch(e => { throw 'get1 error '+e.message}),

            //         axios
            //             .get(path + '/term' ,{params:{api_token:this.token}})
            //             .catch(e => { throw 'get2 error '+e.message}),
            //         ]);
            //     } catch(err) {
            //         console.log(err);
            //     }

            //     this.posts = res1.data
            //     this.terms = res2.data

            //     let rootPath = this.$route.path
            //     if(this.$appPath != rootPath){
            //         if(rootPath.includes(this.$appPath + '/post')){
            //             this.changeitem_obj('post')
            //         }
            //         else if(rootPath.includes(this.$appPath + '/term')){
            //             this.changeitem_obj('term')
            //         }
            //     }
            // },
            changeitemObj:function(path){
                // MainComponentへ渡すitem_objの切り替えを行

                for(let key in this.obj){
                    if(path.includes(key)){
                        this.data_name = key
                        this.item_obj = this.obj[key]
                    }
                }

            }
        },
        created: function () {
            this.changeitemObj(this.$route.path)
        }


    }
</script>

<style scoped>
</style>
