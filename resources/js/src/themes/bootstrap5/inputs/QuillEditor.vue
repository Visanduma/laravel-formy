<template>
    <InputWrapper>
        <label v-text="label"></label>
        <VueEditor
            v-model="content"
            @input="$emit('input',content)"
        ></VueEditor>
    </InputWrapper>
</template>

<script>

import { VueEditor } from 'vue2-quill-editor'
import InputWrapper from "../InputWrapper"

export default {
    components: { InputWrapper, VueEditor },
    props: {
        name: String,
        label: String,
        classString: String,
        wrapperClassString: String,
        value: [String, Number],
        errors: Object,
    },
    mounted(){
        this.content = this.value
    },
    data(){
        return {
            content: ""
        }
    }
}
</script>
