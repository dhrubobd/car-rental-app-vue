<script setup>
import { onMounted, computed } from 'vue';
import Mainlayout from '../Layouts/Main.vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast();
const flash = computed(() => usePage().props.flash);

const props = defineProps({
    cars: Object
});

const deleteCar = (id) => {
    if (confirm('Are you sure, you want to delete this ?')) {
        router.delete(`/dashboard/cars/${id}`, {
            onSuccess: () => {
                flash.value.success && toast.success(flash.value.success);
                flash.value.error && toast.error(flash.value.error);
            },
            onError: () => {
                toast.error('Failed to delete car. Please try again.');
            }
        });
    }
};

</script>

<template>
    <Mainlayout>
        <!-- Main Content -->
        <main class="ml-64 p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Cars</h2>
                <Link href="/dashboard/cars/create" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Car</Link>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-100">
                    <tr>
                        <th class="p-3 text-left">Car Name</th>
                        <th class="p-3 text-left">Image</th>
                        <th class="p-3 text-left">Brand</th>
                        <th class="p-3 text-left">Model</th>
                        <th class="p-3 text-left">Price</th>
                        <th class="p-3 text-left">Status</th>
                        <th class="p-3 text-left">Actions</th>
                    </tr>
                    </thead>
                    <tbody>
                    <tr class="border-b" v-for="(car, index) in cars" :key="index">
                        <td class="p-3">{{ car.name }}</td> 
                        <td class="p-3">
                            <div v-if="car.image != ''">
                                <img :src="`../${car.image}`" alt="Car Image" class="w-10 h-10 rounded-full">
                            </div>
                            <div v-else>
                                <img src="https://dummyimage.com/80x80/000/fff&text=Car" alt="Car Image" class="w-10 h-10 rounded-full">
                            </div>
                        </td>
                        <td class="p-3">{{ car.brand }}</td> 
                        <td class="p-3">{{ car.model }}</td> 
                        <td class="p-3">{{ car.daily_rent_price }}</td> 
                        <td class="p-3">{{ car.availability ? 'Available' : 'Not Available' }}</td> 
                        <td class="p-3 space-x-2">
                        <Link :href="`/dashboard/cars/${car.id}/edit`" class="bg-yellow-500 text-white px-2 py-1 rounded-md cursor-pointer">Edit</Link>
                        <button @click="deleteCar(car.id)" class="bg-red-500 text-white px-2 py-1 rounded-md cursor-pointer">Delete</button>
                        </td>
                    </tr>
                    <!-- Repeat for other Cars -->
                    </tbody>
                </table>
            </div>
        </main>
    </Mainlayout>
</template>

<style></style>