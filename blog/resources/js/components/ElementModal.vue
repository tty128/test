<template>
    <div
        id="Modal"
        :class="event_on ? 'visible' : ''"
    >
        <!-- CloseButton -->
        <div
            class="close_button"
            @click="emitAction"
        >
            <span></span>
        </div>
        <!-- CloseButton End -->

        <!-- ActionString -->
        <h2 class="action">
            {{ action.toUpperCase() }}
        </h2>
        <!-- ActionString -->

        <!-- ItemTitle -->
        <div
            class="wrapper"
            v-if="action !== 'create'"
        >
            <h3>{{ old_title }}</h3>
        </div>
        <!-- ItemTitle End -->

        <!-- ItemNewParam Input:create and edit action-->
        <div
            :class="['wrapper' ,action == 'create' ? 'create':'edit']"
            v-if="action == 'create' || action =='edit'"
        >
            <div
                v-if="new_title !== null"
            >
                <label for="input_title">TITLE</label>
                <input id="input_title" v-model="new_title" required>
            </div>

            <div
                v-if="new_content !== null"
            >
            <label for="input_content">CONTENT</label>
            <textarea id="input_content" v-model="new_content" required></textarea>
            </div>

            <div
                v-if="new_status !== null"
            >
                <label>STATUS</label>
                <div class="input_radio">
                    <input type="radio" id="status_private" value="private" v-model="new_status" required>
                    <label class="input_status" for="status_private">Private</label>
                    <input type="radio" id="status_member" value="member" v-model="new_status">
                    <label class="input_status" for="status_member">Member</label>
                    <input type="radio" id="status_public" value="public" v-model="new_status">
                    <label class="input_status" for="status_public">Public</label>
                </div>
            </div>
        </div>
        <!-- ItemNewParam Input End -->

        <!-- Preview:preview action -->
        <div
            class="wrapper preview"
            v-if="action =='preview'"
            v-html="new_content"
        >
        </div>
        <!-- Preview End -->

        <!-- Delete:delete action -->
        <div
            class="wrapper delete"
            v-if="action == 'delete'"
        >
            <p>この記事を消去します。消した記事はゴミ箱より復帰することが出来ます。</p>
        </div>
        <!-- Delete End -->

        <button
            @click="sendAPIs(action)"
            v-if="action != 'preview'"
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
            data_id:Number,
            data_name:String,
        },
        data:function(){
            return {
                items:null,
                old_title:null,
                new_title:null,
                new_content:null,
                new_status:null,
                res:{
                    status:null,
                    message:null,
                },
            }
        },
        watch:{
            data_id:async function(){
                // data_idを監視し正常に値が代入されたタイミングで起動
                // Param初期値を代入

                if(this.action !== 'create' || this.data_id !== null){
                    // create以外の時のaxios通信
                    let data_slug = '/' + this.data_id
                    let routePath = this.$route.path
                    let path = this.$appRootPath + routePath.replace(this.$appPath , this.$appApiPrefix) + data_slug
                    try{
                        const response = await axios.get(path ,{params:{api_token:this.token}})
                        this.items = response.data

                        switch(this.data_name){
                            case 'post':
                                this.new_title = this.old_title = this.items.post_title
                                this.new_content = this.items.post_content
                                this.new_status = this.items.post_status
                                break;
                            case 'term':
                                this.new_title = this.old_title = this.term_name
                        } 
                    }
                    catch(error){
                        this.errorInsert(error.response)
                    }

                }

                // statusがnullではないなら初期値を:checkedする
                if(this.new_status !== null){
                    let element = document.getElementById('status_' + this.new_status)
                    element.checked = true
                }
            },
            event_on : function(){
                // Modalの起動を監視し、trueならページの現在値を固定、falseならパラメータを削除する
                // createdではfalseを拾えないため監視
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
            emitAction: function () {
                this.$emit('element_modal_action', false )
            },
            sendAPIs:async function( state ){
                // actionにより異なったリクエストを送信する
                let data_id = this.action !== 'create' && this.data_id !== null && this.data_id !=='undefind' ? '/' + this.data_id : '';
                let routePath = this.$route.path
                let path = this.$appRootPath + routePath.replace(this.$appPath , this.$appApiPrefix) + data_id

                let params 
                switch(this.data_name){
                    case 'post':
                        // laravelでもvalidateしているがここでも想定外のstatusをprivate
                        this.new_status = this.new_status === 'private' || this.new_status === 'member' || this.new_status === 'public' ? this.new_status : 'private'
                        params = {
                            post_title:this.new_title,
                            post_content:this.new_content,
                            post_status:this.new_status,
                        }
                        break;

                    case 'term':
                        params = {
                            post_title:this.new_title,
                        }
                        break;
                }

                let res 
                try{
                    switch(state){
                        case 'edit':
                            res = await axios.put(path+'?api_token='+this.token,params)
                            break;
                        case 'delete':
                            res = await axios.delete(path+'?api_token='+this.token)
                            break;
                        case 'create':
                            res = await axios.post(path+'?api_token='+this.token,params)
                            break;
                        default:
                            break;
                    }
                }
                catch(error){
                    this.errorInsert(error.response)
                }
                
            },
            errorInsert:function(error){
                const {
                    status,
                    statusText
                } = error

                this.res.status = status
                this.res.message = statusText
                console.log(this.res.status,this.res.message)
            }
        },
        created:function(){
            this.new_status = 'private'
            if(this.action === 'create'){
                switch(this.data_name){
                    case 'post':
                        this.new_title = ""
                        this.new_content = ""
                        this.new_status = 'private'
                        break;
                    case 'term':
                        this.new_title = ""
                        this.new_status = null
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

    #Modal .input_radio{
        background: white;
    }
    #Modal label.input_status{
        background: white;
        color: rgb(113, 202, 165);
    }
    #Modal input#status_private:checked +
    label{
        color: white !important;
        background: rgb(202, 113, 113) !important;
    }
    #Modal input#status_member:checked +
    label{
        color: white !important;
        background: rgb(202, 193, 113) !important;
    }
    #Modal input#status_public:checked +
    label{
        color: white !important;
        background: rgb(113, 202, 165) !important;
    }


    #Modal {
        z-index:10;
        overflow-y: auto;

        position:fixed;
        top:0;
        bottom:0;
        left: 105%;

        width: 70vw;
        height: 100%;

        padding: 7rem 2rem 0;
        transition:all 0.3s;
    }
    #Modal.visible {
        transform: translateX(-105%)
    }
    #Modal.invisible{
        opacity: 0 !important;
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

        padding-left: 2rem;

        font-family: 'Nunito';
        font-size: 4rem;
        font-weight: 900;

        opacity:0;
        transition-delay:1s;
        transition:all 0.3s;
    }
    #Modal.visible .action{
        opacity:1 !important;
    }
    #Modal .wrapper{
        display:flex;
        align-items:center;
        justify-content:flex-start;
        flex-direction:column;

        width:70%;
        margin: 0 auto;
    }

    /* #Modal label{
        margin-right: auto;
    } */

    #Modal input#input_title,
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

        height: 15rem;
    }

    #Modal button{
        display: flex;
        align-items: center;
        justify-content: center;

        width: 9rem;
        height: 3rem;

        margin: 0 auto;
        margin-bottom: 5rem;

        border: none;
        border-radius: 1.5rem;
    }

    #Modal input[id^='status_']{
        display: none;
    }

    #Modal .input_radio,
    #Modal .input_status {
        display: flex;
        align-items: center;
        justify-content: center;
    }

    #Modal .input_radio{
        padding: 0.25rem;
        border-radius: 0.5rem;
        margin-bottom: 2.5rem;
    }

    #Modal label.input_status{
        user-select: none;
        cursor: pointer;

        width: 5rem;
        height: 2rem;
        margin: 0;
        border-radius: 0.5rem;

        transition:all 0.3s;
    }


</style>
