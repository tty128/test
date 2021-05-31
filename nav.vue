<template>
    <nav>
        <ul>
            <router-link tag="li" to="/user">user</router-link>
            <router-link tag="li" to="/post">post</router-link>
            <router-link tag="li" to="/page1">page1</router-link>
            <router-link tag="li" to="/page2">page2</router-link>
        </ul>
    </nav>
</template>

<script>
    module.exports = {
        data: function () {
            return {
            }
        }
    }
</script>

<style scoped>
    nav {
        width:100%;
        height:auto;
    }

    nav ul {
        list-style:none;

        margin:0;
        padding:0;
    }
    nav li {
        transition:all 0.3s;
    }
    nav ul .router-link-active {
        color:white;
        background: green;
    }
</style>