<template>
    <div id="invitation" class="g-0">
        <div class="container-fluid">
            <div class="row g-0 d-flex align-items-center" style="height: 100vh">
                <div id="container" class="py-5 mx-auto">
                    <h1 id="main-header" class="text-center animate__animated animate__fadeInUp"
                        style="color: #9C6E38;">Celebrating</h1>
                    <h1 id="sub-header" class="text-center animate__animated animate__fadeInUp" style="color: #9C6E38;">
                        <strong>NIIPRO & SIGN</strong></h1>
                    <slot />
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    name: "GuestLayout"
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
