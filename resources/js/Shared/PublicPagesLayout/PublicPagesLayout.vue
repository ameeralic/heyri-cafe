<template>
    <Notification></Notification>
    <Header :navMenu="navMenu"></Header>
    <div class="bg-gray-50 dark:bg-gray-900">
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
                    text:'Home',
                    url:'/'
                },
                {
                    text:'About',
                    url:'/about'
                },
                {
                    text:'Contact',
                    url:'/contact'
                }
            ],
            footerLinks: [
                {
                    text:'Home',
                    url:'/'
                },
                {
                    text:'About',
                    url:'/about'
                },
                {
                    text:'Contact',
                    url:'/contact'
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
import Footer from './Components/Footer.vue'

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
})
</script>