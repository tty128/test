<template>
  <div>
    {{ $route.query.page || '0' }}
    <MoleculesPagination :pages="data" button-class="cl-secoundary" />
    <ul class="flex--s ul">
      <li
        class="list"
        v-for="item in dataSlice(data,parseInt($route.query.page || 1))"
        :key="item.post_id"
      >
        <MoleculesCard
          :id="item.post_id"
          prefix="./blog/post/"
        >
          {{ 'link' + item.post_id }}
        </MoleculesCard>
      </li>
    </ul>
    <MoleculesPagination :pages="data" />
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'

@Component({
  async asyncData ({ $axios }:{$axios : any}) {
    const data = await $axios.$get('/api/page2/index2.php')
    return { data }
  }
})
export default class BlogListComponent extends Vue {
  dataSlice (data:any, query:number) : Array<any> {
    return data.slice((query - 1) * 12 , query * 12)
  }
}
</script>

<style lang="scss">
  .ul {
    width: auto;
    margin: 0 auto;
    padding: 0;
  }
  .list {
    margin: 1rem;
    list-style: none;
    width: 200px;
    height: 200px;
  }
  .list:last-child{
    float: left;
  }
</style>
