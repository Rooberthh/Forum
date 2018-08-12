<template>
    <div class="card text-center">
        <div class="p-5">
            <slot name="title"></slot>
            <h2 v-text="data"></h2>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['url'],
        data() {
            return {
                data: 'Loading...',
            };
        },
        created()
        {
            axios.get(this.url)
                .then(response => {
                    this.data = response.data;
                })
        }
    };
</script>

<style scoped>

</style>
