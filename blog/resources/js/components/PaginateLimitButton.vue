<template>
    <ul class="radio__limits">
        <li class="radio__limit"
            v-for="n in limits.length"
            :key="n"
        >
            <input type="radio" name="limit"
                :id="'limit-' + n"
                :value="limits[n-1]"
                v-model="input_limit"
            >
            <label :for="'limit-' + n">
                {{ limits[n-1] }}
            </label>
        </li>
    </ul>
</template>

<script>
    module.exports={
		props:{
			limits:Array
		},
		data:function(){
			return {
				input_limit:null
			}
		},
        watch:{
            input_limit:function(){
                this.$emit('element_limit_action',this.input_limit)
            }
        },
        mounted:function(){
            let element = document.getElementById( "limit-1" ) ;
            element.checked = true ;
        }
    }
</script>

<style scoped>
    .radio__limits input{
        /* display: none; */
    }
</style>
