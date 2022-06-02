<template>
    <div v-if="$page.props.error" class="card w-100 mx-auto px-2 py-3 mt-5 mb-3 bg-danger text-white text-center d-flex align-items-center">
        <p><b>{{ $page.props.error }}</b></p>
    </div>
    <div v-if="$page.props.success" class="card w-100 mx-auto px-2 py-3 mt-5 mb-3 bg-success text-white text-center d-flex align-items-center">
        <p><b>{{ $page.props.success }}</b></p>
    </div>
</template>

<script>
export default {
    name: "Alerts"
}
</script>

<style scoped>

</style>
