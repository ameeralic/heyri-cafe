<template>
    <Notification></Notification>
    <Header></Header>
    <div class="max-w-4xl mx-auto px-4">
        <DashboardHeader :navMenu="navMenu"></DashboardHeader>
        <slot></slot>

    </div>
    <Footer :footerLinks="footerLinks"></Footer>
</template>
<script>
export default {
    data() {
        return {
            navMenu: [
                {
                    text: 'Home',
                    url: '/dashboard'
                },
                {
                    text: 'Profile Info',
                    url: '/dashboard/profile-info'
                },
            ],
            footerLinks: [
                {
                    text: 'Home',
                    url: '/'
                },
                {
                    text: 'About',
                    url: '/about'
                },
                {
                    text: 'Contact',
                    url: '/contact'
                }
            ]
        }
    },
}
</script>
<script setup>
import Notification from '../AdminDashboardLayout/components/Notification.vue';


import { onMounted } from 'vue'
import { initFlowbite } from 'flowbite'
import Header from './Components/Header.vue'
import DashboardHeader from './Components/DashboardHeader.vue';
// import Footer from './Components/Footer.vue'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>