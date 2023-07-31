<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import { nl2br } from '@/common.js'
import { Inertia } from '@inertiajs/inertia';
import { reactive, onMounted, ref, toRefs, isRef, isReactive, computed } from 'vue'

defineProps({
  item : Object
})
onMounted(() => {
  for (let n = 0; n < 5; n++) {
    form.input('content'+n, '')
    // form['content'+n] = ''
  }
})
const form = useForm({
    name: '1212',
    memo: null,
    price: null,
    // content1: '',
    // content2: '',
    // content3: '',
    // content4: '',
    // content5: '',
})

const submit = () => {
  console.log(form.content1)
  form.post(route('items.test'))
}
Inertia.on()
const deleteItem = id =>{
  Inertia.delete(route('items.destroy',{item:id}), {
    onBefore: () => confirm('本当に削除しますか？')
  })
}
</script>

<template>
    <Head title="商品詳細" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">商品詳細</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-900">
                        <ValidationErrors class="mt-2" />
                        <section class="text-gray-600 body-font relative">
                          <div class="container px-5 py-8 mx-auto">
                            <div class="lg:w-1/2 md:w-2/3 mx-auto">
                              <div class="flex flex-wrap -m-2">
                                <div v-for="n in 5" :key="n" class="p-2 w-full">
                                  <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">コンテンツ{{ n }} :: {{ form['content'+n] }}</label>
                                    <input type="text" :id="'content'+n" :name="'content'+n" v-model="form['content'+n]" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <!-- <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                      {{item.name}}
                                    </div> -->
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="name" class="leading-7 text-sm text-gray-600">商品名</label>
                                    <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                      {{item.name}}
                                    </div>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="memo" class="leading-7 text-sm text-gray-600">メモ</label>
                                    <div id="memo" v-html="nl2br(item.memo)" class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 h-32 text-base outline-none text-gray-700 py-1 px-3 resize-none leading-6 transition-colors duration-200 ease-in-out">
                                    </div>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="price" class="leading-7 text-sm text-gray-600">商品価格</label>
                                    <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                      {{item.price}}
                                    </div>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="price" class="leading-7 text-sm text-gray-600">商品ステータス</label>
                                    <div class="w-full bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                      <span v-if="item.is_selling === 1">販売中</span>
                                      <span v-if="item.is_selling === 0">停止中</span>
                                    </div>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <Link as="button" @click="submit" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                    遷移テスト
                                  </Link>
                                </div>

                                <div class="p-2 w-1/2">
                                  <Link as="button" :href="route('items.edit', {item: item.id})" class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                    編集する
                                  </Link>
                                </div>

                                <div class="p-2 w-1/2">
                                  <button @click="deleteItem(item.id)" class="flex mx-auto text-white bg-red-500 border-0 py-2 px-8 focus:outline-none hover:bg-red-600 rounded text-lg">
                                    削除する
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
