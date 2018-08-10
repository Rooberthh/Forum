<template>
    <div>
        <label for="file" class="avatar-label btn btn-primary">Choose an Avatar</label>
        <input class="file-input" type="file" name="avatar" accept="image/*" @change="onChange" id="file">
    </div>
</template>

<script >
    export default {
        methods: {
            onChange(e){
                if(! e.target.files.length) return;
                let file = e.target.files[0];

                let reader = new FileReader();
                reader.readAsDataURL(file);

                reader.onload = e => {
                    let src = e.target.result;
                    this.$emit('loaded',{ src, file })
                };
            }
        }
    }
</script>

<style scoped>
    .file-input {
        width: 0.1px;
        height: 0.1px;
        opacity: 0;
        overflow: hidden;
        position: absolute;
        z-index: -1;
    }

    .avatar-label {
        cursor: pointer;
    }
</style>
