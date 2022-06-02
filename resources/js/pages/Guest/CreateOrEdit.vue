<template>
    <dashboard-layout>
        <page-title text="Add Guest" />
        <div class="row d-flex flex-column">
            <alerts />
            <div class="card w-50 mx-auto p-5 mt-5">
                <form action="" @submit.prevent="save">
                    <div class="row mb-3">
                        <div class="form-group container">
                            <label for="phoneNumber" class="mb-2"><b>Phone Number:</b></label>
                            <input v-model="guest.phone" type="tel" class="form-control" :class="{'is-invalid': $page.props.errors.phone}" id="phoneNumber" required placeholder="02XXXXXXXX">
                            <div class="invalid-feedback">{{ $page.props.errors.phone }}</div>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group container">
                            <label for="gender" class="mb-2"><b>Gender:</b></label>
                            <select v-model="guest.gender" class="form-control" :class="{'is-invalid': $page.props.errors.gender}" id="gender" required>
                                <option value="" selected disabled>--- choose ---</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                            <div class="invalid-feedback">{{ $page.props.errors.gender }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group container">
                            <label for="gender" class="mb-2"><b>Side:</b></label>
                            <select v-model="guest.side" class="form-control" :class="{'is-invalid': $page.props.errors.side}" id="gender" required>
                                <option value="" selected disabled>--- choose ---</option>
                                <option value="NiiPro">Nii Pro</option>
                                <option value="Appier-Sign">Sign</option>
                            </select>
                            <div class="invalid-feedback">{{ $page.props.errors.side }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group container">
                            <label for="gender" class="mb-2"><b>Plus One:</b></label>
                            <select v-model="guest.guest_id" class="form-control" :class="{'is-invalid': $page.props.errors.side}" id="plus-one">
                                <option value="" selected disabled>--- choose ---</option>
                                <option v-for="(guest, g) in _guests" :value="guest.id" :key="g">{{ guest.name }} - {{ guest.phone }}</option>
                            </select>
                            <div class="invalid-feedback">{{ $page.props.errors.side }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container pt-3 d-flex justify-content-end">
                            <button class="btn btn-outline-dark col-4" type="submit">save</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </dashboard-layout>
</template>

<script>
import DashboardLayout from "../../layouts/DashboardLayout";
import PageTitle from "../../components/PageTitle";
import Alerts from "../../components/Alerts";
export default {
    name: "CreateOrEdit",
    components: {Alerts, PageTitle, DashboardLayout},
    props: {
        _guest: {
            type: Object,
            default: () => ({})
        },
        _guests: {
            type: Array,
            default: () => []
        },
    },
    data() {
        return {
            guest: {}
        };
    },
    mounted() {
        if (this._guest.id) {
            this.guest = this._guest;
        }
    },
    methods: {
        save() {
            if (this.guest.id) {
                return this.$inertia.put(`/guests/${this.guest.externalId}`, this.guest);
            }

            return this.$inertia.post(`/guests`, this.guest);
        }
    }
}
</script>

<style scoped>

</style>
