<script setup>
import Layout from '@/Pages/Frontend/Layouts/Main.vue';
</script>
<template>
    <Layout>
        <div class="container mx-auto px-4 py-8">
            <div class="container mx-auto px-4 py-8">
                <h2 class="text-4xl mb-6">Contact Us</h2>
            </div>
            <!-- Rentals Section -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <p class="text-center text-gray-600 mb-10">
                    Have a question or need help with a reservation? We're here to help. Fill out the form below and our
                    team will get back to you as soon as possible.
                </p>

                <form action="#" method="POST" class="space-y-6">
                    <div>
                        <label for="name" class="block text-gray-700 font-medium">Name</label>
                        <input type="text" id="name" name="name" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    <div>
                        <label for="email" class="block text-gray-700 font-medium">Email</label>
                        <input type="email" id="email" name="email" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    <div>
                        <label for="subject" class="block text-gray-700 font-medium">Subject</label>
                        <input type="text" id="subject" name="subject"
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" />
                    </div>

                    <div>
                        <label for="message" class="block text-gray-700 font-medium">Message</label>
                        <textarea id="message" name="message" rows="5" required
                            class="w-full border border-gray-300 rounded px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                    </div>

                    <div class="text-center">
                        <button type="submit"
                            class="bg-blue-600 text-white px-6 py-3 rounded font-medium hover:bg-blue-700 transition">
                            Send Message
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </Layout>
</template>

<style></style>