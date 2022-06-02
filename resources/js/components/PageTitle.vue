<template>
    <h3 class="pb-5">{{ text }}</h3>
</template>

<script>
export default {
    name: "PageTitle",
    props: {
        text: {
            type: String,
            default: ''
        }
    }
}
</script>

<style scoped>

</style>
