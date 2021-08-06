<template>
    <div
        :class="['simple-card','simple-card__status--' + status]"
        @click="emitAction( 'edit' , 'editer')"
    >
        <div class="simple-card__background-word">{{ status.toUpperCase() }}</div>

        <div class="wrapper">
            <div class="simple-card__date">
                <p>created  : {{ createdAt }}</p>
                <p v-if="updatedAt" >updated : {{ updatedAt }}</p>
            </div>

            <div class="simple-card__title">
                <h2>{{ name }}</h2>
            </div>

            <ul class="simple-card__command">
                <li
                    class="command--preview"
                    @click.stop="emitAction( 'preview' , 'viewer')"
                >
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M7 18H17V16H7V18Z" /><path d="M17 14H7V12H17V14Z" /><path d="M7 10H11V8H7V10Z" /><path fill-rule="evenodd" clip-rule="evenodd" d="M6 2C4.34315 2 3 3.34315 3 5V19C3 20.6569 4.34315 22 6 22H18C19.6569 22 21 20.6569 21 19V9C21 5.13401 17.866 2 14 2H6ZM6 4H13V9H19V19C19 19.5523 18.5523 20 18 20H6C5.44772 20 5 19.5523 5 19V5C5 4.44772 5.44772 4 6 4ZM15 4.10002C16.6113 4.4271 17.9413 5.52906 18.584 7H15V4.10002Z" /></svg>
                </li>
                <li
                    class="command--delete"
                    @click.stop="emitAction( 'delete' , 'editer' )"
                >
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M17 5V4C17 2.89543 16.1046 2 15 2H9C7.89543 2 7 2.89543 7 4V5H4C3.44772 5 3 5.44772 3 6C3 6.55228 3.44772 7 4 7H5V18C5 19.6569 6.34315 21 8 21H16C17.6569 21 19 19.6569 19 18V7H20C20.5523 7 21 6.55228 21 6C21 5.44772 20.5523 5 20 5H17ZM15 4H9V5H15V4ZM17 7H7V18C7 18.5523 7.44772 19 8 19H16C16.5523 19 17 18.5523 17 18V7Z" /><path d="M9 9H11V17H9V9Z" /><path d="M13 9H15V17H13V9Z" /></svg>
                </li>
            </ul>
        </div>
    </div>
</template>

<script>
    // export default {
    module.exports={
        props: {
            created_at: {type:[String],default:'1111-01-01'},
            updated_at: {type:[String],default:'1111-01-01'},
            status: {type:[String],default:'private'},
            name: {type:[String],default:'TesttextTesttextTesttextTesttextTesttext'},
            id: Number,
        },
        computed:{
            createdAt:function(){
                return this.toDateStringFormat(new Date(this.created_at))
            },
            updatedAt:function(){
                return this.toDateStringFormat(new Date(this.updated_at))
            }
        },
        methods: {
            toDateStringFormat:function(date){
                if(isNaN(date)){ return '' }
                const y = date.getFullYear()
                const m = date.getMonth() + 1
                const d = date.getDate()

                return y + ' / ' + m + ' / ' + d
            },
            emitAction: function (action,key) {
                this.$emit('emit', this.id , action ,key )
            }
        }
    }
</script>

<style scoped>
    .simple-card__status--public{
        background: #93c988;
    }
    .simple-card__status--member{
        background: #8592e7;
    }
    .simple-card__status--private{
        background: #ff6068;
    }
    .simple-card__background-word{
        color: rgb(255, 255, 255);
    }
    .simple-card__command > li {
        background: #367678;
        fill:white;
    }
    .simple-card__command .command--delete {
        background: #DE7358 !important;
    }

    .simple-card:hover {
        background: rgba(0, 0, 0, 0.75);
    }
        .simple-card:hover .simple-card__title,
        .simple-card:hover .simple-card__date{
            color: white;
        }


    .simple-card {
        backface-visibility: hidden;

        position: relative;

        width: 100%;
        min-height: 10rem;
        height: auto;
        
        transition: all 0.2s;

        -webkit-font-smoothing: antialiased;
        -moz-osx-font-smoothing: grayscale;
        backface-visibility: hidden;
    }

    .simple-card > .wrapper {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;

        padding: 1rem;
    }

    .simple-card h2{
        margin: 0;
        word-break: break-all;
    }

    .simple-card__background-word{
        position:absolute;
        bottom: 0;
        left: 1rem;

        font-weight: bold;
        font-size: 3rem;
    }

    .simple-card__title {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;

        margin: auto 0;
        padding:1rem;
    }

    .simple-card__command {
        list-style:none;

        display:flex;
        align-items:center;
        justify-content:flex-end;
        flex-wrap:nowrap;

        margin-left: auto;
        margin-bottom:0;
        padding:0;
    }

        .simple-card__command > li {
            cursor:pointer;

            display: flex;
            align-items: center;
            justify-content: center;

            width: 3rem;
            height: 3rem;
            margin: 0 0.25rem;

            border-radius: 1.5rem;
        }
        
        .simple-card__command svg{
            /* stroke: inherit; */
            width: 1.5rem;
            height: 1.5rem;
            fill: inherit;
        }

    .simple-card__date {
        margin: 0;
    }
        .simple-card__date p {
            font-size: 1rem;
            margin: 0;
        }
</style>
