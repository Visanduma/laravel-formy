<!-- eslint-disable -->
<template>
  <InputWrapper>
    <label v-text="label"></label>
    <textarea
        :class="[{ 'is-invalid': errors[name]}, classString]"
        :name="name"
        :placeholder="placeholder"
        :rows="rows"
        @input="$emit('input', $event.target.value)"
        v-model="content"
    ></textarea>
    <div v-if="errors[name]" class="text-danger">
      {{ errors[name] }}
    </div>

  </InputWrapper>

</template>

<script>
  /* eslint-disable */
import InputWrapper from "../InputWrapper";

export default {
  name: "TextArea",
  components: {InputWrapper},
  props: {
    name: String,
    label: String,
    classString: String,
    placeholder: {type: String, default: ""},
    value: [String, Number],
    rows: Number,
    errors: Object,
  },
    mounted() {
        this.content = this.value
    },
  data(){
    return {
        content:""
    }
  }
}
</script>
