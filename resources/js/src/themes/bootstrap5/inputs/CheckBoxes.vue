<template>
  <InputWrapper>
    <label v-text="label"></label>

    <div v-for="(option,k) in options" :key="k" class="form-check">
      <input
          :id=" `formy-check-${k}` "
          v-model="selected"
          :class=" [ { 'is-invalid' : isInvalid }, 'form-check-input' ]"
          :name="name"
          :value="k"
          type="checkbox"
          @change="$emit('input', selected)"
      >
      <label :for="`formy-check-${k}`" class="form-check-label">
        {{ option }}
      </label>
    </div>
    <div v-if="isInvalid" class="text-danger">
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
    value: [String, Number],
    options: [Array, Object],
    errors: Object,
  },

  data() {
    return {
      selected: this.value
    }
  },

  computed: {
    isInvalid() {
      return this.errors[this.name]
    }
  }
}
</script>
