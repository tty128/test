<template>
  <div>
    <ul>
      <li
        v-for="n in 10"
        :key="n"
      >
        <NuxtLink :to="'/blog/post/' + n"> {{'link' + n }} </NuxtLink>
      </li>
    </ul>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'

@Component({
  async asyncData ({ $axios }) {
    const data = await $axios.$get('/api/page2/index2.php')
    return { data }
  }
})
export default class BlogPageComponent extends Vue {

}
</script>
