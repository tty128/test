<template>
    <div class="container">
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
            <router-view
             :token="token"
             :items="items"
            ></router-view>
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
    section {
        transition: all 0.5s;
    }

    section .post_create {
        backface-visibility: hidden;
        cursor: pointer;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 20rem;
        height: 4rem;
        margin: 1rem auto;
        font-size:1.3rem;
        color: white;
        border-radius: 2rem;
        background: #367678;
        transition: all 0.2s;
    }

        section .post_create:hover {

            transform: scale(1.01);
            filter: drop-shadow(0px 0px 0.66rem rgba(47,72,88,.5));
        }

    section .post_all {
        list-style: none;

        display: flex;
        align-items: flex-start;
        justify-content: center;
        flex-wrap: wrap;

        width: 100%;
        height: auto;

        margin: 0px auto;
        padding: 0px;
    }

</style>
