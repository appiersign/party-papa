<template>
    <div class="col-sm-12 col-md-6 col-lg-3">
        <div class="card p-5">
            <div class="row d-flex align-items-center">
                <i class="col-sm-4 fas fa-2xl" :class="[icon]" style="font-size: 3.5vw"></i>
                <div class="col-sm-8 ml-5">
                    <h3 class="mb-0">{{ count }}</h3>
                    <h3>{{ name }}</h3>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "DashboardCard",
    props: {
        count: {
            type: Number
        },
        name: {
            type: String
        },
        icon: {
            type: String
        }
    }
}
</script>

<style scoped>

h2  {
    font-size: 1.8vw;
}

h3  {
    font-size: 1.4vw;
}

</style>
