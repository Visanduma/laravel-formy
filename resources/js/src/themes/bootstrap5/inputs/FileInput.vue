<template>
    <InputWrapper>
        <label v-text="label"></label>
        <input :class="[{ 'is-invalid': errors[name]}, classString]" :name="name" type="file"
            @input="$emit('input', $event.target.files[0])">
        <div v-if="errors[name]" class="text-danger">
            {{ errors[name] }}
        </div>

        <div class="asset-container my-2 d-flex gap-2 flex-wrap">
            <img @click="deleteFile(file)" class="my-1" v-for="file in files" :key="file.id" :src="file.preview"
                alt="image" />
        </div>

    </InputWrapper>
</template>

<script>

import InputWrapper from "../InputWrapper.vue";


export default {
    components: { InputWrapper },
    props: {
        name: String,
        label: String,
        classString: String,
        errors: Object,
        files: Object
    },

    methods: {
        deleteFile(file) {
           if(confirm('Delete this file ?')){
                this.$inertia.post('/formy/file/delete', {
                    file: file.id
                })
           }
        }
    }
}
</script>
