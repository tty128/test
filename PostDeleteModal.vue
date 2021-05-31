<template>
    <div class="modal">
        <div 
             v
             >
    </div>
</template>

<script>
module.exports = {
    data: function() {
        return {
            items: null,
        }
    },
    methods: {
        getAPIs: function () {
            axios
                .get('http://localhost/api' + this.$route.path)
                .then(response => (this.items = response.data))
        },
        nextUrl: function (id) {
            this.$router.push({ path: `/post/${id}` })

        },
        editPostUrl: function (id) {
            this.$router.push({ path: `/post/edit/${id}` })

        },
        deletePostUrl: function (id) {
            this.$router.push({ path: `/post/delete/${id}` })

        },
        createPostUrl: function () {
            this.$router.push({ path: `/post/create` })

        }
    },
    created: function () {
        this.getAPIs()
    }


}
</script>

<style scoped>

</style>