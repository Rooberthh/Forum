<template>
    <div>
        <p class="font-weight-bold">Choose an Avatar</p>
        <input type="file" name="avatar" accept="image/*" @change="onChange">
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
