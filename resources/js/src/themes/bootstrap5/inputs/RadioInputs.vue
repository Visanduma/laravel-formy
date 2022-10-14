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

        <AddMore v-show="configs.creatable" :token="token" :input="name" @created="refreshInput()"></AddMore>
        <div v-if="isInvalid" class="text-danger">
            {{ errors[name] }}
        </div>
    </InputWrapper>
</template>

<script>

import InputWrapper from "../InputWrapper"
import AddMore from "../inputs/AddMore"



export default {
    components: { InputWrapper , AddMore},
    props: {
        name: String,
        label: String,
        classString: String,
        value: [String, Number, Boolean],
        options: [Array, Object],
        errors: Object,
        depend: String,
        token: String,
        configs: [Object]
    },

    data() {
        return {
            selectedValue: null,
            listValues: null,
            content: ""
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

        updateDepended(payload = null, type = null) {
            axios.post('/formy/update-dependents', {
                input: this.name,
                value: payload,
                type: type,
                _form: this.token.split('||')[0]
            })
                .then(res => {
                    this.listValues = res.data
                    this.selectedValue = null
                })
        },

        refreshInput() {
            axios.post('/formy/refresh-input', {
                _form: this.token.split('||')[0],
                input: this.name
            })
                .then(res => {
                    this.listValues = res.data.binding.options
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
