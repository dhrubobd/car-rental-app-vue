<script setup>
import { defineProps, onMounted, computed } from 'vue';
import Mainlayout from '../Layouts/Main.vue';
import { Link, router, useForm, usePage } from '@inertiajs/vue3';
import { useToast } from 'vue-toastification';
import TableComponent from '../../../Components/TableComponent.vue';

const toast = useToast();
const flash = computed(() => usePage().props.flash);

const props = defineProps({
    cars: Array,
});

const columns = [
    { key: 'image', label: 'Image', slot: 'image-slot', searchable: false },
    { key: 'name', label: 'Name', searchable: true, sortable: true },
    { key: 'brand', label: 'Brand', searchable: true, sortable: true },
    { key: 'model', label: 'Model', searchable: true, sortable: true },
    { key: 'year', label: 'Reg Year', searchable: true, sortable: true },
    { key: 'car_type', label: 'Car Type', searchable: true, sortable: true },
    { key: 'daily_rent_price', label: 'Price', searchable: true, sortable: true },
    { key: 'availability', label: 'Status', slot: 'status-slot', searchable: false, sortable: true },
    { key: 'actions', label: 'Actions', slot: 'actions-slot', searchable: false },
];

const deleteCar = (id) => {
    if (confirm('Are you sure, you want to delete this ?')) {
        router.delete(`/dashboard/cars/${id}`, {
            onSuccess: () => {
                flash.value.success && toast.success(flash.value.success);
                flash.value.error && toast.error(flash.value.error);
            },
            onError: () => {
                toast.error('Failed to delete car. Please try again.');
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
                <h2 class="text-2xl font-bold">Manage Cars</h2>
                <Link href="/dashboard/cars/create" class="bg-blue-500 text-white px-4 py-2 rounded-md">Add Car</Link>
            </div>
            <div class="bg-white shadow-md rounded-lg overflow-hidden">
                <TableComponent :data="cars" :columns="columns" :page-size="5">
                    <template #image-slot="{ row }">
                        <div v-if="row.image != ''">
                            <img :src="`../${row.image}`" alt="Car Image" class="w-10 h-10 rounded-full">
                        </div>
                        <div v-else>
                            <img src="https://dummyimage.com/80x80/000/fff&text=Car" alt="Car Image"
                                class="w-10 h-10 rounded-full">
                        </div>
                    </template>
                    <template #status-slot="{ row }">
                        <div v-if="row.availability == 1">
                            Available
                        </div>
                        <div v-else>
                            Not Available
                        </div>
                    </template>
                    <template #actions-slot="{ row }">
                        <div class="space-x-2">
                            <Link :href="`/dashboard/cars/${row.id}/edit`"
                                class="bg-yellow-500 text-white px-2 py-1 rounded-md">
                            Edit
                            </Link>
                            <button @click="deleteCar(row.id)"
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