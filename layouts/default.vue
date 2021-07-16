<template>
  <div id="Page">
    <header id="Header">
      <OrganismsDefaultHeader
        :app-name="getAppName"
      />
    </header>
    <main id="Main">
      <aside id="MainNav">
        <OrganismsNavigationUL />
      </aside>
      <Nuxt />
    </main>
    <footer id="Footer">
      <OrganismsDefaultFooter
        :app-name="getAppName"
      />
    </footer>
  </div>
</template>

<script lang="ts">
import { Vue, Component } from 'vue-property-decorator'

@Component
export default class DefaultLayoutComponent extends Vue {
  private appName : string = 'Portfolio'
  protected get getAppName () : string { return this.appName }
}
</script>

<style lang="scss">
#Header{

}
</style>
