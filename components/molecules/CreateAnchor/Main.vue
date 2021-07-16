<template>
  <div
    v-if="autoAnchor"
    id="HtmlAnchor"
  >
    <keep-alive>
      <ul class="anchor-ul anchor-level__1">
        <List
          v-for="items in autoAnchor"
          :key="items.id"
          :item="items"
          :is-button="isButton"
        />
      </ul>
    </keep-alive>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop, VModel } from 'vue-property-decorator'
import marked from 'marked'
import List from './List.vue'
import AnchorListObj from './AnchorListObj'

@Component({
  components: {
    List
  }
})
export default class CreateAnchorMainComponent extends Vue {
  @VModel({ type: String, default: '' }) test !: string
  @Prop({ type: String, default: '' }) readonly domString !: string
  @Prop({ type: String, default: 'h1,h2,h3' }) readonly querySelect !: string
  @Prop({ type: Boolean, default: true }) readonly isButton ! : boolean

  private domStr () : string {
    return this.domString === '' ? this.test : this.domString
  }

  protected get autoAnchor () : object | null {
    const domStr : string = this.domStr()
    if (domStr === '') { return null }
    const doc : Document = new DOMParser().parseFromString(marked(domStr), 'text/html')
    const nodeList : NodeListOf<Element> = doc.querySelectorAll(this.querySelect)
    if (nodeList.length <= 0) { return null }

    const querysToSet : Array<string> = this.querySelect.split(',')
    const querys: Array<string> = [...new Set(querysToSet)]

    const result : Array<AnchorListObj> = []
    // 参照を渡す
    let resultRef = result

    const isCreatedIndex : Array<boolean> = []
    querys.forEach(() => { isCreatedIndex.push(false) })

    // main start
    nodeList.forEach((elem : Element) => {
      if (!elem.id) { return }

      const tag: string = elem.tagName.toLowerCase()
      const index: number = querys.findIndex((elem : string) => elem === tag)

      for (let i = 0; i < querys.length; i++) {
        if (index === i) {
          resultRef.push({
            tag,
            id: elem.id,
            text: elem.innerHTML,
            children: []
          })
          isCreatedIndex[i] = true
          resultRef = result
        } else if (index > i) {
          if (!isCreatedIndex[i]) {
            resultRef.push({ children: [] })
            isCreatedIndex[i] = true
          }
          resultRef = resultRef[resultRef.length - 1].children
        } else {
          isCreatedIndex[i] = false
        }
      }
    })
    return result
    // main end
  }
}
</script>

<style scoped>
    #HtmlAnchor{
        background: cadetblue;
    }

    .anchor-li{
        color:white;
        fill: white;
    }

    .anchor-button:hover{
        color:blueviolet;
        /* stroke: blueviolet; */
        fill: blueviolet;
    }

    #HtmlAnchor{
        width: 100%;
        height: auto;

        padding: 1.6rem;

        word-break: normal;
    }

    /* .anchor-li{
        margin-top: 0.2rem;
    } */

    .anchor-ul{
        list-style: none;
        user-select: none;

        margin-left: 1.4rem;
    }

    .anchor-ul a{
        cursor: pointer;
        word-break: break-word;
    }

    .anchor-level__1{
        margin: 0;
        font-size: 1.8rem ;
    }
    .anchor-level__1 > li {
        margin-top: 0.6rem;
    }
    .anchor-level__1 > li:first-child {
        margin-top: 0;
    }

    .anchor-level__1 > li > span.wrapper{
        display: inline-block;
        width: 100%;

        border-bottom: dotted 1px;
    }
    .anchor-level__1 > li > span.wrapper a{
        margin-left: 1rem;
    }

    .anchor-level__2{
        list-style: disc;
        margin-left: 3.6rem;
        font-size: 1.6rem ;
    }

    .anchor-level__2 > li {
        margin-top: 0.5rem;
    }

    .anchor-level__3{
        list-style: circle;
        margin-left: 1.8rem;
        font-size: 1.4rem ;
    }
    .anchor-level__3 > li {
        margin-top: 0.4rem;
    }

    .anchor-button{
        transition: all 0.3s;
    }
    .anchor-button svg{
        width: 1.5rem;
        height: 1.5rem;

        margin-left: 0.35rem;

        stroke: inherit;
        fill: inherit;

        vertical-align: middle;

    }

    .anchor-button > span{
        color: inherit;
    }

    .anchor-button-enter-active {
    transition: all .3s ease;
    }
    .anchor-button-leave-active {
    transition: all .5s ease;
    }
    .anchor-button-enter , .anchor-button-leave-to
    {
        transform: translateX(1rem);
        opacity: 0;
    }
</style>
