<template>
    <ul
        class="vue_paginate"
        v-if="lastPage > 1"
    >
        <li
            :class="['page-prev' , !isFirstPage() ? 'invisible' : '']"
            @click="pageRoutePrev()"
        >
            Prev
        </li>
        <li
            :class="['page-1' , startViewPages <= 0 ? 'invisible' : '']"
            @click="pageRoute(1)"
        >
            1
        </li>
        <li>
            <div
                v-for="n in  maxViewPages"
                :key="n"
                :class="['page-' + ( n + startViewPages ) , isCurrent( n + startViewPages ) ? 'paginate-current':'']"
                @click = "[isCurrent( n ) ? '':pageRoute( n )]"
            >
                {{ n + startViewPages }}
            </div>
        </li>
        <li
            :class="['page-' + lastPage , !(startViewPages >= maxViewPages) ? 'invisible' : '']"
            @click="pageRoute(lastPage)"
        >
            {{ lastPage }}
        </li>
        <li
            :class="['page-next' , !isLastPage() ? 'invisible' : '']"
            @click="pageRouteNext()"
        >
            Next
        </li>
    </ul>
</template>

<script>
    export default {
        props: {
            last_page: Number,
            current_page: Number,
            max_view_pages:Number,
        },
        computed:{
            lastPage:function(){
                return this.$isSetable(this.last_page) ? this.last_page : 1
            },
            maxViewPages:function(){
                let mvp = this.max_view_pages > this.last_page ? this.last_page : this.max_view_pages
                return mvp
            },
            startViewPages:function(){
                let n = 0
                let mvp = this.max_view_pages > this.lastPage ? this.lastPage : this.max_view_pages
                let mvp_r = Math.floor(mvp/2)

                let lp = this.$isSetable(this.last_page) ? this.last_page : 1
                let cp = this.$isSetable(this.crrent_page) ? this.crrent_page : 1

                if(cp - mvp_r <= 0 ){
                    n = 0
                }
                else if(cp + mvp_r >= lp){
                    n = lp - mvp
                }
                else{
                    n = cp - mvp_r
                }
                return n
            }
        },
        methods: {
            isCurrent: function (n) {
                this.current_page = typeof(this.current_page) == 'number' ? this.current_page : 1
                return n == this.current_page
            },
            isFirstPage: function () {
                return (this.last_page != 1 && this.current_page != 1)
            },
            isLastPage: function () {
                return (this.last_page != 1 && this.current_page != this.last_page)
            },
            pageRoute: function (n) {
                this.$router.push({ path: this.$route.path + '?page=' + n })
            },
            pageRouteNext: function () {
                let query = this.current_page + 1
                let pages = query > this.last_page ? this.last_page : query
                this.$router.push({ path: this.$route.path + '?page=' + pages })
            },
            pageRoutePrev: function () {
                let query = this.current_page - 1
                let pages = query < 1 ? 1 : query
                this.$router.push({ path: this.$route.path + '?page=' + pages })
            }
        }
    }
</script>

<style scoped>
    .vue_paginate {
        list-style:none;

        display:flex;
        align-items:center;
        justify-content:center;

        width: auto;

        margin:0 auto;
        padding:0;
    }

        .vue_paginate .invisible {
            pointer-events: none !important;
            opacity: 0 !important;
        }

        .vue_paginate li{
            display: flex;
            align-items: center;
            justify-content: center;
            width: auto;
        }

        .vue_paginate [class^="page-"] {
            user-select:none;
            cursor:pointer;

            display: flex;
            align-items: center;
            justify-content: center;

            width: auto;
            min-width: 2.5rem;
            height: 2.5rem;
            border-radius:1.25rem;

            margin:0 0.2rem;

            background: #E6F6D1;
        }

        .vue_paginate .page-next , .vue_paginate .page-prev {
            padding: 0 1rem;
        }

    .paginate-current {
        cursor: default !important;
        color:white;
        background: #367678 !important;
    }
</style>
