<script setup>
import { defineProps, computed, onMounted } from 'vue';
import { Link, router, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';

const toast = useToast();

import Mainlayout from '../Layouts/Main.vue';
import TableComponent from '../../../Components/TableComponent.vue';

const props = defineProps({
    customers: Array,
});

const columns = [
    { key: 'name', label: 'Name', searchable: true, sortable: true },
    { key: 'email', label: 'Email', searchable: false, sortable: true },
    { key: 'phone', label: 'Phone', searchable: false, sortable: true },
    { key: 'address', label: 'Address', searchable: false, sortable: true },
    { key: 'actions', label: 'Actions', slot: 'actions-slot', searchable: false },
];

const deleteCustomer = (id) => {
    if (confirm('Are you sure you want to delete this customer?')) {
        router.delete(`/dashboard/customers/${id}`, {
            onSuccess: () => {
                toast.success('Customer deleted successfully');
            },
            onError: () => {
                toast.error('Failed to delete customer');
            },
        });
    }
}

</script>

<template>
    <Mainlayout>
        <main class="ml-64 p-8">
            <div class="flex justify-between items-center mb-6">
                <h2 class="text-2xl font-bold">Customers</h2>
                <Link href="/dashboard/customers/create" class="bg-blue-500 text-white px-4 py-2 rounded-md">
                Add Customer
                </Link>
            </div>

            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <TableComponent :data="customers" :columns="columns" :page-size="5">
                    <template #actions-slot="{ row }">
                        <div class="space-x-2">
                            <Link :href="`/dashboard/customers/${row.id}/edit`"
                                class="bg-yellow-500 text-white px-2 py-1 rounded-md">
                            Edit
                            </Link>
                            <button @click="deleteCustomer(row.id)"
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