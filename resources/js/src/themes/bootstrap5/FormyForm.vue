<template>
    <div>
        <form action="">
            <component
                :is="comp.component"
                v-for="(comp,k) in builder.components"
                :key="k"
                v-model="formData[comp.binding.name]"
                v-bind="comp.binding"
                :errors="formData.errors"
                :token="builder._formToken"
            />

            <div class="mt-3">
                <button :disabled="formData.processing" class="btn btn-primary" @click.prevent="submit">
                    <span v-show="formData.processing" aria-hidden="true" class="spinner-border spinner-border-sm"
                        role="status"></span>
                    {{ builder.isUpdateForm ? 'Update' : 'Submit' }}
                </button>
                <button class="btn btn-light" @click.prevent="reset">Reset</button>
            </div>
        </form>
    </div>
</template>

<script>

import CheckBoxes from "./inputs/CheckBoxes.vue";
import FileInput from "./inputs/FileInput.vue";
import QuillEditor from "./inputs/QuillEditor.vue";
import RadioInputs from "./inputs/RadioInputs.vue";
import SearchInput from "./inputs/SearchInput.vue";
import Select from "./inputs/SelectInput.vue";
import TextArea from "./inputs/TextArea.vue";
import TextInput from "./inputs/TextInput.vue";

export default {
    components: {
        TextInput, TextArea, Select, RadioInputs, CheckBoxes, FileInput, QuillEditor, SearchInput
    },
    props: {
        builder: Object,
        errors: Object
    },
    data() {
        return {
            formData: this.$inertia.form(this.builder.inputs)
        }
    },


    methods: {

        submit() {
            this.formData.post(this.builder.url)
        },

        reset() {
            this.formData.clearErrors()
            this.formData.reset()
        }

    },

    computed: {
        //
    },

}
</script>
