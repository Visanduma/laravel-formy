<template>
    <InputWrapper :class="wrapperClassString">
        <label v-text="label"></label>
        <input :class="[{ 'is-invalid': errors[name]}, classString]" :name="name" :placeholder="placeholder"
            v-model="selectedValue" @input="$emit('input', selectedValue)" @keyup="callApi()">
        <div v-if="errors[name]" class="text-danger">
            {{ errors[name] }}
        </div>
        <div>
            <div v-if="loading" class="d-flex justify-content-center shadow suggesstions">
                <div class="spinner-border spinner-border-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
            <ul v-if="result.length" class="list-group shadow position-absolute">
                <li role="button" @click="setValue(o)" v-for="o in result" class="list-group-item" :key="o.id">{{
                o.title }}</li>
            </ul>
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
        wrapperClassString: String,
        placeholder: { type: String, default: "" },
        errors: Object,
        configs: [Array, Object],
        token: String
    },

    data() {

        return {
            result: [],
            selectedValue: '',
            timeout: null,
            loading: false,
        }
    },

    methods: {
        callApi() {

            if (this.timeout)
                clearTimeout(this.timeout)

            this.timeout = setTimeout(() => {
                this.loading = true
                fetch(this.configs.searchUrl + `&q=${this.selectedValue}&_form=${this.token.split('||')[0]}`)
                    .then((res) => res.json())
                    .then(data => {
                        this.result = data
                    })
                    .finally(() => {
                        this.loading = false
                    })
            }, 800);


        },

        setValue(item) {
            this.result = []
            this.selectedValue = item.title
            this.$emit('input', this.selectedValue)
        }
    }
}
</script>

<style scoped>
div.suggesstions {
    height: 50px;
    padding: 12px;
    border-radius: 0 0 12px 12px;
}
</style>
