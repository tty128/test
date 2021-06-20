<template>
    <div
        :class="['card__wrapper','card__element_status_' + status]"
        @click = "emitAction( 'edit' , 'editer')"
    >
        <div class="card__element_at">
            <p>created : {{ created_at }}</p>
            <p
                v-if="updated_at !== null && updated_at !== 'undefined'"
            >
                updated : {{ updated_at }}
            </p>
        </div>

        <div class="card__container">
            <h2>{{ name }}</h2>
        </div>

        <ul class="card__element_command">
            <li
                class="preview"
                @click.stop="emitAction( 'preview' , 'viewer')"
            >
                <span>P</span>
            </li>
            <li
                class="delete"
                @click.stop="emitAction( 'delete' , 'editer' )"
            >
                <span>D</span>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        props: {
            created_at: String,
            updated_at: String,
            status: String,
            name: String,
            id: Number,
        },
        methods: {
            emitAction: function (action,key) {
                this.$emit('element_card_action', this.id , action ,key )
            }
        }
    }
</script>

<style scoped>
    .card__element_status_public{
        background: #E6F6D1;
    }
    .card__element_status_member{
        background: #E6F6D1;
    }
    .card__element_status_private{
        background: #E6F6D1;
    }


    .card__wrapper {
        backface-visibility: hidden;

        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;

        margin-bottom: 1.5rem;

        width: 30rem;
        min-height: 12.5rem;
        height: auto;

        margin: 0.75rem;
        padding: 1rem;

        border-radius: 2rem;

        transition: all 0.2s;
    }
        .card__wrapper:hover {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            backface-visibility: hidden;
            transform: translateX(-1rem);
            filter: drop-shadow(0px 0px 0.66rem rgba(47,72,88,.5));
        }

    .card__wrapper h2{
        margin: 0;
        word-break: break-all;
    }

    .card__container {
        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;

        margin: auto 0;
        padding:1rem;
    }

    .card__element_command {
        list-style:none;

        display:flex;
        align-items:center;
        justify-content:flex-end;
        flex-wrap:nowrap;

        margin-left: auto;
        margin-bottom:0;
        padding:0;
    }

        .card__element_command > li {
            cursor:pointer;

            display: flex;
            align-items: center;
            justify-content: center;

            width: 3rem;
            height: 3rem;
            margin: 0 0.25rem;

            border-radius: 1.5rem;
            background: #367678;
        }
        .card__element_command .delete {
            background: #DE7358 !important;
        }

    .card__element_at {
        margin: 0;
    }
        .card__element_at p {
            font-size: 1rem;
            margin: 0;
        }
</style>
