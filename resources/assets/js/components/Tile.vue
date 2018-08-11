<template>
    <div class="card text-center">
        <div class="p-5">
            <slot name="icon"></slot>
            <slot name="title"></slot>
            <slot name="body"></slot>
            <a :href="url" class="btn btn-outline-danger font-weight-bold px-5 py-2" v-text="btnText"></a>
        </div>
    </div>
</template>

<script>
    export default {
        props: ['url', 'btnText'],
    };
</script>

<style scoped>

</style>
