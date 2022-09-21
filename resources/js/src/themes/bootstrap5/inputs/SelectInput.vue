<template>
  <InputWrapper>
    <label v-text="label"></label>
    <select
        :class="[{ 'is-invalid': errors[name]}, classString]"
        :name="name"
        @input="$emit('input', $event.target.value)"
        v-model="actualValue"
    >
      <option :value="null" disabled>Select</option>
      <option v-for="(option,k) in options" :key="k" :selected=" k === value " :value="k">{{ option }}</option>

    </select>
    <div v-if="errors[name]" class="text-danger">
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
    value: {
      type: [String, Number],
      default: null
    },
    options: [Array, Object],
    errors: Object,
  },

  computed: {
    actualValue() {
      return this.value !== "" ? this.value : null
    }
  }
}
</script>