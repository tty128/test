<template>
    <aside>
        <vue-nav></vue-nav>
    </aside>
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
    aside {

        position: fixed;
        top:50px;
        left:0;

        display: flex;
        align-items: flex-start;
        justify-content: flex-start;
        flex-direction: column;

        width: 19%;
        height: calc(100vh - 50px);
        overflow: hidden;

        margin: 0;
        padding: 0;

        border-right: solid 0.2rem gray;
    }

        aside ul {
            display:flex;
            align-items:flex-start;
            justify-content:flex-start;
            flex-direction:column;

            width:100%;
            height:auto;
        }

        aside li {
            cursor:pointer;

            display: flex;
            align-items: center;
            justify-content: flex-start;

            width:100%;
            height:5rem;

            font-size:1.4rem;

            color:gray;
            background:white;
        }

</style>