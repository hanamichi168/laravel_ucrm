<script setup>
import { Inertia } from '@inertiajs/inertia';

defineProps({
    id:String,
    blog: Object
})

const deleteComform = (id) =>{
    console.log(id)
    Inertia.delete(`/inertia/${id}`, {
    onBefore: () => confirm('本当に削除しますか？')
    })
}
</script>

<template>
    {{id}}
    {{blog.id}}
    <button @click="deleteComform(blog.id)">削除</button>
</template>
