<template>
    <section>
        <h1>{{ info.data.post.post_title }}</h1>
        <div v-html="info.data.post.post_content"></div>
    </section>
</template>

<script>
module.exports = {
    data: function() {
        return {
            title: 'page1.vue',
            info: null,
        }
    }, 
    methods: {
        getAPIs: function () {
            axios
                .get('http://localhost/api' + this.$route.path)
                .then(response => (this.info = response.data))
        }
    },
    created: function () {
        this.getAPIs()
    }


}
</script>

<style scoped>
    section {
        transition: all 0.5s;
    }
</style>