<template>
    <section>
        <!-- PageTop UI -->
        <div
             class="create"
             @click ="elementCardAction(null,'create')"
        >
            Create New {{ data_name.toUpperCase() }}
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
        <!-- PageTop UI End -->

        <!-- itemBody -->
        <ul class='item_all'
            v-if="data_name == 'post'"
        >
            <li
                v-for="item in limitArray"
                :key="item.post_id"
                class="item_body"
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

        <ul class='item_all'
            v-if="data_name == 'term'"
        >
            <li
                v-for="item in limitArray"
                :key="item.post_id"
                class="item_body"
            >
                <laravel-element-card
                    @element_card_action="elementCardAction"
                    :created_at = "item.created_at"
                    :updated_at = "item.updated_at"
                    status = "public"
                    :name = "item.term_name"
                    :id = "item.term_id"
                ></laravel-element-card>
            </li>
        </ul>
        <!-- itemBody End-->

        <!-- PageFooter UI -->
        <laravel-pagination
            :last_page="lastPage"
            :current_page="currentPage"
            :max_view_pages="paginate_max_pages"
        ></laravel-pagination>
        <!-- PageFooter UI End -->

        <!-- Fixed Element -->
        <laravel-modal
            @element_modal_action="elementModalAction"
            :event_on="modal"
            :token="token"
            :action="modal_action"
            :data_id="modal_post_id"
            :data_name="data_name"
        ></laravel-modal>
        <!-- Fixed Element End -->
    </section>
</template>

<script>

    export default {
        props: {
            token: String,
            items: Array,
            data_name:String
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
        computed:{
            currentPage:function(){
                // query params['page']が Number ならそのまま取得し、それ以外なら1を返す
                return (typeof(this.$route.query.page) == 'object' || typeof(this.$route.query.page) === "undefined") ? 1 : Number(this.$route.query.page)
            },
            lastPage:function(){
                // 最大ページ数を返す(itemsが存在しない場合は0を返す)
                return this.items == null ? 0 : Math.ceil(this.items.length / this.limit)
            },
            limitArray:function(){
                // 現在ページで表示するitemの配列をリミット数以下で返す
                let current_page = this.currentPage
                return this.items.slice( (current_page - 1) * this.limit , current_page * this.limit )
            },
        },
        methods: {
            elementLimitAction:function(num){
                // Component:PaginateLimitButtonから戻ってきた数値を変数に代入する
                this.limit = num
            },
            elementCardAction: function(...arg){
                // Component:ElementCardから戻ってきたidおよびaction名を各変数に代入（modalで使用）する
                // その後、modalを起動
                let [id, action] = arg
                this.modal_post_id=id
                this.modal_action=action

                this.modal = true
            },
            elementModalAction:function (modal_switch){
                // Component:ElementModalから戻ってきたBoolean（基本false）
                // Modalで自身を閉じるための関数
                this.modal = modal_switch
            },

        }

    }
</script>

<style scoped>
    section {
        width: 90%;
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

</style>
