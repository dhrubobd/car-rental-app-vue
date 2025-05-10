<script setup>
import { Link, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast();


const props = defineProps({
    car: Object
});


</script>

<template>
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <img :src="car.image" alt="Car" class="w-full h-48 object-cover" />
        <div class="p-4">
            <h3 class="text-2xl font-semibold">{{ car.name }}</h3>
            <p class="text-gray-600">
                <strong>Brand:</strong> {{ car.brand }}<br>
                <strong>Model:</strong> {{ car.model }}<br>
                <strong>Type:</strong> {{ car.car_type }}
            </p>
            <div class="flex items-center mt-2 mb-2">
                <h4 class="font-bold">Per Day:  <span class="text-orange-500 ">Tk. {{ car.daily_rent_price }}</span> </h4>
            </div>
            <div class="mt-4 text-red-800" v-if="usePage().props.auth.user == null">
                Please Login to Book this Car

            </div>
            <div v-else>
                <Link :href="`/cars/${car.id}/details`"
                    class="inline-block bg-blue-400 text-white px-6 py-2 rounded-md text-lg font-medium hover:bg-blue-500 transition cursor-pointer">
                Book Car
                </Link>
            </div>

        </div>
    </div>
</template>

<style></style>