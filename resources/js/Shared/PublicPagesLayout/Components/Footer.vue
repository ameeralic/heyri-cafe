<template>
    <footer class="p-4 bg-gray-100 md:p-8 lg:p-10 dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl text-center">
            <Link href="/" class="flex justify-center items-center text-2xl font-semibold text-gray-900 dark:text-white">
                <img :src="$page.props.siteLogo" class="mr-2 h-10 sm:h-10" alt="Logo" />
                {{ $page.props.siteName }}
            </Link>
            <p class="my-6 text-gray-500 dark:text-gray-400">
                {{ footerText }}
            </p>
            <ul class="flex flex-wrap justify-center items-center mb-6 text-gray-900 dark:text-white">
                <li v-for="link in footerLinks" :key="link">
                    <Link :href="link.url" class="mr-4 hover:underline md:mr-6">{{ link.text }}</Link>
                </li>
            </ul>
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ new Date().getFullYear() }} <a href="#"
                    class="hover:underline">{{ $page.props.siteName }}™</a>.
                All Rights Reserved.</span>
        </div>
    </footer>
</template>
<script>
export default {
    props:['footerText','footerLinks']
}
</script>
