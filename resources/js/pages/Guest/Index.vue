<template>
    <dashboard-layout>
        <div class="row">
            <alerts />
            <div class="col-md-12 d-flex justify-content-between align-items-center mb-3">
                <h3>Guests</h3>
                <form @submit.prevent="searchGuests" action="" class="d-flex">
                    <div class="input-group">
                        <select class="form-control" v-model="status">
                            <option value="" selected>all statuses</option>
                            <option value="confirmed">confirmed</option>
                            <option value="declined">declined</option>
                            <option value="arrived">arrived</option>
                        </select>
                    </div>
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="search name or number" v-model="search">
                        <div class="input-group-append">
                            <button class="btn btn-outline-secondary" type="submit">
                                <i class="fa fa-search"></i>
                            </button>
                        </div>
                    </div>
                </form>
                <inertia-link href="/guests/create" class="btn btn-outline-dark">add guest</inertia-link>
            </div>
        </div>
        <guest-list :guests="guests"/>
    </dashboard-layout>
</template>

<script>
import DashboardLayout from "../../layouts/DashboardLayout";
import GuestList from "../../components/GuestList";
import Alerts from "../../components/Alerts";

export default {
    name: "Index",
    components: {Alerts, GuestList, DashboardLayout},
    props: {
        guests: {
            type: Object,
            default: () => ({})
        }
    },
    data() {
        return {
            search: "",
            status: ''
        };
    },
    methods: {
        searchGuests() {
            return this.$inertia.get(`/guests`, {
                status: this.status,
                search: this.search
            });
        }
    },
    mounted() {
        const url = new URL(window.location.href);
        const search = url.searchParams.get("search");
        const status = url.searchParams.get("status");
        if (search) {
            this.search = search;
        }

        if (status) {
            this.status = status;
        }
    }
}
</script>

<style scoped>

</style>
