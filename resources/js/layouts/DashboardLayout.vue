<template>
    <div class="col-sm-12">
        <navbar/>
        <div class="">
            <div class="w-75 mx-auto p-5 mt-5">
                <slot/>
            </div>
        </div>
    </div>
</template>

<script>
import Navbar from "../components/Navbar";

export default {
    name: "DashboardLayout",
    components: {Navbar}
}
</script>

<style scoped>

</style>
