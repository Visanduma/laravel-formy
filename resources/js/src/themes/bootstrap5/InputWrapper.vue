<template>
  <div v-show="visible" class="mb-3">
    <slot></slot>
  </div>
</template>

<script>
export default {
    props: {
        visible: {type: Boolean, default: true}
    }
}
</script>
