<template>
    <div class="card text-center">
        <div class="p-5">
            <slot name="title"></slot>
            <slot name="body"></slot>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['url'],

        data() {
            return {
                data: 1
            };
        },
        created()
        {
            axios.get(url)
                .then(response => {
                    console.log(response.data);
                })
        }
    }
</script>

<style scoped>

</style>
