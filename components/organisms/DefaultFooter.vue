<template>
  <div class="footer cl-base flex--c-s">
    <div class="footer__app-name flex">
      <NuxtLink to="/">
        {{ getAppName }}
      </NuxtLink>
    </div>
    <div class="footer__navigation">
      <OrganismsNavigationUL />
    </div>
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator'

@Component
export default class DefaultHeaderComponent extends Vue {
  @Prop({ type: String, default: 'App' }) readonly appName ! : string

  protected get getAppName () : string { return this.appName }
}
</script>

<style lang="scss">
#Header {
  background: red;
}
</style>
