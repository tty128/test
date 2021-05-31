<template>
    <div 
        :class="['card__wrapper','card__element_status_' + status]"
        @click = "emitAction( 'edit' )"
    >
        <p class="card__element_at">
            <span>{{ created_at }}</span>
            <span 
                v-if="updated_at !== null && updated_at !== 'undefined'"
            > : {{ updated_at }}</span>
        </p>

        <h2>{{ name }}</h2>

        <ul class="card__element_command">
            <li 
                class="preview"
                @click.stop="emitAction( 'preview' )"
            >
                <span>P</span>
            </li>
            <li 
                class="delete"
                @click.stop="emitAction( 'delete' )"
            >
                <span>D</span>
            </li>
        </ul>
    </div>
</template>

<script>
    module.exports = {
        props: {
            created_at: String,
            updated_at: String,
            status: String,
            name: String,
            id: Number,
        },
        methods: {
            emitAction: function (action) {
                this.$emit('element_card_action', this.id , action )
            }
        }
    }
</script>

<style scoped>
    section {
        transition: all 0.5s;
    }

    .post_create {
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

        .post_create:hover {

            transform: scale(1.01);
            filter: drop-shadow(0px 0px 0.66rem rgba(47,72,88,.5));
        }

    .post_all {
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

    .post_body {
        backface-visibility: hidden;

        display: flex;
        align-items: center;
        justify-content: space-between;

        min-height: 5rem;
        margin-bottom: 1.5rem;

        width: 22rem;
        min-height: 15rem;
        height: auto;

        margin: 0.75rem;
        padding: 1rem 2rem;

        border-radius: 2rem;

        background: #E6F6D1;
        transition: all 0.2s;
    }
        .post_body:hover {
            -webkit-font-smoothing: antialiased;
            -moz-osx-font-smoothing: grayscale;
            backface-visibility: hidden;
            transform: translateX(-1rem);
            filter: drop-shadow(0px 0px 0.66rem rgba(47,72,88,.5));
        }

    .post_command {
        list-style:none;

        display:flex;
        align-items:center;
        justify-content:flex-end;
        flex-wrap:nowrap;

        width:30%;
        height:auto;
    }

        .post_command > li {
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
        .post_command .delete {
            background: #DE7358 !important;
        }

    .post_at {
        margin: 0 0.25rem;
    }
</style>