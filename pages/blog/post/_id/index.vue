<template>
  <article class="article cl-white flex--s-s">
    <div class="wrapper">
      <h1>{{ data.post_title }}</h1>
      <p>ここはポートフォリオの記事のページ</p>
      <div>{{ data.post_content }}</div>
      <MoleculesMarkedHTML :content="data.post_content" />
    </div>
    <MoleculesCreateAnchorMain :content="data.post_content" id="Anchor" class="cl-secoundary" >INDEX</MoleculesCreateAnchorMain>
  </article>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'

@Component({
  async asyncData ({ params, $axios }) {
    const data = await $axios.$get('/api/page2/index2.php?id=' + params.id)
    return { data }
  }
})
export default class BlogPageIDComponent extends Vue {
}
</script>

<style lang="scss">
.article {
  &>.wrapper {
    flex-grow: 1;
  }
}
#Anchor {
  flex-grow: 1;
  max-width: 250px;
  margin: 2rem;
}
</style>
