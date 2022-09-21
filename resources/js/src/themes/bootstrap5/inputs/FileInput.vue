<template>
  <InputWrapper>
    <label v-text="label"></label>
    <input
        :class="[{ 'is-invalid': errors[name]}, classString]"
        :name="name"
        type="file"
        @input="$emit('input', $event.target.files[0])"
    >
    <div v-if="errors[name]" class="text-danger">
      {{ errors[name] }}
    </div>
  </InputWrapper>
</template>

<script>

import InputWrapper from "../InputWrapper.vue";


export default {
  components: {InputWrapper},
  props: {
    name: String,
    label: String,
    classString: String,
    errors: Object,
  }
}
</script>
