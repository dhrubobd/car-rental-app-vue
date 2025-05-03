<script setup>
    import { Link } from '@inertiajs/vue3';
</script>
<template>
    <aside class="w-64 bg-gray-800 text-white h-screen fixed">
        <div class="p-4">
            <h3 class="text-xl font-bold mb-6">Admin Panel</h3>
            <ul class="mt-4 space-y-2">
                <li><Link href="/dashboard" class="hover:bg-gray-700 p-2 block rounded">Dashboard</Link></li>
                <li><Link href="/cars" class="hover:bg-gray-700 p-2 block rounded">Cars</Link></li>
                <li><Link href="/rentals" class="hover:bg-gray-700 p-2 block rounded">Rentals</Link></li>
                <li><Link href="/users" class="hover:bg-gray-700 p-2 block rounded">Users</Link></li>
                <li><Link href="/logout" class="hover:bg-gray-700 p-2 block rounded">Logout</Link></li>
            </ul>
        </div>
    </aside>
</template>


<style>

</style>