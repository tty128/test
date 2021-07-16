<template>
  <article id="Post">
    <h1>{{ data.post_title }}</h1>
    <div>
      <p>ここはポートフォリオの記事のページ</p>
      <div>
        <textarea v-model="value" placeholder="edit me" />
        {{ data.post_title }}
        <MoleculesCreateAnchorMain v-model="value" />
        <MoleculesMarkedHTML v-model="value" />
      </div>
    </div>
  </article>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'

@Component({
  async asyncData ({ params, $axios }: {params: any; $axios: any;}) : Promise<{data: any;}> {
    const data = await $axios.$get('/api/page2/index2.php?id=' + params.id)
    return { data }
  }
})
export default class BlogPageComponent extends Vue {
  value :string = ''
}
</script>
