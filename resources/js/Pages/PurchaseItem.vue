<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, Link, useForm } from '@inertiajs/inertia-vue3';

const form = useForm({
    name: null,
    comment: null,
    price: null,
    end_at: null
})
</script>

<template>
    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard</h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="flex justify-center">
                        <div class="mt-2 w-1/2">
                            <table class="table-auto w-full text-center m-4 border-collapse border">
                                <thead>
                                  <tr>
                                    <th class="px-4 py-2 title-font tracking-wider font-medium text-gray-900 text-sm border w-1/4 bg-yellow-400 rounded-tl rounded-bl">店舗名</th>
                                    <th class="px-4 py-2 title-font tracking-wider font-medium text-gray-900 text-sm border w-1/4">新宿南口店</th>
                                    <th class="px-4 py-2 title-font tracking-wider font-medium text-gray-900 text-sm border w-1/4 bg-yellow-400">発注者氏名</th>
                                    <th class="px-4 py-2 title-font tracking-wider font-medium text-gray-900 text-sm border w-1/4">
                                        <input type="text" id="name" name="name" v-model="form.name" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    </th>
                                  </tr>
                                </thead>
                            </table>
                            <table class="table-auto w-full text-left m-4 border-collapse border">
                                <tbody>
                                  <tr>
                                    <td class="px-4 py-2 border w-1/4 bg-yellow-400">タイトル</td>
                                    <td class="px-4 py-2 border w-3/4 bg-gray-100" colspan="3"></td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border w-1/4 bg-yellow-400">リクエスト締切日</td>
                                    <td class="px-4 py-2 border w-3/4 bg-gray-100" colspan="3"></td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border w-1/4 bg-yellow-400">納品日</td>
                                    <td class="px-4 py-2 border w-3/4 bg-gray-100" colspan="3"></td>
                                  </tr>
                                  <tr>
                                    <td class="px-4 py-2 border w-1/4 bg-yellow-400">ご請求月</td>
                                    <td class="px-4 py-2 border w-1/4 bg-gray-100"></td>
                                    <td class="px-4 py-2 border w-1/4 bg-yellow-400">経費</td>
                                    <td class="px-4 py-2 border w-1/4 bg-gray-100"></td>
                                  </tr>
                                </tbody>
                            </table>
                            <table class="table-auto w-full text-center m-4 border-collapse border">
                                <tbody>
                                  <tr>
                                    <td class="px-4 py-2 border w-1/4 bg-yellow-400">コメント<br>
                                        <span class="text-xs">事務局へのご要望等は<br>こちらにご入力ください</span></td>
                                    <td class="px-4 py-2 border w-3/4">
                                        <textarea type="text" id="name" name="name" v-model="form.comment" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                        </textarea>
                                    </td>
                                  </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="mt-2 w-1/2">
                            <Link as="button" :href="route('items.create')"
                                    class="flex ml-auto text-white bg-indigo-500 border-0 py-2 px-6 focus:outline-none hover:bg-indigo-600 rounded"
                                >aaaa</Link>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </AuthenticatedLayout>
</template>
