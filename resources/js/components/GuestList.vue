<template>
    <div class="row">
        <div class="col-md-12">
            <div class="card p-5">
                <table class="container table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Side</th>
                        <th>Arrived At</th>
                        <th>Actions</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Status</th>
                        <th>Gender</th>
                        <th>Phone Number</th>
                        <th>Side</th>
                        <th>Arrived At</th>
                        <th>Actions</th>
                    </tr>
                    </tfoot>

                    <tbody>
                    <tr v-for="(guest, g) in guests.data" :key="g">
                        <td>{{ guest.externalId }}</td>
                        <td>{{ guest.name }}</td>
                        <td><span class="badge"
                                  :class="{'bg-success': guest.arrivedAt !== 'n/a', 'bg-dark': guest.invitation[0].status === 'confirmed', 'bg-danger': guest.invitation[0].status === 'declined', 'bg-primary': guest.invitation[0].status === 'pending'}">
                            {{ guest.invitation[0].status }}</span>
                        </td>
                        <td>{{ guest.gender }}</td>
                        <td>{{ guest.phone }}</td>
                        <td>{{ guest.side }}</td>
                        <td>{{ guest.arrivedAt }}</td>
                        <td class="d-flex justify-content-around">
                            <inertia-link @click.prevent="deleteGuest(guest)" class="btn btn-outline-dark">
                                <i class="fa fas fa-trash"></i>
                            </inertia-link>
                            <inertia-link @click.prevent="inviteGuest(guest)" class="btn btn-outline-dark">
                                <i class="fa fas fa-refresh"></i>
                            </inertia-link>
                        </td>
                    </tr>
                    <tr v-if="guests.data.length === 0">
                        <td colspan="7" class="text-center">no guest yet!</td>
                    </tr>
                    </tbody>
                </table>
                <div class="row">
                    <div class="text-right container-fluid d-flex justify-content-end">
                        <inertia-link class="text-black" v-if="(guests.links) && guests.links.prev"
                                      :href="guests.links.prev">
                            previous
                        </inertia-link>
                        <inertia-link class="text-black px-5" v-if="(guests.links) && guests.links.next"
                                      :href="guests.links.next">
                            next
                        </inertia-link>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PageTitle from "./PageTitle";

export default {
    name: "GuestList",
    components: {PageTitle},
    props: {
        title: {
            type: String
        },
        guests: {
            type: Object
        }
    },
    methods: {
        deleteGuest(guest) {
            if (confirm("You are about to delete this guest?")) {
                return this.$inertia.delete(`/guests/${guest.externalId}`);
            }
        },
        inviteGuest(guest) {
            if (confirm("You are about to send another invitation to this guest?")) {
                return this.$inertia.post(`/guests/${guest.externalId}/invite`);
            }
        }
    }
}
</script>

<style scoped>

</style>
