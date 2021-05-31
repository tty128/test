<template>
    <section>
        <h1>{{ title }}</h1>
        <router-view></router-view>
    </section>
</template>

<script>
    module.exports = {
        data: function () {
            return {
                title: 'user',
                info: null,
            }
        }
    }
</script>

<style scoped>
    section {
        transition: all 0.5s;
    }
</style>