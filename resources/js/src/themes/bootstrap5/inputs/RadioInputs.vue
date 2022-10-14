<!-- eslint-disable -->
<template>
    <InputWrapper>
        <label v-text="label"></label>

        <div v-for="(option,k) in listValues" :key="k" class="form-check">
            <input :id=" `formy-radio-${k}` " v-model="selectedValue"
                :class=" [ { 'is-invalid' : isInvalid }, 'form-check-input' ]" :name="name" :value="k" type="radio"
                @input="emitValue($event)">
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
    components: { InputWrapper },
    props: {
        name: String,
        label: String,
        classString: String,
        value: [String, Number, Boolean],
        options: [Array, Object],
        errors: Object,
        depend: String,
        token: String
    },

    data() {
        return {
            selectedValue: null,
            listValues: null
        }
    },

    mounted() {
        this.$root.$on(this.depend, (payload => {
            this.updateDepended(payload)
        }))

        this.selectedValue = this.value
        this.listValues = this.options
    },

    methods: {

        emitValue(event) {
            this.$emit('input', event.target.value)
            this.$root.$emit(this.name, event.target.value)
        },

        updateDepended(payload) {
            axios.post('/formy/update-dependents', {
                input: this.name,
                value: payload,
                _form: this.token.split('||')[0]
            })
                .then(res => {
                    this.listValues = res.data
                    this.selectedValue = null
                })
        }
    },

    computed: {
        isInvalid() {
            return this.errors[this.name]
        },

        optionsList() {
            return this.listValues ?? this.options
        }
    }
}
</script>
