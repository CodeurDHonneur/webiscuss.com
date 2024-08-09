<template>
  <ChatLayout></ChatLayout>
</template>

<script setup lang="ts">
import ChatLayout from '@/Layouts/ChatLayout.vue';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

defineOptions({ layout: AuthenticatedLayout });
</script>

<style scoped></style>
