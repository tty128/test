<template>
    <nav>
        <input type="checkbox" name="nav_menu" id="Nav">
        <label id="Humbarger" for="Nav">
            <button class="container">
                <span class="wrapper">
                    <span></span>
                </span>
            </button>
        </label>
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
    #Humbarger {
        z-index: 100;
        position: fixed;
        right: 0;
        top: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 5rem;
        height: 5rem;
        color: white;
        background: blue;
    }

        #Humbarger > .container {
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            width: 1.5rem;
            height: 1.5rem;
        }

            #Humbarger > .container > span::before, #Humbarger > .container > span::after {
                content: "";
            }

            #Humbarger > .container > span::before {
                transform: translateY(0.7rem);
            }

            #Humbarger > .container > span::after {
                transform: translateY(-0.7rem);
            }

            #Humbarger > .container > span span, #Humbarger > .container > span::before, #Humbarger > .container > span::after {
                display: block;
                width: 5rem;
                height: 0.2rem;
                transition: all 0.3s;
                background: white;
            }

    nav {
        position: fixed;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        width: 100%;
        height: 5rem;
        transition: all 0.3s;
        transform: translate(100%, 0) rotate(0);
        background: red;
    }

    input#Nav {
        display: none;
    }

        input#Nav:checked ~ nav {
            transform: translate(0);
        }

        input#Nav:checked ~ label .line span span {
            opacity: 0;
        }

        input#Nav:checked ~ label .line span::before {
            transform: translateX(-0.2rem) rotate(45deg);
        }

        input#Nav:checked ~ label .line span::after {
            transform: translateX(-0.2rem) rotate(-45deg);
        }
</style>