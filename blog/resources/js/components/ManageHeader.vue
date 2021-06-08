<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <router-link
                    :to="{path:'/manage'}"
                    tag="a"
                    class="navbar-brand"
            >
                {{ appName }}
            </router-link>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown">
                        <a
                            id="navbarDropdown"
                            class="nav-link dropdown-toggle"
                            href="#"
                            role="button"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false"
                        >
                            {{ userName }}
                            <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a
                                class="dropdown-item"
                                :href="routeLogout"
                                @click="logoutButton"
                            >
                                LOGOUT
                            </a>

                            <form id="logout-form" :action="route_logout" method="POST" style="display: none;">
                                <laravel-vue-csrf
                                    :csrf="CSRFtoken"
                                >
                                </laravel-vue-csrf>
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    export default {
        props:{
            app_name:String,
            user_name:String,
            route_logout:String,
            csrf:Array
        },
        data: function() {
            return{
            }
        },
        computed:{
            appName:function(){
                return this.app_name
            },
            userName:function(){
                return this.user_name
            },
            routeLogout:function(){
                return this.route_logout
            },
            CSRFtoken:function(){
                return this.csrf
            },
        },
        methods:{
            logoutButton:function(){
                event.preventDefault()
                document.getElementById('logout-form').submit();
            }
        }
    }
</script>

<style scoped>
    nav {
        position:relative;

        display:flex;
        align-items:center;
        justify-content:flex-start;

        width:100%;
        height:50px;

        background:gray;
    }

    nav > div {
        display: flex;
        align-items: center;
        justify-content: center;

        width: 19%;
        height: 100%;

        color: white;

        font-size: 1.4rem;
        text-decoration: none;
    }

</style>
