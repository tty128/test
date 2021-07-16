<template>
  <div>
    aaaaaa
  </div>
</template>

<script lang="ts">
import { Vue, Component, Prop } from 'vue-property-decorator'

@Component
export default class YourComponent extends Vue {
  @Prop({ type: String, default: 'App' }) readonly appName ! : string;

  protected get getAppName (): string { return this.appName }
}
</script>
