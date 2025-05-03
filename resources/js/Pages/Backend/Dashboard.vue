<script setup>
    import Mainlayout from './Layouts/Main.vue';
    const props = defineProps({
        totalCars: Number,
        totalRevenue: Number,
        totalRentals: Number,
    });
</script>
<template>
    <Mainlayout>
        <main class="ml-64 p-8">
            <h2 class="text-2xl font-bold mb-6">Dashboard</h2>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <div class="bg-white shadow-md p-4 rounded-lg">
                <h3 class="text-lg font-semibold">Total Cars</h3>
                <p class="text-3xl text-blue-500">{{ totalCars }}</p>
                </div>
                <div class="bg-white shadow-md p-4 rounded-lg">
                <h3 class="text-lg font-semibold">Total Rentals</h3>
                <p class="text-3xl text-green-500">{{ totalRentals }}</p>
                </div>
                <div class="bg-white shadow-md p-4 rounded-lg">
                <h3 class="text-lg font-semibold">Total Revenue</h3>
                <p class="text-3xl text-red-500">${{ totalRevenue }}</p>
                </div>
            </div>
        </main>
    </Mainlayout>
</template>



<style>

</style>