<template>
    <div 
        id="Modal"
        :class="event_on ? 'visible' : ''"
    >
        <div
            class="close_button"
            @click="emitAction"
        >
            <span></span>
        </div>

        <h2>{{ title }}</h2>

        <form 
            v-if="state != 'preview' && state != 'delete' "
            _method="POST"
        >


        </form>
    </div>
</template>

<script>
    module.exports = {
        props: {
            event_on: Boolean,
            token:String,
            state:String,
            title:String,
            content:String,
        },
        data:function(){
            return {
                edit_title:'',
                edit_content:''

            }
        },
        methods: {
            emitAction: function () {
                this.$emit('element_modal_action', false )
            },
            sendAPIs:function( state ){
                switch(state){
                    case 'preview':
                        console.log( 'pre' )
                        break;
                    case 'edit':
                        console.log( 'edi' )
                        break;
                    case 'delete':
                        console.log( 'del' )
                        break;
                    default:
                        console.log( 'cre' )
                        break;
                }
            }
        }
    }
</script>

<style scoped>
    #Modal {
        z-index:10;

        position:fixed;
        top:0;
        left: 100%;

        width: 70vw;
        height: 100%;

        padding: 75px 2rem 0;

        background: rgb(113, 202, 165);
        color:white;
        filter: drop-shadow(0px 0px 0.66rem rgba(47,72,88,.5));

        transition:all 0.3s;
    }

    #Modal.visible {
        transform: translateX(-100%)
    }

    #Modal .close_button {
        display: flex;
        justify-content: center;
        align-items: center;
        width: 5rem;
        height: 5rem;

        border-radius: 2.5rem;

        color: rgb(113, 202, 165);
        background: white;
    }
        #Modal .close_button > span::before,
        #Modal .close_button > span::after {
            content: "";
        }
        #Modal .close_button > span::before {
            transform: rotate(45deg) translateY(0.7rem);
        }
        #Modal .close_button > span::after {
            transform:rotate(-45deg) translateY(-0.7rem);
        }
        #Modal .close_button > span span,
        #Modal .close_button > span::before,
        #Modal .close_button > span::after {
            display: block;
            width: 2rem;
            height: 0.2rem;
            transition: all 0.3s;
            background: rgb(113, 202, 165);
        }
</style>