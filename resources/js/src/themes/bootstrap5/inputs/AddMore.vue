<template>
    <div>
        <slot>
            <a role="button" @click.prevent="visible = !visible" class="text-decoration-none">{{ visible ? '- Hide' : '+ Add' }}</a>
        </slot>
        <div v-show="visible" class="input-group mb-2">
            <input v-model="content" type="text" class="form-control" />
            <button type="button" @click.prevent="create()" class="btn btn-sm btn-light">Add</button>
        </div>
    </div>

</template>

<script>
export default {
    props: {
        token: String,
        input: String
    },
    data() {
        return {
            content: "",
            visible: false
        }
    },

    methods: {
        create() {
            axios.post('/formy/create-resource', {
                _form: this.token.split('||')[0],
                content: this.content,
                input: this.input
            })
                .then(res => {
                    this.$emit('created', this.content)
                    this.content = ""
                })
        }
    }
}
</script>
