<!-- eslint-disable -->
<template>
  <InputWrapper>
    <label v-text="label"></label>

    <div v-for="(option,k) in options" :key="k" class="form-check">
      <input
          :id=" `formy-radio-${k}` "
          v-model="value"
          :class=" [ { 'is-invalid' : isInvalid }, 'form-check-input' ]"
          :name="name"
          :value="k"
          type="radio"
          @input="$emit('input', $event.target.value)"
      >
      <label :for="`formy-radio-${k}`" class="form-check-label">
        {{ option }}
      </label>
    </div>
    <div v-if="isInvalid" class="text-danger">
      {{ errors[name] }}
    </div>

  </InputWrapper>
</template>

<script>

import InputWrapper from "../InputWrapper";


export default {
  components: {InputWrapper},
  props: {
    name: String,
    label: String,
    classString: String,
    value: [String, Number, Boolean],
    options: [Array, Object],
    errors: Object,
  },

  computed: {
    isInvalid() {
      return this.errors[this.name]
    },
  }
}
</script>
