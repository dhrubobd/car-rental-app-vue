<script setup>
import { defineProps } from 'vue';
import Layout from '@/Pages/Frontend/Layouts/Main.vue';
import CarCard from '../Components/CarCard.vue';

const props = defineProps({
  cars: Array,
})

</script>

<template>

  <Layout>
    <section class="bg-gray-100">
      <div class="max-w-7xl mx-auto px-4 py-20 flex flex-col-reverse lg:flex-row items-center justify-between">

        <!-- Text Content -->
        <div class="w-full lg:w-1/2 mt-10 lg:mt-0">
          <h1 class="text-4xl sm:text-5xl font-bold text-gray-800 mb-6">
            Rent Your <span class="text-orange-500">Dream Car</span> Today
          </h1>
          <p class="text-lg text-gray-600 mb-6">
            Choose from a wide range of vehicles at unbeatable prices. Reliable, convenient, and always on time.
          </p>
          <Link href="#booking"
            class="inline-block bg-blue-400 text-white px-6 py-3 rounded-md text-lg font-medium hover:bg-blue-500 transition cursor-pointer">
          Browse Cars
          </Link>
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
        <h2 class="text-4xl mb-6">Featured Cars</h2>
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-4 gap-6">
          <CarCard v-for="(car,index) in cars" :key="index" :car="car" />
        </div>
      </div>
    </section>
  </Layout>

</template>

<style></style>