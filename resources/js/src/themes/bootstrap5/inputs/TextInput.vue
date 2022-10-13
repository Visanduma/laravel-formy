<template>
  <InputWrapper :class="wrapperClassString">
    <label v-text="label"></label>
    <input
        :autocomplete="autocomplete"
        :class="[{ 'is-invalid': errors[name]}, classString]"
        :name="name"
        :placeholder="placeholder"
        :type="type"
        :value="value"
        @input="$emit('input', $event.target.value)"
    >
    <div v-if="errors[name]" class="text-danger">
      {{ errors[name] }}
    </div>
  </InputWrapper>
</template>

<script>

import InputWrapper from "../InputWrapper";


export default {
  name: "TextInput",
  components: {InputWrapper},
  props: {
    name: String,
    label: String,
    classString: String,
    wrapperClassString: String,
    type: {type: String, default: 'text'},
    placeholder: {type: String, default: ""},
    value: [String, Number],
    autocomplete: String,
    errors: Object,
  },

  mounted(){
        
  }
}
</script>
