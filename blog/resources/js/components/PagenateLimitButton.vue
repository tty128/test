<template>
    <div class="radio__limit">
        <input type="radio"
			:name="name"
			:id="slot_name"
			:value="slot_name"
			v-model="input_name"
		>
        <label :for="slot_name">
			<slot></slot>
		</label>
    </div>
</template>

<script>
    module.exports={
		props:{
			name:String,
			slot_name:String
		},
		data:function(){
			return {
				input_name:null
			}
		},
		created:function(){
			this.input_name = this.slot_name
		}
    }
</script>