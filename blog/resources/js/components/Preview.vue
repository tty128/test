<template>
    <div id="ContentPreview">
        <div class="preview_body" v-html="contentText"></div>
    </div>
</template>

<script>
import marked from 'marked';
import hljs from 'highlight.js';
import 'highlight.js/styles/vs2015.css';

export default {
    props:{
        content_text:String
    },
    computed:{
        contentText:function(){
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

            return marked(this.content_text)
        }

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
