<template>
    <guest-layout>
        <div id="strict-note-container"
             class="d-flex align-items-center justify-content-center m-0 mt-5 mx-auto animate__animated animate__fadeInUp"
             style="background-color: #09090B;">
            <p id="strict-note" class="m-0 px-3 py-2 text-center" style="color: #AD7835"><b>{{ strictNote }}</b>
            </p>
        </div>

        <div id="details-container"
             class="d-flex align-items-center justify-content-center flex-column m-0 mt-5 mx-auto animate__animated animate__fadeInUp">
            <transition name="details">
                <div v-if="showDetails"
                     class="d-flex align-items-center justify-content-center flex-column">
                    <p id="theme" class="m-0 details-font" style="color: #ABABAB"><b>COCKTAILS & VIBES</b></p>
                    <p id="version" class="m-0 details-font" style="color: #ABABAB">V1.0</p>
                    <p id="date" class="m-0 details-font" style="color: #ABABAB">June 18, 2022 @ 1900hrs</p>
                    <p id="greetings" class="m-0 mt-3 text-center" style="color: #ABABAB">
                        Hi {{ invitation.guest.name }}, looking forward to celebrate our birthday with you,
                        we hope
                        you can make it!
                    </p>
                </div>
            </transition>

            <div class="row mt-4 d-flex w-xs-100 w-75 justify-content-end">
                <transition name="declined">
                    <a v-show="declining && showDefaultButton" @click.prevent="decline" href="#"
                       class="text-center py-2 no-decoration button px-1"
                       style="border: 2px solid #9C6E38; color: #9C6E38; overflow:hidden; white-space: nowrap;">
                        {{ declineButtonText }}
                    </a>
                </transition>
                <transition @after-leave="">
                    <a v-show="!declining && !confirmed && !declined && !confirming" @click.prevent="decline" href="#"
                       class="text-center py-2 no-decoration button px-1"
                       style="border: 2px solid #9C6E38; color: #9C6E38; overflow:hidden; white-space: nowrap; width: 40%">
                        {{ 'No, I can\'t make it' }}
                    </a>
                </transition>

                <transition @after-leave="">
                    <a v-show="!declined && !confirmed && !confirming && !declining" @click.prevent="confirm" href="#"
                       class="text-center py-2 no-decoration button"
                       :style="'background-color: #9C6E38; color: white; width: 60%'">
                        Yes, I will be there!
                    </a>
                </transition>
                <transition name="confirmed">
                    <a v-show="confirming && showDefaultButton" href="#"
                       class="text-center py-2 no-decoration button"
                       :style="'background-color: #9C6E38; color: white'">
                        {{ confirmButtonText }}
                    </a>
                </transition>
            </div>
        </div>
    </guest-layout>
</template>

<script>
import Link from "@inertiajs/inertia-vue3";
import GuestLayout from "../../layouts/GuestLayout";

export default {

    name: "ShowInvitation",
    components: {GuestLayout, Link},
    props: {
        invitation: {
            type: Object,
            required: true
        }
    },
    data() {
        return {
            showNames: false,
            declined: false,
            confirmed: false,
            confirming: false,
            declining: false,
            confirmedWidth: 60,
            confirmButtonText: 'Yes, I will be there!',
            declineButtonText: 'No, I can\'t make it',
            showDetails: true,
            strictNote: 'STRICTLY BY INVITATION',
            showDefaultButton: true,
        }
    },
    mounted() {
        this.confirmed = this.invitation.status === 'confirmed';
        this.declined = this.invitation.status === 'declined';
    },
    methods: {
        confirmationRequest(status) {
            return fetch(`/invitations/${this.invitation.external_id}`, {
                headers: {
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                    'Content-Type': 'application/json',
                    'Accept': 'application/json'
                },
                method: 'PUT',
                body: JSON.stringify({status: status}),
            });
        },
        decline() {
            this.declining = true;
            this.declineButtonText = 'declining. . . .'
            this.confirmationRequest('declined').then(response => {
                if (response.ok) {
                    this.declined = true;
                    this.hideDetails();
                } else {
                    this.confirmButtonText = 'declining failed, please try again'
                }
            })
        },
        confirm() {
            this.confirming = true;
            this.confirmButtonText = 'confirming. . . .'
            this.confirmationRequest('confirmed').then(response => {
                if (response.ok) {
                    this.confirmed = true;
                    this.hideDetails();
                } else {
                    this.confirmButtonText = 'confirmation failed, please try again'
                }
            });
        },
        closeTab() {
            window.close();
        },
        hideDetails() {
            this.showDetails = false;
            this.showDefaultButton = false;

            if (this.confirmed) {
                this.strictNote = 'THANKS FOR ACCEPTING TO PARTY WITH US... SEE YA!';
                this.confirmButtonText = 'close';
            } else {
                this.strictNote = 'OH SNAP! SO SAD YOU CAN\'T MAKE IT, IF THIS IS A MISTAKE, PLEASE REQUEST FOR ANOTHER INVITATION';
                this.declineButtonText = 'close';
            }
        }
    }
}
</script>

<style scoped>
@media (max-width: 576px) {
    #container {
        width: 100%!important;
    }

    #main-header {
        font-size: 6vw!important;
    }

    #sub-header {
        font-size: 9vw!important;
        white-space: nowrap;
    }

    #strict-note-container {
        width: 70%;
        min-height: 10px!important;
    }

    #strict-note {
        font-size: 3vw!important;
    }

    #details-container {
        width: 100%;
        min-height: 50px;
    }

    #greetings {
        font-size: 3.2vw!important;
    }

    .details-font {
        font-size: 4vw!important;
    }

    .button {
        font-size: 2vw!important;
    }
}

@media (max-width: 769px) {
    #container {
        width: 70%!important;
    }

    #main-header {
        font-size: 5vw!important;
    }

    #sub-header {
        font-size: 7vw!important;
        white-space: nowrap;
    }

    #strict-note-container {
        width: 70%;
        min-height: 10px!important;
    }

    #strict-note {
        font-size: 2vw!important;
    }

    #greetings {
        font-size: 2.2vw!important;
    }

    .details-font {
        font-size: 3vw!important;
    }

    .button {
        font-size: 1.6vw!important;
    }
}

#container {
    width: 45%;
    min-height: 400px;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

#main-header {
    font-size: 3vw
}

#sub-header {
    font-size: 4.5vw;
    white-space: nowrap;
}

#strict-note-container {
    min-width: 100px;
    min-height: 80px
}

#strict-note {
    font-size: 1.4vw
}

#invitation {
    background-color: #1E1D25;
    min-height: 100vh;
    /*background-image: url("/images/invitation-bg.jpeg");*/
}

/*#greetings {*/
/*    font-size: 1.2vw!important;*/
/*}*/

/*.details-font {*/
/*    font-size: 1.6vw!important;*/
/*}*/

#confirm {
    width: 60%;
}

#decline {
    width: 40%;
}

.no-decoration {
    text-decoration: none;
}

.details-leave-from {
    opacity: 1;
    height: 193.55px;
    transform: translatey(0);
}

.details-leave-active {
    transition: all 0.5s ease-in-out;
}

.details-leave-to {
    opacity: 0;
    height: 0;
    transform: translateY(-200px);
}

.confirmed-enter-active {
    transition: all 0.8s ease-in-out;
}

.confirmed-enter-from {
    width: 60% !important;
}

.confirmed-enter-to {
    width: 100% !important;
}

.confirmed-leave-active {
    transition: all 0.5s ease-in-out;
}

.confirmed-leave-from {
    width: 60% !important;
}

.confirmed-leave-to {
    width: 0 !important;
}

.declined-enter-active {
    transition: all 0.5s ease-in-out;
}

.declined-enter-from {
    width: 40% !important;
}

.declined-enter-to {
    width: 100% !important;
}

.declined-leave-active {
    transition: all 0.8s ease-in-out;
}

.declined-leave-from {
    width: 40% !important;
}

.declined-leave-to {
    width: 0 !important;
}

.test-enter-from {
    opacity: 0;
    transform: translateY(20px);
}

.test-enter-to {
    opacity: 1;
    transform: translateY(0px);
}

.test-enter-active {
    transition: opacity 1s, transform 1s;
}
</style>
