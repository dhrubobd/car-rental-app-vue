<script setup>
import { defineProps, ref, computed } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Mainlayout from '../Layouts/Main.vue';
import { useToast } from 'vue-toastification';

const toast = useToast();
const flash = computed(() => usePage().props.flash);

const form = useForm({
    name: '',
    email: '',
    phone:'',
    address: '',
    password: '',
});

const submitForm = () => {
    form.post('/dashboard/customers/create', {
        onSuccess: () => {
            flash.value.success && toast.success(flash.value.success);
            flash.value.error && toast.error(flash.value.error);
        },
    });
}

</script>
<template>
    <Mainlayout>
        <div class="flex ">
            <main class="ml-64 p-8">
                <h2 class="text-2xl font-bold mb-6">Add Customer</h2>
                <form class="bg-white shadow-md rounded-lg p-6" @submit.prevent="submitForm">
                    <div class="mb-4">
                        <label for="customer-name" class="block text-gray-700 font-bold mb-2">Name</label>
                        <input type="text" id="customer-name" class="w-full p-2 border rounded-md"
                            placeholder="Enter name" v-model="form.name" required>
                    </div>
                    <div class="mb-4">
                        <label for="customer-email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="customer-email" class="w-full p-2 border rounded-md"
                            placeholder="Enter email" v-model="form.email" required>
                    </div>
                    <div class="mb-4">
                        <label for="customer-phone" class="block text-gray-700 font-bold mb-2">Phone Number</label>
                        <input type="text" id="customer-phone" class="w-full p-2 border rounded-md"
                            placeholder="Enter phone number" v-model="form.phone">
                    </div>
                    <div class="mb-4">
                        <label for="customer-address" class="block text-gray-700 font-bold mb-2">Address</label>
                        <textarea id="customer-address" class="w-full p-2 border rounded-md"
                            placeholder="Enter address" v-model="form.address"></textarea>
                    </div>
                    <div class="mb-4">
                        <label for="customer-password" class="block text-gray-700 font-bold mb-2">Password</label>
                        <input type="password" id="customer-password" class="w-full p-2 border rounded-md"
                            placeholder="Enter password" v-model="form.password" required>
                    </div>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md cursor-pointer">Add Customer</button>
                </form>
            </main>
        </div>
    </Mainlayout>
</template>

<style></style>