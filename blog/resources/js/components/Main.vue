<template>
    <section>
        <!-- PageTop UI -->
        <div
             class="create"
             @click ="childCardAction(null,'create','editer')"
        >
            Create New {{ this.data_name.toUpperCase() }}
        </div>

        <laravel-pagination-limit
            @element_limit_action="childLimitAction"
            :limits="limits"
        ></laravel-pagination-limit>

        <laravel-pagination
            :last_page="lastPage"
            :max_view_pages="paginate_max_pages"
        ></laravel-pagination>
        <!-- PageTop UI End -->

        <!-- itemBody -->
        <transition name="main-list" mode="out-in" appear>
            <ul class='item_all'
                v-if="data_name == 'post'"
            >
                <li
                    v-for="item in limitArray"
                    :key="item.post_id"
                    class="item_body"
                >
                    <laravel-element-card
                        @element_card_action="childCardAction"
                        :created_at = "item.created_at"
                        :updated_at = "item.updated_at"
                        :status = "item.post_status"
                        :name = "item.post_title"
                        :id = "item.post_id"
                    ></laravel-element-card>
                </li>
            </ul>

            <ul class='item_all'
                v-if="data_name == 'term'"
            >
                <li
                    v-for="item in limitArray"
                    :key="item.term_id"
                    class="item_body"
                >
                    <laravel-element-card
                        @element_card_action="childCardAction"
                        :created_at = "item.created_at"
                        :updated_at = "item.updated_at"
                        status = "public"
                        :name = "item.term_name"
                        :id = "item.term_id"
                    ></laravel-element-card>
                </li>
            </ul>
        </transition>
        <!-- itemBody End-->

        <!-- PageFooter UI -->
        <laravel-pagination
            :last_page="lastPage"
            :max_view_pages="paginate_max_pages"
        ></laravel-pagination>
        <!-- PageFooter UI End -->

        <!-- Fixed Element -->
        <transition name="modal-editer" appear>
            <div
                class="modal-editer_container"
                v-if="modal.editer"
            >
                <laravel-modal
                    @element_modal_action="childModalAction('editer')"
                    @element_modal_action_simple="childModalActionSimple"
                    @items_update="childItemsUpdate"
                    :token="token"
                    :action="modal_action"
                    :data_id="modal_post_id"
                    :data_name="data_name"
                ></laravel-modal>
            </div>
        </transition>

        <transition name="modal-viewer" appear>
            <div
                class="modal-viewer_container"
                v-if="modal.viewer"
            >
                <laravel-modal
                    @element_modal_action="childModalAction('viewer')"
                    :token="token"
                    action='preview'
                    :data_id="modal_post_id"
                    :data_name="data_name"
                ></laravel-modal>
            </div>
            <div
                class="modal-viewer_container"
                v-if="modal.simple"
            >
                <simple-modal
                    @element_modal_action="childModalAction('simple')"
                    action="preview"
                    :title="new_title"
                    :content="new_content"
                />
            </div>
        </transition>
        <!-- Fixed Element End -->
    </section>
</template>

<script>
    import SimpleModal from './ElementSimpleModal.vue'
    export default {
        props: {
            token: String,
            item_obj: Object,
            data_name:String
        },
        components:{
            SimpleModal
        },
        data: function () {
            return {
                items:null,
                paginate_max_pages:5,
                limits:[12,24,36],
                limit: 12,
                modal:{
                    editer:false,
                    viewer:false,
                    simple:false
                },
                modal_post_id:null,
                modal_action:null,
                new_title:"",
                new_content:"",
            }
        },
        computed:{
            currentPage:function(){
                // query params['page']が Number ならそのまま取得し、それ以外なら1を返す
                return (typeof(this.$route.query.page) == 'object' || typeof(this.$route.query.page) === "undefined") ? 1 : Number(this.$route.query.page)
            },
            lastPage:function(){
                // 最大ページ数を返す(itemsが存在しない場合は0を返す)
                return this.items[this.data_name] == null ? 0 : Math.ceil(this.items[this.data_name].length / this.limit)
            },
            limitArray:function(){
                // 現在ページで表示するitemの配列をリミット数以下で返す
                let item =this.items[this.data_name]
                let current_page = this.currentPage
                return item.slice( (current_page - 1) * this.limit , current_page * this.limit )
            },
        },
        methods: {
            childLimitAction:function(num){
                // Component:PaginateLimitButtonから戻ってきた数値を変数に代入する
                this.limit = num
            },
            childCardAction: function(...arg){
                // Component:ElementCardから戻ってきたidおよびaction名を各変数に代入（modalで使用）する
                // その後、modalを起動
                let [id, action,key] = arg
                this.modal_post_id=id
                if(action != 'preview'){
                    this.modal_action=action
                }
                this.modal[key] = true
            },
            childModalAction:function (key){
                // Component:ElementModalから戻ってきたBoolean（基本false）
                // Modalで自身を閉じるための関数
                if(key == 'simple'){
                    this.new_title = ""
                    this.new_content = ""
                }
                this.modal[key] = false
            },
            childModalActionSimple:function(...arg){
                let [title, content] = arg
                this.new_title = title
                this.new_content = content
                this.modal['simple'] = true
            },
            childItemsUpdate:function(obj){
                this.items[this.data_name] = obj[this.data_name]
            },
            getAPIs:async function () {
                let path = this.$appRootPath + this.$appApiPrefix
                try {
                    const res =  await axios.get(path + '/post' ,{params:{api_token:this.token}}).catch(e => { throw 'get1 error '+e.message}),
                } catch(err) {
                    console.log(err);
                }
                return res.data[this.data_name]
            },
        },
        created:function(){
            this.items = this.item_obj
        }
    }
</script>

<style scoped>
    /*
        section
    */
    @media screen and (min-width:480px) {
        section {width: 100%;}
    }
    @media screen and (min-width:1024px) {
        section {width: 768px;}
    }
    section {
        margin: 0 auto;
        transition: all 0.5s;
    }
    section .create {
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
        section .create:hover {
            transform: scale(1.01);
            filter: drop-shadow(0px 0px 0.66rem rgba(47,72,88,.5));
        }
    section .item_all {
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
    /*
        modal
    */
    .modal-editer-enter,.modal-editer-leave-to,
    .modal-viewer-enter,.modal-viewer-leave-to
    {
        transform: translateX(100vw);
    }
    .modal-editer-enter-to,.modal-editer-leave,
    .modal-viewer-enter-to,.modal-viewer-leave
    {
        transform: translateX(0);
    }
    .modal-editer_container,.modal-viewer_container{
        overflow-y: auto;
        position:fixed;
        top:0;
        left:0;
        bottom:0;
        width: 100%;
        transition: all 0.5s;
    }
</style>
