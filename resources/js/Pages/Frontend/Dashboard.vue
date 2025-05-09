<script setup>
import Layout from '@/Pages/Frontend/Layouts/Main.vue';
import { defineProps, onMounted, computed } from 'vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import TableComponent from '../../Components/TableComponent.vue';
const props = defineProps({
    rentals: Array,
});
const Toast = useToast();
const flash = computed(() => usePage().props.flash);

const columns = [
    { key: 'car_name', label: ' Car Name', searchable: true, sortable: true },
    { key: 'car_brand', label: ' Car Brand', searchable: true, sortable: true },
    { key: 'start_date', label: 'Start Date', searchable: true, sortable: true },
    { key: 'end_date', label: 'End Date', searchable: true, sortable: true },
    { key: 'total_cost', label: 'Total Cost', searchable: true, sortable: true },
    { key: 'status', label: 'Status', searchable: true, sortable: true },
    { key: 'actions', label: 'Actions', slot: 'actions-slot', searchable: false },
];

const cancelRental = (id) => {
    if (confirm('Are you sure, you want to cancel this Rental?')) {
        router.post(`/rentals/${id}/cancel`, {
            onSuccess: () => {
                flash.value.success && toast.success(flash.value.success);
                flash.value.error && toast.error(flash.value.error);
            },
            onError: () => {
                toast.error('Failed to cancel this rental. Please try again.');
            }
        });
    }
};
</script>
<template>
    <Layout>
        <div class="container mx-auto px-4 py-8">
            <div class="container mx-auto px-4 py-8">
                <h2 class="text-2xl font-bold mb-6">Customer Dashboard</h2>
            </div>
            <!-- Rentals Section -->
            <div class="bg-white shadow-md rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Rental History</h3>
                <div class="overflow-x-auto">
                    <TableComponent :data="rentals" :columns="columns" :page-size="5">
                        <template #actions-slot="{ row }">
                            <div class="space-x-2" v-if="row.status == 'ongoing'">
                                <button @click="cancelRental(row.id)"
                                    class="bg-red-500 text-white px-2 py-1 rounded-md cursor-pointer">
                                    Cancel
                                </button>
                            </div>
                        </template>
                    </TableComponent>
                </div>
            </div>
        </div>
    </Layout>
</template>

<style scoped></style>