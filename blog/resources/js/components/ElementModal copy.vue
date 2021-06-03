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

        <h2
            class="action"
            v-if="this.action == 'create' || changeWait()"
        >
            {{ action.toUpperCase() }}
        </h2>

        <div
            class="wrapper"
            v-if="this.action != 'create' && changeWait()"
        >

            <h3>{{ items.post_title }}</h3>
            <div>

            </div>
        </div>
        <div
            :class="['wrapper' ,this.action == 'create' ? 'create':'edit']"
            v-if="this.action == 'create' || this.action =='edit'"
        >
            <input v-model="new_title">
            <textarea v-model="new_content"></textarea>
        </div>

        <div
            :class="['wrapper' ,this.action == 'create' ? 'create':'edit']"
            v-if="this.action == 'delete' || this.action =='preview'"
            v-html="new_content"
        >
        </div>

        <button
            @click="sendAPIs(action)"
            v-if="this.action != 'preview'"
        >
            submit
        </button>
    </div>
</template>

<script>
    export default {
        props: {
            event_on: Boolean,
            token:String,
            action:String,
            post_id:Number,

        },
        data:function(){
            return {
                items:null,
                new_title:null,
                new_content:null,

            }
        },
        watch:{
            post_id:async function(){
                this.new_title = null
                this.new_content = null
                if(this.action === 'create' || this.post_id !== null){
                    let postId = '/' + this.post_id

                    let routePath = this.$route.path
                    let path = this.$appRootPath + routePath.replace(this.$appPath , this.$appApiPrefix) + postId

                    const response = await axios.get(path ,{params:{api_token:this.token}})

                    this.items = response.data
                    this.new_title = this.items.post_title
                    this.new_content = this.items.post_content
                }
            }
        },
        methods: {
            changeWait:function(){
                return this.items !== null && this.post_id == this.items.post_id
            },
            emitAction: function () {

                this.$emit('element_modal_action', false )
            },
            sendAPIs:function( state ){
                let postId = this.action !== 'create' && this.post_id !== null && this.post_id !=='undefind' ? '/' + this.post_id : '';

                let routePath = this.$route.path
                let path = this.$appRootPath + routePath.replace(this.$appPath , this.$appApiPrefix) + postId

                switch(state){
                    case 'edit':
                        axios
                            .put(path+'?api_token='+this.token,
                                {
                                    post_title:this.new_title,
                                    post_content:this.new_content,
                                }
                            )
                            .then(()=>{
                                console.log("put送れたよ")
                            })
                        break;
                    case 'delete':
                        axios
                            .delete(path+'?api_token='+this.token)
                            .then(()=>{
                                console.log("del送れたよ")
                            })
                        break;
                    case 'create':
                        axios
                            .post(path+'?api_token='+this.token,
                                {
                                    post_title:this.new_title,
                                    post_content:this.new_content,
                                }
                            )
                            .then(()=>{
                                console.log("送れたよ")
                            })
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
        position:sticky;
        top:2rem;

        display: flex;
        justify-content: center;
        align-items: center;
        width: 5rem;
        height: 5rem;

        float:left;

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

    #Modal .action{
        display:flex;
        justify-content: center;
        align-items: center;

        height:5rem;

        margin:0 auto;

        opacity:0;

        transition-delay:1s;
        transition:all 0.3s;
    }
    #Modal.visible .action{
        opacity:1 !important;
    }

    #Modal .wrapper.create{
        display:flex;
        align-items:center;
        justify-content:flex-start;
        flex-direction:column;
    }
</style>
