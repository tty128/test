<template>
    <div class="mainhandle__container">
        <aside>
            <ul>
                <router-link
                    @click.native="changeItems('post')"
                    :to="{name: 'post.list'}"
                    tag="li"
                >
                    Post
                </router-link>
                <router-link
                    @click.native="changeItems('term')"
                    :to="{name: 'term.list'}"
                    tag="li"
                >
                    term
                </router-link>
            </ul>
        </aside>
        <article>
            <keep-alive>
                <router-view
                 :token="token"
                 :items="items"
                ></router-view>
            </keep-alive>
        </article>
    </div>
</template>

<script>

    export default {
        props: {
            token: String
        },
        data: function () {
            return {
                items:null,
                posts:null,
                terms:null,
            }
        },
        beforeRouteUpdate(to, from, next) {
            this.current_page = to.query.page
            next()
        },
        methods: {
            getAPIs:async function () {
                let path = this.$appRootPath + this.$appApiPrefix

                let res1,res2

                try {
                    [res1,res2] = await Promise.all([
                    axios
                        .get(path + '/post' ,{params:{api_token:this.token}})
                        .catch(e => { throw 'get1 error '+e.message}),

                    axios
                        .get(path + '/term' ,{params:{api_token:this.token}})
                        .catch(e => { throw 'get2 error '+e.message}),
                    ]);
                } catch(err) {
                    console.log(err);
                }

                this.posts = res1.data
                this.terms = res2.data

                let rootPath = this.$route.path
                if(this.$appPath != rootPath){
                    if(rootPath.includes(this.$appPath + '/post')){
                        this.changeItems('post')
                    }
                    else if(rootPath.includes(this.$appPath + '/term')){
                        this.changeItems('term')
                    }
                }
            },
            changeItems:function($str){
                switch($str){
                    case 'post':
                        this.items=this.posts
                        break;
                    case 'term':
                        this.items=this.terms
                        break;
                    default:
                        this.items=this.posts
                        break;
                }
            }
        },
        created: function () {
            this.getAPIs()
        }


    }
</script>

<style scoped>
    .router-link-active{
        background: rgb(113, 202, 165);
        color:white;
    }

    .mainhandle__container {
        margin-top:5rem;
    }

    aside{
        position: fixed;
        left: 0;

        width: 20%;
    }

    article{
        position: relative;
        top:2rem;
        left: 20%;

        width: 80%;
    }

    aside ul {
        list-style: none;

        width: 100%;

        margin: 0;
        padding: 0;
    }

    aside ul li {
        cursor: pointer;
        user-select:none;

        display: flex;
        align-items: center;
        justify-content: center;

        width: 100%;
        min-height: 4rem;

        transition:all 0.3s;
    }

</style>
