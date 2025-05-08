<script setup>
import { ref, defineProps } from 'vue';
import Layout from '@/Pages/Frontend/Layouts/Main.vue';
import CarCard from '../../Components/CarCard.vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
    cars: Array,
})


const search = ref('')

const min_price = ref(null)
const max_price = ref(null)

const filterCars = () => {
    router.get('/cars', {
        search: search.value,
        min_price: min_price.value,
        max_price: max_price.value,
    }, {
        preserveState: true,
        preserveScroll: true,
    });
}



</script>

<template>

    <Layout>
        <!-- All Cars Content -->
        <div class="container mx-auto px-4 py-8">
            <h2 class="text-4xl mb-6">All Cars</h2>
            <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
                <!-- Filters Sidebar -->
                <div class="md:col-span-1 bg-white shadow-md p-4 rounded-lg">
                    <h3 class="text-lg font-semibold mb-4">Filters</h3>

                    <div class="flex-grow max-w-sm my-2">
                        <input type="text" placeholder="Search Cars by Name, Brand, Model, Type" v-on:keyup="filterCars" v-model="search"
                            class="w-full p-2 border rounded-md" />
                    </div>

                    <!-- Price Range Filter -->
                    <div>
                        <h4 class="text-sm font-semibold mb-2">Price Range</h4>
                        <div class="flex space-x-2">
                            <input type="number" placeholder="Min" class="w-full p-2 border rounded-md"
                                v-model="min_price">
                            <input type="number" placeholder="Max" class="w-full p-2 border rounded-md"
                                v-model="max_price">
                        </div>
                    </div>
                    <button class="mt-4 bg-blue-500 text-white px-4 py-2 rounded-md w-full cursor-pointer"
                        @click="filterCars">Apply Filters</button>
                </div>

                <!-- Car Grid -->
                <div class="md:col-span-3 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                    <CarCard v-for="(car, index) in cars" :key="index" :car="car" />
                </div>
            </div>
        </div>
    </Layout>

</template>

<style></style>