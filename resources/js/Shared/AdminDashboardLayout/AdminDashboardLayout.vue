<template>
    <Notification></Notification>
    <NavSidebar :siteLogo="$page.props.siteLogo" :siteName="$page.props.siteName"
        :userAvatar="$page.props.logged_user.avatar" :userName="$page.props.logged_user.full_name"
        :userEmail="$page.props.logged_user.email" :navMenu="navMenu" :sidebarMenu="sidebarMenu">
        <div class="md:px-4 py-4 sm:ml-64 dark:bg-gray-900">
            <div class="px-2 md:px-4  pt-4 pb-32 mt-14 min-h-screen">
                <slot></slot>
            </div>
            <Footer></Footer>
        </div>
    </NavSidebar>
</template>
<script setup>
import { onMounted } from "vue";
import { initFlowbite } from "flowbite";
import NavSidebar from "./components/NavSidebar.vue";
import Footer from "./components/Footer.vue";

// import Sidebar from "./components/Sidebar.vue";
import Notification from "./components/Notification.vue";
import {
    ChartPieIcon,
    CogIcon,
    ArrowRightOnRectangleIcon,
    DocumentTextIcon,
    UserCircleIcon,
    BookOpenIcon,
    BookmarkIcon,
    UserGroupIcon,
    Cog6ToothIcon
} from "@heroicons/vue/24/solid";
// initialize components based on data attribute selectors
onMounted(() => {
    initFlowbite();
});
</script>
<script>
export default {
    data() {
        return {
            navMenu: [
                {
                    name: "Dashboard",
                    link: "/admin-dashboard",
                    method: "get",
                },
                {
                    name: "Profile Info",
                    link: "/admin-dashboard/profile-info",
                    method: "get",
                },
                {
                    name: "Sign out",
                    link: "/logout",
                    method: "post",
                    as: "button", type: "button",

                },
            ],
            sidebarMenu: [
                {
                    name: "Dashboard",
                    link: "/admin-dashboard",
                    method: "get",
                    icon: ChartPieIcon,
                },
                {
                    name: "Users",
                    link: "/admin-dashboard/users",
                    method: "get",
                    icon: UserGroupIcon,
                    subMenu: [
                        {
                            name: "Create",
                            link: "/admin-dashboard/users/create",
                        },
                        {
                            name: "All users",
                            link: "/admin-dashboard/users",
                        },
                    ],
                },
                {
                    name: "Personal Info",
                    link: "/admin-dashboard/profile-info",
                    method: "get",
                    icon: Cog6ToothIcon,
                },
                {
                    name: "Sign out",
                    link: "/logout",
                    method: "post",
                    as: "button", type: "button",
                    icon: ArrowRightOnRectangleIcon,
                },
            ],
        };
    },
};
</script>
