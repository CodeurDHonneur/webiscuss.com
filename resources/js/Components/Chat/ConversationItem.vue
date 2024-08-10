<template>
   <Link href="#">
        <div class="1">
            <h3 class="text-sm text-nowrap text-ellipsis">{{ conversation.name }}</h3>
            <span class="text-nowrap">
                {{ conversation.last_message_date }}
            </span>
            <p class="text-xs truncate">{{ conversation.last_message }}</p>
        </div>
   </Link>
</template>

<script setup lang='ts'>
import { Conversation } from '@/types';
import { Link } from '@inertiajs/vue3';


const props = defineProps<{
    conversation: Conversation
}>();
</script>

<style scoped></style>