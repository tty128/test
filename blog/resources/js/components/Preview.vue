<template>
    <div id="ContentPreview">
        <!-- <div class="preview_body" v-html="marked_text"></div> -->
        <textarea v-model="content_text"></textarea>
        <div class="preview_body" v-html="marked_text"></div>
        <ul 
            id="HtmlAnker"
            v-if="anker_arr"
        >
            <li
                v-for="item in anker_arr"
                :key="item"
            >
                <a :href="'#' + item">{{ item }}</a>
            </li>
        </ul>
    </div>
</template>

<script>
// import marked from 'marked';
// import hljs from 'highlight.js';
// import 'highlight.js/styles/vs2015.css';

//export default {
module.exports={
    // props:{
    //     content_text:String
    // },
    data:function(){
        return{
            content_text:"",
            marked_text:"",
            anker_arr:null
        }
    },
    watch:{
        content_text: function(){
            this.marked_text = this.markedText(this.content_text)
            const doc = new DOMParser().parseFromString('<div>' + this.marked_text + '</div>', "text/html");
            const querys = doc.querySelectorAll("h2")

            if(querys.length > 0){
                let arr = []
                querys.forEach(query => {
                    if(query.id !== null && query.id != "" ){
                        arr.push(query.id)
                    }
                });
                this.anker_arr = arr
            } else {
                this.anker_arr = null
            }
        },
    },
    methods:{
        markedText:function(text){
            hljs.highlightAll()
            marked.setOptions({
                renderer: new marked.Renderer(),
                highlight: function(code, lang) {
                    const language = hljs.getLanguage(lang) ? lang : 'plaintext';
                    return hljs.highlight(code, { language }).value;
                },
                pedantic: false,
                gfm: true,
                breaks: false,
                sanitize: false,
                smartLists: true,
                smartypants: false,
                xhtml: false
            });
            return marked(text)
        },
    },
}
</script>

<style scoped>
#ContentPreview{
    width: 100%;
    height: auto;
    margin: 0 auto;
}
#ContentPreview .preview_body{
    word-break: break-all;
}
#ContentPreview .preview_body >>> h1{
    font-size: 4.8rem;
}
#ContentPreview .preview_body >>> h2{
    font-size: 3.6rem;
    border-bottom: solid 1px;
}
#ContentPreview .preview_body >>> h3{
    font-size: 2.4rem;
}
#ContentPreview .preview_body >>> h4,
#ContentPreview .preview_body >>> h5,
#ContentPreview .preview_body >>> h6,
#ContentPreview .preview_body >>> *
{
    font-size: 1.6rem;
}
#ContentPreview .preview_body >>> ul,
#ContentPreview .preview_body >>> ol,
#ContentPreview .preview_body >>> dl
{
    padding-left: 2.4rem;
    margin: 0.75rem 0;
}
#ContentPreview .preview_body >>> pre{
    padding: 1rem 3.6rem;
    color:darkgray;
    background: black ;
}
#ContentPreview .preview_body >>> p code{
    padding: 0.25rem 1rem;
    color:black;
    background: rgb(240, 236, 236);
}
#ContentPreview .preview_body >>> blockquote{
    margin: 0.75rem 0;
    padding: 0 1.6rem;
    border-left: 4px solid #DDD;
    color: #777;
}
#ContentPreview .preview_body >>> code{
    font-family: 'Source Code Pro', monospace;
}
</style>
