<template>
    <dashboard-layout>
        <page-title title="Send Invite" />
        <div class="row">
            <div class="card col-md-4 offset-md-4 p-5 mt-5">
                <form action="">
                    <div class="row mb-3">
                        <div class="form-group container">
                            <label for="phoneNumber" class="mb-2">Phone Number:</label>
                            <input type="tel" class="form-control" id="phoneNumber" required placeholder="02XXXXXXXX">
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="form-group container">
                            <label for="gender" class="mb-2">Gender:</label>
                            <select class="form-control" id="gender" required>
                                <option value="" selected disabled>--- choose ---</option>
                                <option value="male">male</option>
                                <option value="female">female</option>
                            </select>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="form-group container">
                            <label for="gender" class="mb-2">Side:</label>
                            <select class="form-control" id="gender" required>
                                <option value="" selected disabled>--- choose ---</option>
                                <option value="nii pro">Nii Pro</option>
                                <option value="sign">Sign</option>
                            </select>
                        </div>
                    </div>
                    <div class="row">
                        <div class="container pt-3 d-flex justify-content-end">
                            <button class="btn btn-outline-dark col-4">invite</button>
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
export default {
    name: "Send",
    components: {PageTitle, DashboardLayout}
}
</script>

<style scoped>

</style>
