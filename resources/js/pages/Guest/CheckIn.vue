<template>
    <guest-layout>
        <transition name="messenger">
            <div v-if="showMessageBox" class="card w-75 py-2 d-flex justify-content-center align-items-center my-5"
                 style="font-size: 1.3vw; color: #AD7835; background-color: #09090B;">
                <p>{{ message }}</p>
            </div>
        </transition>

        <div class="card w-75 p-2 py-4 animate__animated animate__fadeInUp" style="color: #AD7835; min-height: 100px; background-color: #09090B;">
            <form @submit.prevent="checkIn" class="row" action="">
                <div class="form-group col-10 mx-auto mb-4">
                    <label for="name"><b>Phone Number:</b></label>
                    <input v-model="guest.phone" type="tel" class="form-control mt-2" id="phone" required
                           placeholder="enter phone number">
                </div>
                <div class="form-group col-10 mx-auto">
                    <label for="email"><b>Entry Code:</b></label>
                    <input v-model="guest.entryCode" type="number" class="form-control mt-2" id="entry-code" required
                           placeholder="enter entry code">
                </div>

                <div class="form-group col-10 mx-auto">
                    <button type="submit" class="btn btn-block mt-4 w-100 text-white"><b>Check In</b></button>
                </div>
            </form>
        </div>
    </guest-layout>
</template>

<script>
import GuestLayout from "../../layouts/GuestLayout";

export default {
    name: "CheckIn",
    components: {GuestLayout},
    data() {
        return {
            showMessageBox: false,
            guest: {
                phone: '',
                entryCode: ''
            },
            message: 'Welcome champ!'
        };
    },
    methods: {
        checkIn() {
            fetch('/guests/check-in', {
                method: 'PUT',
                headers: {
                    'Content-Type': 'application/json',
                    'Accept': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                },
                body: JSON.stringify(this.guest)
            }).then(response => {
                response.json().then(data => {
                    this.showMessageBox = true;
                    if (response.ok) {
                        this.message = `Welcome ${data.message.name}`;
                        setTimeout(() => {
                            this.guest = {};
                        }, 3000);
                    } else {
                        this.message = data.message;
                    }
                    setTimeout(() => {
                        this.hideMessageBox();
                    }, 5000);
                });
            });
        },
        hideMessageBox() {
            this.showMessageBox = false;
        }
    }
}
</script>

<style scoped>
input, input:focus {
    background-color: #5b596b;
}

button {
    background-color: #AD7835;
}

.messenger-enter-from {
    height: 0;
}

.messenger-enter-to {
    height: 100px;
}

.messenger-enter-active {
    transition: all 0.1s ease-in;
}

.messenger-leave-from {
    height: 100px;
}

.messenger-leave-to {
    height: 0;
}

.messenger-leave-active {
    transition: all 0.1s ease-out;
}
</style>
