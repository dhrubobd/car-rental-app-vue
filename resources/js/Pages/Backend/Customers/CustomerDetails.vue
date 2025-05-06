<script setup>
import { defineProps, ref, computed, onMounted } from 'vue';
import { useForm, usePage } from '@inertiajs/vue3';
import Mainlayout from '../Layouts/Main.vue';
import { useToast } from 'vue-toastification';
import TableComponent from '../../../Components/TableComponent.vue';

const toast = useToast();
const flash = computed(() => usePage().props.flash);

const props = defineProps({
    customer: Object,
    rentals: Array,
});

const form = useForm({
    name: '',
    email: '',
    phone: '',
    address: '',
});

const columns = [
    { key: 'car_name', label: 'Car Name', searchable: true, sortable: true },
    { key: 'car_brand', label: 'Car Brand', searchable: true, sortable: true },
    { key: 'start_date', label: 'Start Date', searchable: false, sortable: true },
    { key: 'end_date', label: 'End Date', searchable: false, sortable: true },
    { key: 'total_cost', label: 'Total Cost', searchable: false, sortable: true },
    { key: 'status', label: 'Status', searchable: false, sortable: true },
];

onMounted(() => {
    if (props.customer) {
        form.name = props.customer.name;
        form.email = props.customer.email;
        form.phone = props.customer.phone;
        form.address = props.customer.address;
    }
});

</script>
<template>
    <Mainlayout>
        <div class="flex ">
            <main class="ml-128 p-8">
                <div class="border-2 rounded-lg p-6 mb-8 bg-white shadow-md">
                    <h2 class="text-2xl font-bold mb-6">{{ form.name }}'s Details</h2>
                    <div class="mb-8">
                        <label for="customer-email" class="block text-gray-700 font-bold mb-2">Email</label>
                        <div>{{ form.email }}</div>
                    </div>
                    <div class="mb-8">
                        <label for="customer-phone" class="block text-gray-700 font-bold mb-2">Phone Number</label>
                        <div>{{ form.phone }}</div>
                    </div>
                    <div class="mb-8">
                        <label for="customer-address" class="block text-gray-700 font-bold mb-2">Address</label>
                        <div>{{ form.address }}</div>
                    </div>
                </div>
                <div class="border-2 rounded-lg p-6 mb-8 bg-white shadow-md">
                    <h2 class="text-2xl font-bold mb-6">Rental History</h2>
                    <TableComponent :data="rentals" :columns="columns" :page-size="5">
                        <template #actions-slot="{ row }">
                            <div class="space-x-2">
                                
                            </div>
                        </template>
                    </TableComponent>
                </div>


            </main>
        </div>
    </Mainlayout>
</template>

<style></style>