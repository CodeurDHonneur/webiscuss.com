<template>
    <div>
        <ul>
        <li>{{ conversation.name }}</li>
        </ul>
    </div>
</template>

<script setup lang='ts'>
import { Conversation } from '@/types';

const props = defineProps<{
    conversation: Conversation
}>();
</script>

<style scoped></style>