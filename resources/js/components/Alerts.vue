<template>
    <div v-if="$page.props.error"
         class="card w-100 mx-auto px-2 py-3 mt-5 mb-3 bg-danger text-white text-center d-flex align-items-center">
        <p><b>{{ $page.props.error }}</b></p>
    </div>
    <transition name="success" @after-enter="hideSuccess" enter-from-class="success-enter-from" enter-active-class="success-enter-active">
        <div v-if="$page.props.success" id="success"
             class="card w-100 mx-auto px-2 py-3 mt-5 mb-3 bg-success text-white text-center d-flex align-items-center">
            <p><b>{{ $page.props.success }}</b></p>
        </div>
    </transition>
</template>

<script>
export default {
    name: "Alerts",
    data() {
        return {
            error: false,
            success: false
        }
    },
    methods: {
        hideSuccess() {
            setTimeout(() => {
                this.$page.props.success = '';
            }, 500);
        },
    },
}
</script>

<style scoped>
#success {
    height: 74px;
}

.success-enter-from {
    height: 0;
}

.success-enter-active {
    height: 74px;
    transition: height 1s ease-in-out;
}

.success-enter-to {
    height: 74px;
}

.success-leave-from {
    height: 74px;
}

.success-leave-active {
    height: 0;
    transition: height 1s ease-in-out;
}

.success-leave-to {
    height: 0;
}
</style>
