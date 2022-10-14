<template>
    <InputWrapper>
        <label v-text="label"></label>
        <select :class="[{ 'is-invalid': errors[name]}, classString]" :name="name" @input="emitValue($event)"
            v-model="selectedValue">
            <option value disabled>Select</option>
            <option v-for="(option,k) in optionsList" :key="k" :selected=" k === value " :value="k">{{ option }}
            </option>

        </select>
        <div v-if="errors[name]" class="text-danger">
            {{ errors[name] }}
        </div>
    </InputWrapper>
</template>

<script>

import InputWrapper from "../InputWrapper"

export default {
    components: { InputWrapper },
    props: {
        name: String,
        label: String,
        classString: String,
        value: null,
        options: [Array, Object],
        errors: Object,
        depend: String,
        token: String,
    },

    data() {
        return {
            selectedValue: null,
            listValues: null
        }
    },

    mounted() {
        this.selectedValue = this.value

        this.$root.$on(this.depend, (payload => {
            this.updateDepended(payload)
        }))

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
                    this.selectedValue = ""

                })
        }

    },

    computed: {

        optionsList() {
            return this.listValues ?? this.options
        }

    }
}
</script>
