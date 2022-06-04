<template>
    <dashboard-layout>
        <page-title text="Admin Login" />
        <div class="row d-flex flex-column">
            <alerts />
            <div class="card w-50 mx-auto p-5 mt-5">
                <form action="" @submit.prevent="login">
                    <div class="row mb-3">
                        <div class="form-group container">
                            <label for="phoneNumber" class="mb-2"><b>Username:</b></label>
                            <input v-model="user.username" type="text" class="form-control" :class="{'is-invalid': $page.props.errors.username}" id="phoneNumber" required placeholder="type username">
                            <div class="invalid-feedback">{{ $page.props.errors.username }}</div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group container">
                            <label for="phoneNumber" class="mb-2"><b>Password:</b></label>
                            <input v-model="user.password" type="password" class="form-control" :class="{'is-invalid': $page.props.errors.password}" id="phoneNumber" required placeholder="type password">
                            <div class="invalid-feedback">{{ $page.props.errors.password }}</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container pt-3 d-flex justify-content-end">
                            <button class="btn btn-outline-dark col-4" type="submit">{{ loginButtonText }}</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </dashboard-layout>
</template>

<script>
import DashboardLayout from "../layouts/DashboardLayout";
import PageTitle from "../components/PageTitle";
import Alerts from "../components/Alerts";
export default {
    name: "CreateOrEdit",
    components: {Alerts, PageTitle, DashboardLayout},
    props: {
    },
    data() {
        return {
            user: {},
            loginButtonText: "login",
        };
    },
    mounted() {
        this.loginButtonText = "login";
    },
    methods: {
        login() {
            return this.$inertia.post(`/login`, this.user);
        }
    }
}
</script>

<style scoped>

</style>
