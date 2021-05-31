<template>
    <section>
        <h2>POST</h2>
        <div>
            <ul>
                <router-link tag="li" to="/post">all</router-link>
                <router-link tag="li" to="/post/create">create</router-link>
                <router-link tag="li" to="/post/update">update</router-link>
            </ul>
        </div>
    </section>
</template>

<script>
module.exports = {
    data: function() {
        return {

        }
    }
}
</script>

<style scoped>
    section {
        transition: all 0.5s;
    }
</style>