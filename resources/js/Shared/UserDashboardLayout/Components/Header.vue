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
                        class="text-gray-800 dark:text-white hover:bg-gray-50 focus:ring-4 hidden md:flex cursor-pointer focus:ring-gray-300 font-medium rounded-lg items-center gap-2 md:mr-2 text-sm px-4 lg:px-5 py-2 lg:py-2.5 dark:hover:bg-gray-700 focus:outline-none dark:focus:ring-gray-800">
                    {{ $page.props.is_user_logged ? `Hi, ${$page.props.logged_user.full_name}` : 'Log in' }}
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                        stroke="currentColor" class="w-6 h-6">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M17.982 18.725A7.488 7.488 0 0012 15.75a7.488 7.488 0 00-5.982 2.975m11.963 0a9 9 0 10-11.963 0m11.963 0A8.966 8.966 0 0112 21a8.966 8.966 0 01-5.982-2.275M15 9.75a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                    </Link>
                    <Link :href="$page.props.is_user_logged ? '/logout' : '/register'"
                        :method="$page.props.is_user_logged ? 'post' : 'get'" as="button"
                        :type="$page.props.is_user_logged ? 'button' : ''"
                        class="text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 mr-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                    {{ $page.props.is_user_logged ? 'Sign out' : 'Get started' }}
                    </Link>
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
