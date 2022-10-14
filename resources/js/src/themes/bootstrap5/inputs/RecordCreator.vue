<template>
  <InputWrapper :class="wrapperClassString">
    <label v-text="label"></label>
<div class="input-group mb-3">
    <input
        :autocomplete="autocomplete"
        :class="[{ 'is-invalid': errors[name]}, classString]"
        :name="name"
        :placeholder="placeholder"
        :type="type"
        v-model="content"
    />
    <button @click.prevent="create()" class="btn btn-outline-secondary" type="button">Add</button>
  </div>

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
    token: String
  },

  mounted(){

  },

  data(){
    return {
        content: ""
    }
  },

  methods: {

    create(){
        axios.post('/formy/create-resource',{
            _form: this.token.split('||')[0],
            content: this.content,
            input: this.name
        })
        .then(res => {
            this.$root.$emit(this.name, this.content)
            this.content = ""
        })
    }
  }
}
</script>
