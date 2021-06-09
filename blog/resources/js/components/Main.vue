<template>
    <section>
        <div
             class="post_create"
             @click ="elementCardAction(null,'create')"
        >
            Create New Post
        </div>

        <laravel-pagination-limit
            @element_limit_action="elementLimitAction"
            :limits="limits"
        ></laravel-pagination-limit>

        <laravel-pagination
            :last_page="lastPage"
            :current_page="currentPage"
            :max_view_pages="paginate_max_pages"
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
            :last_page="lastPage"
            :current_page="currentPage"
            :max_view_pages="paginate_max_pages"
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
            token: String,
            items: Array,
        },
        data: function () {
            return {
                paginate_max_pages:5,
                limits:[12,24,36],
                limit: 12,
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
        methods: {
            elementLimitAction:function(num){
                console.log(num)
                this.limit = num
            },
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
