<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head, useForm } from '@inertiajs/inertia-vue3';

import { getToday } from '@/common'
import { reactive, onMounted, ref, toRefs, isRef, isReactive, computed } from 'vue'
import { Inertia } from '@inertiajs/inertia';
import InputError from '@/Components/InputError.vue';
import ValidationErrors from '@/Components/ValidationErrors.vue';
import MicroModal from '@/Components/MicroModal.vue';

const props = defineProps({
    // 'customers': Array,
    'items': Array,
    'lists': Array,
    'selectOption': Object
})

onMounted(() => {
  console.log(props.lists)
  const a = toRefs(props.lists)
  //console.log(a['lists'])
    form.date = getToday()
    for (let index = 0; index < 8; index++) {
      if(index < 4) {
        selectList1s.value.push({
            id: index,
            select_no: null,
            name: '',
            image_url: ''
          })
          form.lists.push({
            nos: '0',
          })
      } else {
        selectList2s.value.push({
            id: index,
            select_no: null,
            name: '',
            image_url: ''
          })
      }
    }
    addDeletes.value.push({
      id:1,
    })

    props.items.forEach( item => { // 配列を1つずつ処理
        itemList.value.push({ // 配列に1つずつ追加
            id: item.id, name: item.name,
            price: item.price, quantity: 0 })
    })
})
const itemList = ref([])
const quantity = [ "0", "1", "2", "3", "4", "5", "6", "7", "8", "9"] // option用

const selectList1s = ref([])
const selectList2s = ref([])
const addDeletes = ref([])

const temp = reactive({
  addDeleteCount: 1
})

const form = reactive({
    date: null,
    customer_id: null,
    status: true,
    items: ref([]),
    lists: ref([]),

})

const totalPrice = computed(() => {
    let total = 0
    itemList.value.forEach( item => {
        total += item.price * item.quantity
    })
    return total
})

const storePurchase = () => {
    itemList.value.forEach( item => {
        if( item.quantity > 0 ) { // 0より大きいものだけ追加
            form.items.push({
                id : item.id,
                quantity: item.quantity
            })
        }
    })
    //Inertia.post(route('purchases.store'), form)
}

const changeSelectOption = (no, e) => {
  let selectNo = e.target.value
  console.log(props.selectOption[selectNo].name2)
  if (selectNo == 0) {
    selectList1s.value[no].name = ''
  } else if (selectNo <4) {
    selectList1s.value[no].name = props.selectOption[selectNo].name
    selectList1s.value[no].image_url = props.selectOption[selectNo].image_url

    form.items[no].nos = selectNo
  } else {
    selectList2s.value[no].name = props.selectOption[selectNo].name
  }
}

const addDiv = () => {
  temp.addDeleteCount++
  addDeletes.value.push({
      id:temp.addDeleteCount
    })

    console.log(temp.addDeleteCount)

}

const deleteDiv = index => {
  addDeletes.value.splice(index, 1)
  console.log(addDeletes.value)
}

const setCustomerId = id => {
  form.customer_id = id
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
                              <div class="w-full flex justify-center">
                                <div v-for="selectList1 in selectList1s" :key="selectList1.no">
                                  <div class="p-2 border">
                                    名前:{{ selectList1.name }}
                                    value={{ form.lists[selectList1.id] }}
                                    name={{ selectList1.id }}
                                    <img v-show="selectList1.image_url !=''" :src="selectList1.image_url">
                                    <select name="customer" @change="changeSelectOption(selectList1.id, $event)"
                                    v-model="form.lists[selectList1.id]"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option value='0' selected>
                                        選択してください
                                      </option>
                                      <option v-for="Option in selectOption" :value="Option.no" :key="Option.no">
                                        {{ Option.name }}
                                      </option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="w-full flex justify-center">
                                <div v-for="selectList2 in selectList2s" :key="selectList2.no">
                                  <div class="p-2 border">
                                    名前:{{ selectList2.name }}
                                    <img v-show="selectList2.image_url !=''" :src="selectList2.image_url">
                                    <select name="customer" @change="changeSelectOption(selectList2.id, $event)"
                                    class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <option value='0' selected>
                                        選択してください
                                      </option>
                                      <option v-for="Option in selectOption" :value="Option.no" :key="Option.no">
                                        {{ Option.name }}
                                      </option>
                                    </select>
                                  </div>
                                </div>
                              </div>

                              <div class="w-full flex justify-center">
                                <div v-for="(addDelete, index) in addDeletes" :key="index">
                                  <div class="p-2 border">
                                    index:{{ index }}
                                    ID:{{ addDelete.id }}
                                  </div>
                                  <button @click="deleteDiv(index)">削除する</button>
                                </div>
                              </div>
                              <button @click="addDiv">追加する</button>

                              <div class="flex flex-wrap -m-2">
                                <div class="p-2 w-full">
                                  <div class="relative">
                                    <label for="date" class="leading-7 text-sm text-gray-600">日付</label>
                                    <input type="date" id="date" name="date" v-model="form.date" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                    <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <div class="relative">

                                    <label for="customer" class="leading-7 text-sm text-gray-600">会員名{{form.customer_id}}</label>
                                    <!-- <select type="date" name="customer" v-model="form.customer_id" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                      <option v-for="customer in customers" :value="customer.id" :key="customer.id">
                                      {{ customer.id }} : {{ customer.name }}
                                      </option>
                                    </select> -->
                                    <!-- <InputError class="mt-2" :message="form.errors.name" /> -->
                                    <MicroModal @update:customerId="setCustomerId"/>
                                  </div>
                                </div>
                                <div class="w-full mx-auto overflow-auto mt-4">
                              <table class="table-auto w-full text-left whitespace-no-wrap">
                                <thead>
                                  <tr>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100 rounded-tl rounded-bl">Id</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">商品名</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">金額</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">数量</th>
                                    <th class="px-4 py-3 title-font tracking-wider font-medium text-gray-900 text-sm bg-gray-100">小計</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <tr v-for="item in itemList" :key="item.id">
                                    <td class="px-4 py-3">{{ item.id }}</td>
                                    <td class="px-4 py-3">{{ item.name }}</td>
                                    <td class="px-4 py-3">{{ item.price }}</td>
                                    <td class="px-4 py-3">
                                      <select name="quantity" v-model="item.quantity">
                                      <option v-for="q in quantity" :value="q">{{ q }}</option>
                                      </select>
                                    </td>
                                    <td class="px-4 py-3">{{ item.price * item.quantity }}
                                    </td>
                                  </tr>
                                </tbody>
                              </table>
                            </div>
                                <div class="p-2 w-full">
                                  <div>
                                    <label for="price" class="leading-7 text-sm text-gray-600">合計金額</label>
                                    <div type="number" id="price" name="price" class="w-full bg-gray-100 bg-opacity-50 rounded border border-gray-300 focus:border-indigo-500 focus:bg-white focus:ring-2 focus:ring-indigo-200 text-base outline-none text-gray-700 py-1 px-3 leading-8 transition-colors duration-200 ease-in-out">
                                      {{ totalPrice }}円</div>
                                  </div>
                                </div>
                                <div class="p-2 w-full">
                                  <button class="flex mx-auto text-white bg-indigo-500 border-0 py-2 px-8 focus:outline-none hover:bg-indigo-600 rounded text-lg">
                                    登録する
                                  </button>
                                </div>
                              </div>
                            </div>
                          </div>
                        </form>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
