<template>
    <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ route.host }}">
                {{ appname }}
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>

            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <!-- Left Side Of Navbar -->
                <ul class="navbar-nav mr-auto"></ul>

                <!-- Right Side Of Navbar -->
                <ul class="navbar-nav ml-auto">
                    <!-- Authentication Links -->

                    <li class="nav-item" v-if="{{ guest }}">
                        <a class="nav-link" href="{{ route.login }}">LOGIN</a>
                    </li>

                    <li class="nav-item" v-if="{{ useradmin }}">
                        <a class="nav-link" href="{{ route.register }}">REGISTER</a>
                    </li>

                    <li class="nav-item dropdown" v-if="!{{ guest }}">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                            {{ username }} <span class="caret"></span>
                        </a>

                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="{{ route.logout }}"
                               onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                LOGOUT
                            </a>

                            <form id="logout-form" action="{{ route.logout }}" method="POST" style="display: none;">
                                //<VueCSRF />
                            </form>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
    module.exports = {
        data: function() {
            return{
                routes: {
                    host:'/'
                    register: '/register'
                    logout: '/logout'
                    login: '/login'
                }
                appname: 'vue'
                username: 'admin'
                useradmin: false
                guest:true
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