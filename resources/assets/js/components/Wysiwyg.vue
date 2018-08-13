<template>

    <at :members="members">
        <input id="trix" type="hidden" :name="name" :value="value">
        <trix-editor style="background-color: #fff" ref="trix" input="trix" :placeholder="placeholder"></trix-editor>
    </at>

</template>

<script>
    import Trix from 'trix';
    import At from 'vue-at'

    export default {
        components: { At },
        props: [
            'name',
            'value',
            'placeholder',
            'shouldClear'
        ],

        data() {
            return {
                members: [],
            }
        },
        mounted()
        {
            this.$refs.trix.addEventListener('trix-change', e => {
               this.$emit('input', e.target.innerHTML);
            });

            this.$watch('shouldClear', () => {
                this.$refs.trix.value = '';
            });

            axios.get('/api/users/search')
                .then( response => {
                    this.members = response.data;
                });

        }
    }
</script>

<style scoped>
    .editor{
        width: 400px;
        max-width: 100%;
        height: 80px;
        overflow: auto;
        white-space: pre-wrap;
        border: 1px solid grey;
        padding: .4em;

    }
</style>

