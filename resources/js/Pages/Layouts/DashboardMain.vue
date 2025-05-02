<script setup>
import Sidebar from './DashboardSidebar.vue';
</script>
<template>
    <div class="h-screen">
        <!-- Sidebar -->
        <Sidebar />

        <!-- Main Content -->
        <slot/>
    </div>
</template>



<style>

</style>