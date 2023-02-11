<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

import { getToday } from '@/common'
import { reactive, onMounted, ref, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import MicroModal from '@/Components/MicroModal.vue';

const props = defineProps({
})
const ItemList = ref([])

const addItemList = () => {
    ItemList.value.push({
        file:ref(''),
        image_path:'',
        image_data:''
    })
}
onMounted(() => {
})

const form = useForm({
    items:ref([])
})
const fileSelect = (e, index) => {
    ItemList.value[index].file = e.target.files[0]
    ItemList.value[index].image_data = window.URL.createObjectURL(e.target.files[0])
}
const postConfirm = () => {
    ItemList.value.forEach( item => {
        form.items.push({
            file:item.file,
            image_path:item.image_path,
            image_data:item.image_data
        })
    })
    // console.log(route('request.confirm'))
    form.post(route('request.confirm'))
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
                                        <input class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                            aria-describedby="file_input_help" id="file_input" type="file" @change="fileSelect($event, index)">
                                    <img v-if="Item.image_data !=''" :src="Item.image_data">
                                </div>
                              </div>
                              <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                    <button @click="addItemList"
                                  class="flex mb-8 mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                    追加する
                                  </button>
                                  <button @click="postConfirm"
                                  class="flex mb-8 mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                    出力する
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
