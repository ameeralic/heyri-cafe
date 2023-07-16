<template>
    <div
        class="max-h-screen overflow-x-scroll fixed top-0 bottom-0 left-0 right-0 border-2 border-darkGreen m-2 md:m-10 bg-fixed no-scrollbar"
    >
        <div
            class="min-h-screen bg-fixed"
            style="background-image: url(/static/bg-pattern.png)"
        >
            <div
                class="max-w-6xl md:max-w-4xl mx-auto py-3 md:py-10 bg-bgGreen"
            >
                <div class="mx-auto">
                    <p
                        class="font-bold text-sm font-merienda flex justify-center gap-6 mb-5 md:mb-20"
                    >
                        <Link
                            href="/"
                            class="underline hover:text-olive cursor-pointer"
                        >
                            Home</Link
                        >
                        <Link
                            href="/#menu"
                            class="underline hover:text-olive cursor-pointer"
                        >
                            Menu</Link
                        >
                        <Link
                            href="/order-now"
                            class="underline hover:text-olive cursor-pointer"
                        >
                            Order Now</Link
                        >
                        <Link
                            href="/contact"
                            class="underline hover:text-olive cursor-pointer"
                        >
                            Contact Us</Link
                        >
                    </p>
                    <slot></slot>
                    <div class="mt-10">
                        <p class="text-lg text-center">+1 213-389-6138</p>
                        <p class="text-lg text-center">
                            755 S Hobart Blvd, Los Angeles, CA 90005, United
                            States
                        </p>
                        <p class="text-lg text-center">
                            &#169; 2022 heyri cafe - Designed by
                            <a href="http://ameer.website" target="_blank"
                                >Ameerali C</a
                            >
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <Footer :footerLinks="footerLinks"></Footer> -->
</template>
<script>
export default {
    data() {
        return {
            navMenu: [
                {
                    text: "Home",
                    url: "/",
                },
                {
                    text: "About",
                    url: "/about",
                },
                {
                    text: "Contact",
                    url: "/contact",
                },
            ],
            footerLinks: [
                {
                    text: "Home",
                    url: "/",
                },
                {
                    text: "About",
                    url: "/about",
                },
                {
                    text: "Contact",
                    url: "/contact",
                },
            ],
        };
    },
};
</script>
<script setup>
import Notification from "../AdminDashboardLayout/components/Notification.vue";

import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import Header from "./Components/Header.vue";
import Footer from "./Components/Footer.vue";

// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
<style scoped>
/* Hide scrollbar for Chrome, Safari and Opera */
.no-scrollbar::-webkit-scrollbar {
    display: none;
}

/* Hide scrollbar for IE, Edge and Firefox */
.no-scrollbar {
    -ms-overflow-style: none; /* IE and Edge */
    scrollbar-width: none; /* Firefox */
}
</style>
