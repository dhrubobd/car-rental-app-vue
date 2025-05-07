<script setup>
import { defineProps, computed } from 'vue';
import Layout from '@/Pages/Frontend/Layouts/Main.vue';
import { useForm,  usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const props = defineProps({
    car: Object,
})

const toast = useToast();
const flash = computed(() => usePage().props.flash);

const form = useForm({
    car_id: '',
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
    let bookingDays = Math.round(dateDifference / (1000 * 3600 * 24));

    if (bookingDays < 0) {
        toast.error("To Date Can't Be less than From Date.");
    }
    else {
        bookingDays = bookingDays + 1;
        form.booking_days = bookingDays;
        form.car_id = props.car.id;
        form.post('/rentals/create', {
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

    <Layout>
        <section>
            <div class="container mx-auto px-4 py-8">
                <h2 class="text-4xl mb-6">Car Details</h2>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <div>
                        <!-- Car Image -->
                        <div class="w-full h-96 bg-gray-200 rounded-lg overflow-hidden mb-4">
                            <img id="main-image" :src="`/${car.image}`" alt="Car" class="w-full h-full object-cover">
                        </div>
                    </div>
                    <!-- Car Information -->
                    <div>
                        <h2 class="text-2xl font-bold mb-4">{{ car.name }}</h2>

                        <div class="flex items-center mt-4">
                            <strong>Per Day: </strong> <span class="text-red-500 font-bold text-xl px-2"> Tk. {{
                                car.daily_rent_price }}</span>
                        </div>
                        <div class="mt-4">
                            <h3 class="text-lg font-semibold">Car Details</h3>
                            <ul class="list-disc pl-6 text-gray-600">
                                <li>Brand: {{ car.brand }}</li>
                                <li>Model: {{ car.model }}</li>
                                <li>Type: {{ car.car_type }}</li>
                                <li>Reg. Year: {{ car.year }}</li>
                            </ul>
                        </div>

                        <div class="mt-4 text-red-800" v-if="usePage().props.auth.user == null">
                            Please Login to Book this Car

                        </div>
                        <div class="mt-4" v-else>
                            <form class="bg-white  p-6" @submit.prevent="submitForm">
                                <div class="mb-4">
                                    <label for="start-date" class="block text-gray-700 font-bold mb-2">Start
                                        Date</label>
                                    <input type="date" id="start-date" class="w-full p-2 border rounded-md" required
                                        v-model="form.start_date" :onfocus="disablePastDates">
                                </div>
                                <div class="mb-4">
                                    <label for="end-date" class="block text-gray-700 font-bold mb-2">End Date</label>
                                    <input type="date" id="end-date" class="w-full p-2 border rounded-md" required
                                        v-model="form.end_date" :onfocus="disablePastDates">
                                </div>
                                <button type="submit"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md cursor-pointer">Book the Car</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </Layout>

</template>

<style></style>