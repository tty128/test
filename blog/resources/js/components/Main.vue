<template>
    <section>

        <h1>test</h1>
        <div
             class="post_create"
             @click ="elementCardAction(null,'create')"
        >
            Create New Post
        </div>

        <laravel-pagination
            :last_page = "lastPage"
            :current_page = "currentPage"
        ></laravel-pagination>

        <ul class='post_all'>
            <li
                v-for="item in limitCount"
                :key="item.post_id"
                class="post_body"
            >
                <laravel-element-card
                    @element_card_action="elementCardAction"
                    :created_at = "item.created_at"
                    :updated_at = "item.updated_at"
                    :status = "item.post_status"
                    :name = "item.post_title"
                    :id = "item.post_id"
                ></laravel-element-card>
            </li>
        </ul>

        <laravel-pagination
            :last_page = "lastPage"
            :current_page = "currentPage"
        ></laravel-pagination>

        <laravel-modal
            @element_modal_action="elementModalAction"
            :event_on="modal"
            :token="token"
            :action="modal_action"
            :post_id="modal_post_id"
        ></laravel-modal>
    </section>
</template>

<script>

    export default {
        props: {
            token: String
        },
        data: function () {
            return {
                items: null,
                limit: 250,
                modal:false,
                modal_post_id:null,
                modal_action:null,
            }
        },
        beforeRouteUpdate(to, from, next) {
            this.current_page = to.query.page
            next()
        },
        computed:{
            currentPage:function(){
                return (typeof(this.$route.query.page) == 'object' || typeof(this.$route.query.page) === "undefined") ? 1 : Number(this.$route.query.page)
            },
            lastPage:function(){
                return this.items == null ? 0 : Math.ceil(this.items.length / this.limit)
            },
            limitCount:function(){
                let current_page = this.currentPage
                return this.items.slice( (current_page - 1) * this.limit , current_page * this.limit )
            },
        },
        watch:{
            modal : function(on){
                if(on){
                    const ws = -1 * window.scrollY
                    document.body.style.position = 'fixed'
                    document.body.style.top = ws +'px'
                    document.body.style.width = '100%'
                    document.body.style.paddingRight = '15px'
                }
                else{
                    const top = document.body.style.top
                    document.body.style.position = ''
                    document.body.style.top = ''
                    document.body.style.width = ''
                    document.body.style.paddingRight = ''
                    window.scrollTo(0, parseInt(top , '0') * -1)
                    this.getAPIs()
                }

            }
        },
        methods: {
            elementCardAction: function(...arg){
                let [id, action] = arg
                this.modal_post_id=id
                this.modal_action=action

                this.modal = true
            },
            elementModalAction:function (modal_switch){
                this.modal = modal_switch
            },
            getAPIs:async function () {
                let routePath = this.$route.path
                let path = this.$appRootPath + routePath.replace(this.$appPath , this.$appApiPrefix)

                const response = await axios
                    .get(path ,{params:
                        {
                            api_token:this.token
                        }
                    })

                this.items = response.data
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
