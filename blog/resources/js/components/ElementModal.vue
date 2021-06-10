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
            <label for="input_title">TITLE</label>
            <input id="input_title" v-model="new_title">

            <label for="input_content">CONTENT</label>
            <textarea id="input_content" v-model="new_content"></textarea>
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
    module.exports = {
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
            },
            event_on : function(){
                const sbar = window.scrollbars.visible
                const bs = document.body.style
                if(this.event_on){
                    const ws = -1 * window.scrollY
                    bs.position = 'fixed'
                    bs.top = ws +'px'
                    bs.width = '100%'
                    if(sbar){
                        bs.paddingRight = '15px'
                    }
                }
                else{
                    const top = bs.top
                    bs.position = ''
                    bs.top = ''
                    bs.width = ''
                    if(sbar){
                        bs.paddingRight = ''
                    }
                    window.scrollTo(0, parseInt(top , '0') * -1)
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
            sendAPIs: function( state ){
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
        background: rgb(113, 202, 165);
        color:white;
        filter: drop-shadow(0px 0px 0.66rem rgba(47,72,88,.5));
    }
    #Modal .close_button {
        color: rgb(113, 202, 165);
        background: white;
    }
    #Modal .close_button > span span,
    #Modal .close_button > span::before,
    #Modal .close_button > span::after {
        background: rgb(113, 202, 165);
    }

    #Modal button{
        background: white;
        color: rgb(113, 202, 165);
    }


    #Modal {
        z-index:10;
        position:fixed;
        top:0;
        left: 105%;
        width: 70vw;
        height: 100%;
        padding: 7rem 2rem 0;
        transition:all 0.3s;
    }
    #Modal.visible {
        transform: translateX(-105%)
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
        }
    #Modal .action{
        display:flex;
        justify-content: flex-start;
        align-items: center;

        height:5rem;

        padding-left: 3rem;

        font-size: 2rem;

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

        width:70%;
        margin: 0 auto;
    }

    #Modal label{
        margin-right: auto;
    }

    #Modal input,
    #Modal textarea{
        width: 100%;

        margin-bottom:2.5rem;
        padding: 0.75rem;

        border:none;
        border-radius: 0.5rem;

        outline: none;
    }

    #Modal textarea{
        resize: none;
        
        height: 10rem;  
    }

    #Modal button{
        display: flex;
        align-items: center;
        justify-content: center;

        width: 9rem;
        height: 3rem;

        margin: 0 auto;

        border: none;
        border-radius: 1.5rem;
    }

</style>
