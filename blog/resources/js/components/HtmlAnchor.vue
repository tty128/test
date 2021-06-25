<template>
    <div id="HtmlAnchor"
        v-if='autoAnchor'
    >
        <html-anchor-list
            :items='autoAnchor'
        ></html-anchor-list>
    </div>
</template>

<script>
// import HtmlAnchorList from './HtmlAnchorList.vue';
// export default {
module.exports = {
    // components:{
    //     HtmlAnchorList
    // },
    props:{
        dom_string:{type:[String],default:''},
        query_select:{type:[String],default:"h1,h2,h3"}
    },
    computed:{
        autoAnchor:function(){
            if(this.dom_string !== ''){
                const doc = new DOMParser().parseFromString(this.dom_string, "text/html");
                const querys = doc.querySelectorAll(this.query_select)

                if (querys.length > 0) {
                    // セレクターの種類を配列に変換し重複を排除する
                    const queryArrayToSet = this.query_select.split(',')
                    const queryArray = [...new Set(queryArrayToSet)]

                    // returnする配列の初期化
                    let resultArr = []

                    // 配列への参照：ネストされるたび参照を代入する
                    let resultRef = resultArr;

                    // 代入先のObjectに
                    let isCreatedArr = []
                    queryArray.forEach(element => {isCreatedArr.push(false)})

                    querys.forEach(query => {
                        // id無しのエラーが存在する場合は無視
                        if(query.id !== null && query.id != "" ){
                            let qTag = query.tagName.toLowerCase()
                            let nestIndex = queryArray.findIndex(elem => elem == qTag)
                            for(let i = 0 ; i < queryArray.length ; i++){
                                if ( i == nestIndex ) {
                                    resultRef.push({
                                        tag:qTag,
                                        text:query.id,
                                        children:[]
                                    })
                                    isCreatedArr[i] = true
                                    resultRef = resultArr

                                } else if ( i < nestIndex ) {
                                    // タグが飛んでる場合（h1の次にh2を飛ばしてh3が来てる等）は空のObjectを作成する
                                    if(!isCreatedArr[i]){
                                        resultRef.push({
                                            tag:'',
                                            text:'',
                                            children:[]
                                        })
                                        isCreatedArr[i] = true
                                    }
                                    // 参照先次の入れ子に変更
                                    resultRef = resultRef[resultRef.length - 1].children
                                } else {
                                    isCreatedArr[i] = false
                                }
                            }

                        }
                    })

                    return resultArr
                }
            }

            return null
        }
    },
}
</script>

<style scoped>
    #HtmlAnchor{
        background: cadetblue;
        width: 100%;
        height: auto;

        padding: 1rem;
        border-radius: 1rem;
    }
</style>