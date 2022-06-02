<template>
    <dashboard-layout>
        <page-title text="Invites" />
        <guest-list />
    </dashboard-layout>
</template>

<script>
import DashboardLayout from "../../layouts/DashboardLayout";
import GuestList from "../../components/GuestList";
import PageTitle from "../../components/PageTitle";
export default {
    name: "List",
    components: {PageTitle, GuestList, DashboardLayout}
}
</script>

<style scoped>

</style>
