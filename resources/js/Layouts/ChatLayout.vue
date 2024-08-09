<template>
    <div>
        Chat Layouts
    
    </div>
</template>

<script setup lang='ts'>
import { User } from '@/types';
import { onMounted } from 'vue';




onMounted(() => {
    window.Echo.join('online')
    .here((users: User[]) => {
        console.log('here', users)
    })
    .joining((user: User) => {
        console.log('joining',user)
    })
    .leaving((user: User) => {
        console.log('leaving',user)
    })
    .error((error: any) => {
        console.error('error',error)
    })
})

</script>

<style scoped></style>