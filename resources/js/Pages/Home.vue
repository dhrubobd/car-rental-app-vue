<script setup>
import { defineProps } from 'vue';
import Layout from '@/Pages/Frontend/Layouts/Main.vue';

const props = defineProps({
  sliders: Array,
  products: Array,
})

</script>

<template>

  <Layout>
    <section class="bg-gray-100">
      <div class="max-w-7xl mx-auto px-4 py-20 flex flex-col-reverse lg:flex-row items-center justify-between">

        <!-- Text Content -->
        <div class="w-full lg:w-1/2 mt-10 lg:mt-0">
          <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-6">
            Rent Your Dream Car Today
          </h1>
          <p class="text-lg text-gray-600 mb-6">
            Choose from a wide range of vehicles at unbeatable prices. Reliable, convenient, and always on time.
          </p>
          <a href="#booking"
            class="inline-block bg-blue-600 text-white px-6 py-3 rounded-md text-lg font-medium hover:bg-blue-700 transition">
            Browse Cars
          </a>
        </div>

        <!-- Image -->
        <div class="w-full lg:w-1/2 flex justify-center">
          <img src="https://images.unsplash.com/photo-1562911791-c7a97b729ec5?auto=format&fit=crop&w=800&q=80"
            alt="Rental Car" class="w-full max-w-md rounded-lg shadow-lg">
        </div>

      </div>
    </section>
    <section>
      <div class="container mx-auto px-4 py-8">
        <h2 class="text-2xl font-bold mb-6">Featured Cars</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://dummyimage.com/300x200/ffcc00/fff&text=Car+1" alt="Car"
              class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="text-lg font-semibold">Car Name</h3>
              <p class="text-gray-600">Description goes here...</p>
              <div class="flex items-center mt-2">
                <span class="text-red-500 font-bold">$29.99</span>
                <span class="text-gray-400 line-through ml-2">$39.99</span>
              </div>
              <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs mt-2 inline-block">New Arrival</span>
            </div>
          </div>

          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://dummyimage.com/300x200/00ccff/fff&text=Car+2" alt="Car"
              class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="text-lg font-semibold">Car Name</h3>
              <p class="text-gray-600">Description goes here...</p>
              <div class="flex items-center mt-2">
                <span class="text-red-500 font-bold">$19.99</span>
                <span class="text-gray-400 line-through ml-2">$29.99</span>
              </div>
              <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs mt-2 inline-block">Popular</span>
            </div>
          </div>
          
          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://dummyimage.com/300x200/00ccff/fff&text=Car+2" alt="Car"
              class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="text-lg font-semibold">Car Name</h3>
              <p class="text-gray-600">Description goes here...</p>
              <div class="flex items-center mt-2">
                <span class="text-red-500 font-bold">$19.99</span>
                <span class="text-gray-400 line-through ml-2">$29.99</span>
              </div>
              <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs mt-2 inline-block">Popular</span>
            </div>
          </div>

          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://dummyimage.com/300x200/00ccff/fff&text=Car+2" alt="Car"
              class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="text-lg font-semibold">Car Name</h3>
              <p class="text-gray-600">Description goes here...</p>
              <div class="flex items-center mt-2">
                <span class="text-red-500 font-bold">$19.99</span>
                <span class="text-gray-400 line-through ml-2">$29.99</span>
              </div>
              <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs mt-2 inline-block">Popular</span>
            </div>
          </div>

          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://dummyimage.com/300x200/00ccff/fff&text=Car+2" alt="Car"
              class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="text-lg font-semibold">Car Name</h3>
              <p class="text-gray-600">Description goes here...</p>
              <div class="flex items-center mt-2">
                <span class="text-red-500 font-bold">$19.99</span>
                <span class="text-gray-400 line-through ml-2">$29.99</span>
              </div>
              <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs mt-2 inline-block">Popular</span>
            </div>
          </div>

          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://dummyimage.com/300x200/ffcc00/fff&text=Car+1" alt="Car"
              class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="text-lg font-semibold">Car Name</h3>
              <p class="text-gray-600">Description goes here...</p>
              <div class="flex items-center mt-2">
                <span class="text-red-500 font-bold">$29.99</span>
                <span class="text-gray-400 line-through ml-2">$39.99</span>
              </div>
              <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs mt-2 inline-block">New Arrival</span>
            </div>
          </div>

          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://dummyimage.com/300x200/00ccff/fff&text=Car+2" alt="Car"
              class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="text-lg font-semibold">Car Name</h3>
              <p class="text-gray-600">Description goes here...</p>
              <div class="flex items-center mt-2">
                <span class="text-red-500 font-bold">$19.99</span>
                <span class="text-gray-400 line-through ml-2">$29.99</span>
              </div>
              <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs mt-2 inline-block">Popular</span>
            </div>
          </div>
          
          <div class="bg-white shadow-md rounded-lg overflow-hidden">
            <img src="https://dummyimage.com/300x200/00ccff/fff&text=Car+2" alt="Car"
              class="w-full h-48 object-cover" />
            <div class="p-4">
              <h3 class="text-lg font-semibold">Car Name</h3>
              <p class="text-gray-600">Description goes here...</p>
              <div class="flex items-center mt-2">
                <span class="text-red-500 font-bold">$19.99</span>
                <span class="text-gray-400 line-through ml-2">$29.99</span>
              </div>
              <span class="bg-green-500 text-white px-2 py-1 rounded-full text-xs mt-2 inline-block">Popular</span>
            </div>
          </div>
          
        </div>
      </div>
    </section>
  </Layout>

</template>

<style></style>