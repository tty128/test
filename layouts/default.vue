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
      <Nuxt id="Content" />
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
#Main{
  position: relative;
  display: flex;
  width: 100%;
}
#MainNav {
  max-width: 150px;
  flex-grow: 1;
}
#Content {
  flex-grow: 1;
  margin-right: 2rem;
}
</style>
