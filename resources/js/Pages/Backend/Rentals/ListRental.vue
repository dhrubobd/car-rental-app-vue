<script setup>
import { defineProps, onMounted, computed } from 'vue';
import Mainlayout from '../Layouts/Main.vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import TableComponent from '../../../Components/TableComponent.vue';

const toast = useToast();
const flash = computed(() => usePage().props.flash);

const props = defineProps({
    rentals: Array,
});

const columns = [

    { key: 'customer_name', label: 'Customer Name', searchable: true, sortable: true },
    { key: 'car_name', label: ' Car Name', searchable: true, sortable: true },
    { key: 'start_date', label: 'Start Date', searchable: true, sortable: true },
    { key: 'end_date', label: 'End Date', searchable: true, sortable: true },
    { key: 'total_cost', label: 'Total Cost', searchable: true, sortable: true },
    { key: 'status', label: 'Status', searchable: true, sortable: true },
    { key: 'actions', label: 'Actions', slot: 'actions-slot', searchable: false },
];

const deleteRental = (id) => {
    if (confirm('Are you sure, you want to delete this Rental?')) {
        router.delete(`/dashboard/rentals/${id}`, {
            onSuccess: () => {
                flash.value.success && toast.success(flash.value.success);
                flash.value.error && toast.error(flash.value.error);
            },
            onError: () => {
                toast.error('Failed to delete rental. Please try again.');
            }
        });
    }
};

</script>

<template>
    <Mainlayout>
        <!-- Main Content -->
        <main class="ml-64 p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Manage Rentals</h2>
                <Link href="/dashboard/rentals/create" class="bg-blue-500 text-white px-4 py-2 rounded-md">Create A Rental</Link>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <TableComponent :data="rentals" :columns="columns" :page-size="5">
                    <template #actions-slot="{ row }">
                        <div class="space-x-2">
                            <Link :href="`/dashboard/rentals/${row.id}/edit`"
                                class="bg-yellow-500 text-white px-2 py-1 rounded-md">
                            Edit
                            </Link>
                            <button @click="deleteRental(row.id)"
                                class="bg-red-500 text-white px-2 py-1 rounded-md cursor-pointer">
                                Delete
                            </button>
                        </div>
                    </template>
                </TableComponent>
            </div>
        </main>
    </Mainlayout>
</template>

<style></style>