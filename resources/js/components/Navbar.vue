<template>
    <nav class="w-100 px-3 navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid d-flex justify-content-between">
            <Link class="navbar-brand" :href="`/`">Party Papa!</Link>
            <div id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <inertia-link class="nav-link" href="/guests"><b>Guests</b></inertia-link>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</template>

<script>
import Link from "@inertiajs/inertia-vue3";

export default {
    name: "Navbar",
    components: Link
}
</script>

<style scoped>

</style>
