<script setup>
import { Link, router } from '@inertiajs/vue3';
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
                <h4 class="text-orange-500 font-bold">Per Day: {{ car.daily_rent_price }}</h4>
            </div>
            <Link :href="`/cars/${car.id}/details`"
                class="inline-block bg-blue-400 text-white px-6 py-2 rounded-md text-lg font-medium hover:bg-blue-500 transition cursor-pointer">
            Book Car
            </Link>
        </div>
    </div>
    <!-- 
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <img :src="product.image" alt="Car" class="w-full h-48 object-cover" />
        <div class="p-4">
            <h3 class="text-lg font-semibold">
                {{ product.title }}
            </h3>
            <p class="text-gray-600">
                {{ product.short_des }}
            </p>
            <div class="flex items-center mt-2">
                <span class="text-red-500 font-bold">${{ product.is_discount ? product.discount_price : product.price
                }}</span>
                <span v-show="product.is_discount" class="text-gray-400 line-through ml-2">${{ product.price }}</span>
            </div>
            <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs mt-2 inline-block">
                {{ product.remark }}
            </span>
            <div class="flex space-x-2 mt-4">
                <AddToCart :product="product"/>

                <Link :href="`/products/${product.id}`" class="bg-gray-200 text-gray-700 px-4 py-2 rounded-md">
                    View Details
                </Link>
            </div>
        </div>
    </div>
    -->
</template>

<style></style>