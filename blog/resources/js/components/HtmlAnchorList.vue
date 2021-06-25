<template>
    <ul :class="['anchor-ul', 'anchor-level__' + getLevel ]">
        <li
            class="anchor-li"
            v-for="item in items"
            :key="item.text"
        >
            <a
                v-if="item.text != ''"
                :class="'tag-' + item.tag"
                @click="scrollToAnchorPoint('#' + item.text )"
            >
                {{ item.text }}
            </a>
            <html-anchor-list
                v-if="item.children.length"
                :items="item.children"
                :level="getLevel"
            ></html-anchor-list>
        </li>
    </ul>
</template>

<script>
//import HtmlAnchorList from './HtmlAnchorList.vue'
// export default {
module.exports = {
    // name:html-anchor-list,
    // components:{
    //     HtmlAnchorList
    // },
    props:{
        items:Array,
        level:{type:[Number],default:0}
    },
    computed:{
        getLevel:function(){
            return this.level + 1
        }
    },
    methods:{
        scrollToAnchorPoint(ref) {
            const elem = document.querySelector(ref)
            elem.scrollIntoView({ behavior: 'smooth' , block: 'center'})
        }
    }
}
</script>

<style scoped>
    .anchor-ul{
        list-style: none;
        margin-left: 1.4rem;
    }

    .anchor-ul a{
        cursor: pointer;
    }

    .anchor-level__1{
        margin-left: 0;
        font-size: 1.8rem ;
    }

    .anchor-level__2{
        font-size: 1.6rem ;
    }

    .anchor-level__3{
        font-size: 1.4rem ;
    }

</style>