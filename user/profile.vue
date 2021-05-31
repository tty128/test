<template>
    <div>
        <h4>profile</h4>
        <ul>
            <li>{{ infos.name }}</li>
            <li>{{ infos.pass }}</li>
            <li>{{ infos.email }}</li>
        </ul>
        <h4>
            foreach
        </h4>
        <ul>
            <li v-for="info in infos">{{ info }}</li>
        </ul>
    </div>
</template>

<script>
module.exports = {
    data: function() {
        return {
            infos:null
        }
    },
    methods: {
        getAPIs: function () {
            axios
                .get('http://localhost/api/auth')
                .then(response => (this.infos = response.data))
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