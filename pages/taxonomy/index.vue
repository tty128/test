<template>
  <article class="taxonomy-page article flex--s-s">
    <div class="article__content">
      <div class="article__content--header cl-white">
        <h1 id="category">category</h1>
        <MoleculesTaxonomyList v-if="category" :terms="category" taxonomy="category" />
        <h1 id="tag">tag</h1>
        <MoleculesTaxonomyList v-if="tag" :terms="tag" taxonomy="tag" />
      </div>
    </div>
    <div id="Anchor">
      <MoleculesCreateAnchorMain content='<div><h1 id="category">Category</h1><h1 id="tag">Tag</h1></div>' class="cl-secoundary" />
    </div>
  </article>
</template>

<script lang="ts">
import { Vue, Component } from 'nuxt-property-decorator'

@Component
export default class TaxonomyComponent extends Vue {
  async asyncData ({ $axios }: {$axios : any}) {
    const data = await $axios.$get('/api/page2/index.php')
    const { category, tag } = data.taxonomy
    return { category, tag }
  }
}
</script>

<style lang="scss">
.taxonomy-page {
  .article {
    &__content{
      max-width: 800px;
      flex-grow: 3;
      margin-right: 2rem;
      margin-bottom: 2rem;

      &--header {
        margin:0;
        margin-bottom: 2rem;
        padding: 2rem;
        p{margin: 0;padding: 0;}
      }
      &--body {
        margin: 0;
        padding: 2rem;
      }
    }
  }
  #Anchor {
    flex-grow: 1;
    width: 300px;
    max-width: 800px;
    margin-right: 2rem;
  }
}
</style>
