<script setup>
import { ref, computed } from 'vue';
import Mainlayout from '../Layouts/Main.vue';
import { useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
const props = defineProps({
    customers: Array,
    cars: Array,
});


const toast = useToast();
const flash = computed(() => usePage().props.flash);

const form = useForm({
    customer: '',
    car: '',
    start_date: '',
    end_date: '',
    booking_days: '',
});



const submitForm = () => {
            let fromDate = document.getElementById('start-date').value;
            let toDate = document.getElementById('end-date').value;
            let date1 = new Date(fromDate);
            let date2 = new Date(toDate);
            let dateDifference = date2.getTime() - date1.getTime();
            let bookingDays = Math.round (dateDifference / (1000 * 3600 * 24));

            if(bookingDays<0){
                toast.error("To Date Can't Be less than From Date.");
            } 
            else 
            {
                bookingDays = bookingDays + 1;
                form.booking_days = bookingDays;
                form.post('/dashboard/rentals/create', {
                    onSuccess: () => {
                        flash.value.success && toast.success(flash.value.success);
                        flash.value.error && toast.error(flash.value.error);
                    },
                    onError: () => {
                        toast.error('Failed to add rental. Please try again.');
                    }
                });
            }
};

const disablePastDates = () => {
  var today = new Date();
  var dd = String(today.getDate()).padStart(2, '0');
  var mm = String(today.getMonth() + 1).padStart(2, '0'); //January is 0!
  var yyyy = today.getFullYear();

  today = yyyy + '-' + mm + '-' + dd;
  document.getElementById("start-date").setAttribute("min", today);
  document.getElementById("end-date").setAttribute("min", today);
}

</script>
<template>
    <Mainlayout>
        <!-- Main Content -->
        <main class="ml-64 p-8">
            <h2 class="text-2xl font-bold mb-6">Add Rental</h2>
            <form class="bg-white shadow-md rounded-lg p-6" @submit.prevent="submitForm">
                <div class="mb-4">
                    <label for="customer-name" class="block text-gray-700 font-bold mb-2">Customer Name</label>
                    <select id="customer-name" class="w-full p-2 border rounded-md" required v-model="form.customer">
                        <option value="">Select Customer</option>
                        <option v-for="(customer, index) in props.customers" :key="index" :value="customer.id">{{
                            customer.name }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="car-name" class="block text-gray-700 font-bold mb-2">Car Name</label>
                    <select id="car-name" class="w-full p-2 border rounded-md" required v-model="form.car">
                        <option value="">Select Car</option>
                        <option v-for="(car, index) in props.cars" :key="index" :value="car.id">{{
                            car.name }}</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="start-date" class="block text-gray-700 font-bold mb-2">Start Date</label>
                    <input type="date" id="start-date" class="w-full p-2 border rounded-md"  required v-model="form.start_date" :onfocus="disablePastDates">
                </div>
                <div class="mb-4">
                    <label for="end-date" class="block text-gray-700 font-bold mb-2">End Date</label>
                    <input type="date" id="end-date" class="w-full p-2 border rounded-md"  required v-model="form.end_date" :onfocus="disablePastDates">
                </div>
                
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md cursor-pointer">Add
                    Rental</button>
            </form>
        </main>
    </Mainlayout>
</template>



<style></style>