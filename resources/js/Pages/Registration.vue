<script setup>
import { defineProps, onMounted, computed } from 'vue';
import Layout from '@/Pages/Frontend/Layouts/Main.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast();
const flash = computed(() => usePage().props.flash);

const form = useForm({
    name: '',
    email: '',
    password: '',
    password_confirmation: '',
});

const submitForm = () => {
    if (form.password == form.password_confirmation) {
        form.post(`/register`, {
            onSuccess: () => {
                //flash.value.success && toast.success(flash.value.success);
                flash.value.error && toast.error(flash.value.error);
            },
        });
    }else{
        alert("Password didn't Match");
    }

}

</script>
<template>
    <Layout>
        <!-- Register Form -->
        <div class="container mx-auto px-4 py-8">
            <div class="max-w-md mx-auto bg-white shadow-md rounded-lg p-6">
                <h2 class="text-2xl font-bold mb-6 text-center">Create an Account</h2>
                <form @submit.prevent="submitForm">
                    <div class="mb-4">
                        <label for="name" class="block text-gray-700 font-bold mb-2">Name</label>
                        <input type="text" id="name" class="w-full p-2 border rounded-md" placeholder="Enter your name"
                            required v-model="form.name">
                    </div>
                    <div class="mb-4">
                        <label for="email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <input type="email" id="email" class="w-full p-2 border rounded-md"
                            placeholder="Enter your email" required v-model="form.email">
                    </div>
                    <div class="mb-4">
                        <label for="password" class="block text-gray-700 font-bold mb-2">Password</label>
                        <input type="password" id="password" class="w-full p-2 border rounded-md"
                            placeholder="Enter your password" required v-model="form.password">
                    </div>
                    <div class="mb-6">
                        <label for="confirm-password" class="block text-gray-700 font-bold mb-2">Confirm
                            Password</label>
                        <input type="password" id="confirm-password" class="w-full p-2 border rounded-md"
                            placeholder="Confirm your password" required v-model="form.password_confirmation">
                    </div>
                    <button type="submit"
                        class="bg-blue-500 text-white w-full py-2 rounded-md hover:bg-blue-600 cursor-pointer">Register</button>
                </form>
               
            </div>
        </div>
    </Layout>
</template>

<style></style>