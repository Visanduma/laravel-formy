<template>
    <InputWrapper>
        <label v-text="label"></label>
        <div v-for="(option,k) in listValues" :key="k" class="form-check">
            <input :id=" `formy-check-${k}` " v-model="selected"
                :class=" [ { 'is-invalid' : isInvalid }, 'form-check-input' ]" :name="name" :value="k" type="checkbox"
                @change="$emit('input', selected)">
            <label :for="`formy-check-${k}`" class="form-check-label">
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

import InputWrapper from "../InputWrapper.vue";
import AddMore from "../inputs/AddMore"



export default {
    components: { InputWrapper , AddMore},
    props: {
        name: String,
        label: String,
        classString: String,
        value: [Array, Object],
        options: [Array, Object],
        errors: Object,
        token: String,
        configs: [Object]
    },

    data() {
        return {
            selected: [],
            listValues: []
        }
    },

    mounted() {

        this.$root.$on(this.depend, (payload => {
            this.updateDepended(payload)
        }))

        this.selected = this.value === "" ? [] : this.value

        this.listValues = this.options
    },

    methods: {

        updateDepended(payload = null, type = null) {
            axios.post('/formy/update-dependents', {
                input: this.name,
                value: payload,
                type: type,
                _form: this.token.split('||')[0]
            })
                .then(res => {
                    this.listValues = res.data
                    this.selected = []
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
        }
    }
}
</script>
