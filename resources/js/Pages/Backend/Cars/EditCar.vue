<script setup>
import { ref, computed, onMounted } from 'vue';
import Mainlayout from '../Layouts/Main.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast();
const flash = computed(() => usePage().props.flash);

const props = defineProps({
    car: Object
});

const carImage = ref(null);

const form = useForm({
    name : '',
    brand : '',
    model : '',
    year : '',
    car_type : '',
    daily_rent_price : '',
    availability : '1',
    image : null,
    '_method': 'PUT',
});

const handleImage = (event) => {
    const file = event.target.files[0];
    if (file) {
        form.image = file;
        carImage.value = URL.createObjectURL(file);
    }
};

const submitForm = () => {
    form.post(`/dashboard/cars/${props.car.id}/edit`, {
        onSuccess: () => {
            flash.value.success && toast.success(flash.value.success);
            flash.value.error && toast.error(flash.value.error);
        },
        onError: () => {
            toast.error('Failed to update car. Please try again.');
        }
    });
};


onMounted(() => {
    if (props.car) {
        form.name = props.car.name;
        form.brand = props.car.brand;
        form.model = props.car.model;
        form.year = props.car.year;
        form.car_type = props.car.car_type;
        form.daily_rent_price = props.car.daily_rent_price;
        form.availability = props.car.availability;
        carImage.value = `/${props.car.image}`;
    }
});

</script>

<template>
    <Mainlayout>
        <!-- Main Content -->
        <main class="ml-64 p-8">
            <h2 class="text-2xl font-bold mb-6">Edit Car</h2>
            <form class="bg-white shadow-md rounded-lg p-6" @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="car-name" class="block text-gray-700 font-bold mb-2">Name</label>
                    <input type="text" id="car-name" class="w-full p-2 border rounded-md" placeholder="Enter car Name" required v-model="form.name">
                </div>
                <div class="mb-4">
                    <label for="car-brand" class="block text-gray-700 font-bold mb-2">Brand</label>
                    <input type="text" id="car-brand" class="w-full p-2 border rounded-md" placeholder="Enter car Brand" required v-model="form.brand">
                </div>
                <div class="mb-4">
                    <label for="car-model" class="block text-gray-700 font-bold mb-2">Model</label>
                    <input type="text" id="car-model" class="w-full p-2 border rounded-md" placeholder="Enter car Model" required v-model="form.model">
                </div>
                <div class="mb-4">
                    <label for="car-year" class="block text-gray-700 font-bold mb-2">Year</label>
                    <input type="text" id="car-year" class="w-full p-2 border rounded-md" placeholder="Enter car Year" required v-model="form.year">
                </div>
                <div class="mb-4">
                    <label for="car-type" class="block text-gray-700 font-bold mb-2">Car Type</label>
                    <input type="text" id="car-type" class="w-full p-2 border rounded-md" placeholder="Enter car Car Type" required v-model="form.car_type">
                </div>
                <div class="mb-4">
                    <label for="car-price" class="block text-gray-700 font-bold mb-2">Daily Rent Price</label>
                    <input type="text" id="car-price" class="w-full p-2 border rounded-md" placeholder="Enter car Daily Rent Price" required v-model="form.daily_rent_price">
                </div>
                <div class="mb-4">
                    <label for="car-availability" class="block text-gray-700 font-bold mb-2">Availability</label>
                    <select id="car-availability" class="w-full p-2 border rounded-md" v-model="form.availability">
                        <option value="1">Available</option>
                        <option value="0">Not Available</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="car-image" class="block text-gray-700 font-bold mb-2">Image</label>
                    <input type="file" id="car-image" class="w-full p-2 border rounded-md"  v-on:change="handleImage">
                </div>
                <div class="mb-4">
                    <img :src="carImage" alt="Car Image" class="w-25 h-25 rounded-full mb-2">
                </div>
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md cursor-pointer">Edit Car</button>
            </form>
        </main>
    </Mainlayout>
</template>

<style></style>