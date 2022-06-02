<template>
    <dashboard-layout>
        <div class="row pb-5 mb-5">
            <dashboard-card name="guests" :count="totalGuests" icon="fa-user"/>
            <dashboard-card name="declined" :count="totalDeclinedGuests" icon="fa-thumbs-down"/>
            <dashboard-card name="confirmed" :count="totalConfirmedGuests" icon="fa-thumbs-up"/>
            <dashboard-card name="arrivals" :count="totalArrivedGuests" icon="fa-award"/>
        </div>
        <page-title text="Recent Guests" />
        <guest-list :guests="guests" />
    </dashboard-layout>
</template>

<script>
import DashboardLayout from "../layouts/DashboardLayout";
import DashboardCard from "../components/DashboardCard";
import GuestList from "../components/GuestList";
import PageTitle from "../components/PageTitle";

export default {
    name: "Dashboard",
    components: {PageTitle, GuestList, DashboardCard, DashboardLayout},
    props: {
        totalGuests: {
            type: Number,
            default: 0
        },
        totalDeclinedGuests: {
            type: Number,
            default: 0
        },
        totalConfirmedGuests: {
            type: Number,
            default: 0
        },
        totalArrivedGuests: {
            type: Number,
            default: 0
        },
        'guests': {
            type: Object,
            default: () => {}
        }
    }
}
</script>

<style scoped>

</style>
