<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

import { getToday } from '@/common'
import { reactive, onMounted, ref, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import InputError from '@/Components/InputError.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import MicroModal from '@/Components/MicroModal.vue';

const props = defineProps({
    'customers': Array,
    'items': Array,
})

const url = useForm({
    'downloadUrl': null,
    'fileName': 'test'
})

onMounted(() => {
})

const form = reactive({

})

const totalPrice = computed(() => {
    let total = 0
    itemList.value.forEach( item => {
        total += item.price * item.quantity
    })
    return total
})

const storePurchase = async () => {
    // axios.get(route('csv.download'), {
    //   responseType: "blob",
    // }).then((res) => {
    //   let mineType = res.headers["content-type"];
    //   const name = res.headers["content-disposition"];
    //   const blob = new Blob([res.data], { type: mineType });
    //   saveAs(blob, name);
    // })
    // .catch((error) => {
    //   console.log(error.messagae);
    // });

    try {
        url.downloadUrl = route('csv.download')
        setTimeout(() => {
        window.document.getElementById('download-link').click();
      }, 10);
    }
    catch(error) {
        console.log(error)
    }
}
</script>

<template>
    <Head title="購入画面" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">購入画面</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ValidationErrors class="mt-2" />
                        <section class="text-gray-600 body-font relative">
                            <form @submit.prevent="storePurchase">
                          <div class="container px-5 py-8 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                              <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                  <button class="flex mb-8 mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                    出力する
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        <a id="download-link" :href="url.downloadUrl" class="hidden">Link</a>
                        <!-- <a id="download-link" :href="route('csv.download')">Link1212</a> -->
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
