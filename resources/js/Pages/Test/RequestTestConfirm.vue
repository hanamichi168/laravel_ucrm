<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

import { getToday } from '@/common'
import { reactive, onMounted, ref, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import MicroModal from '@/Components/MicroModal.vue';

const props = defineProps({
    requests:Object
})
const ItemList = ref([])
onMounted(() => {
    console.log(props.requests.items)
    props.requests.items.forEach(request => {
        ItemList.value.push({
        file:ref(''),
        image_path:request.image_path,
        image_data:request.image_data
    })
    });
})

const form = useForm({
    items:props.requests.items
})

const postConfirm = async () => {
    console.log(form.file)
    await form.post(route('request.createBack'))
}
</script>

<template>
    <Head title="画像送信テスト画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">画像送信テスト</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ValidationErrors class="mt-2" />
                        <section class="text-gray-600 body-font relative">
                          <div class="container px-5 py-8 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                                <div v-for="(Item, index) in ItemList" :key="index" class="flex flex-wrap -m-2">
                                    <div class="p-2 w-full">
                                    <img v-if="Item.image_data !=''" :src="Item.image_data">
                                </div>
                              </div>
                              <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                  <button @click="postConfirm"
                                  class="flex mb-8 mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                    修正する
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
