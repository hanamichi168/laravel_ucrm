<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link } from '@inertiajs/inertia-vue3';
import FlashMessage from '@/Components/FlashMessage.vue';
import Pagination from '@/Components/Pagination.vue'
import { onMounted } from 'vue'

defineProps({
    customers: Object
})

onMounted(() => {
  console.log('1212')
})
</script>

<template>
    <Head title="顧客一覧" />

    <ul v-for="customer in customers.data" :key="customer.id">
      <li>{{ customer.id }}</li>
      <li>{{ customer.name }}</li>
    </ul>
 <Pagination class="mt-6" :links="customers.links"></Pagination>
</template>
