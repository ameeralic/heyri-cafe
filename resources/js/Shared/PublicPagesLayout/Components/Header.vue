<template>
    <header>
        <nav class="bg-blue-100 border-gray-200 px-2 lg:px-6 py-2.5 dark:bg-gray-800">
            <div class="flex flex-wrap justify-between items-center mx-auto max-w-screen-xl">
                <Link href="https://flowbite.com" class="flex items-center">
                <img :src="$page.props.siteLogo" class="mr-2 h-6 sm:h-10" alt="Logo" />
                <span class="self-center text-sm md:text-xl font-semibold whitespace-nowrap dark:text-white">{{
                    $page.props.siteName
                }}</span>
                </Link>
                <div class="flex items-center lg:order-2">
                    <Link
                        :href="$page.props.is_user_logged ? $page.props.is_admin_logged ? '/admin-dashboard' : '/dashboard' : '/login'"
                        class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 cursor-pointer focus:ring-gray-300 font-medium rounded-lg flex items-center gap-2 md:mr-2 text-sm px-4 lg:px-5 py-2 lg:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                    {{ $page.props.is_user_logged ? `Hi, ${$page.props.logged_user.full_name}` : 'Log in' }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6" v-if="$page.props.is_user_logged">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    </Link>
                    <Link :href="$page.props.is_user_logged ? '/logout' : '/register'"
                        :method="$page.props.is_user_logged ? 'post' : 'get'" as="button"
                        :type="$page.props.is_user_logged ? 'button' : ''"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg hidden md:block text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    {{ $page.props.is_user_logged ? 'Sign out' : 'Get started' }}
                    </Link>
                    <button data-collapse-toggle="mobile-menu-2" type="button"
                        class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
                        aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z"
                                clip-rule="evenodd"></path>
                        </svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <div class="hidden justify-between items-center w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                    <ul class="flex flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                        <li v-for="link in navMenu" :key="link">
                            <Link :href="link.url"
                                class="rounded-lg block py-2 pr-4 pl-3 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-primary-700 lg:p-0  lg:dark:hover:text-white dark:hover:bg-gray-700 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-700"
                                :class="$page.url === link.url ? 'lg:text-primary-700 text-white rounded bg-primary-700 dark:text-white lg:bg-transparent' : 'lg:text-gray-700 dark:text-gray-400'"
                                aria-current="page">
                            {{ link.text }}</Link>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
    </header>
</template>
<script>
export default {
    props: ['navMenu']
}
</script>
