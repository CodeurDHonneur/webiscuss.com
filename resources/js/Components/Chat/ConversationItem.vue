<template>
  <Link href="#" class="flex items-center gap-2 p-2">
    <!-- Affichage de profil pour les users simples -->
     <UserAvatar :avatar="conversation.avatar" :name="conversation.name" v-if="conversation.is_user"/>

     <!-- Affichage de profil pour les groupes -->
    <GroupAvatar v-if="conversation.is_group"/>


    <div class="flex-1 maw-w-full overflow-hidden text-xs">
      <div class="flex gap-1 justify-between items-center">
        <h3 class="font-semibold text-sm text-nowrap text-ellipsis truncate">{{ conversation.name }}</h3>
        <span class="text-nowrap">
          {{ conversation.last_message_date }}
        </span>
      </div>
      <p v-if="conversation.last_message" class="text-xs truncate">
        {{ conversation.last_message }}
      </p>
    </div>
  </Link>
</template>

<script setup lang='ts'>
import { Conversation } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import UserAvatar from './UserAvatar.vue';
import GroupAvatar from './GroupAvatar.vue';

const page = usePage();

const props = defineProps<{
  conversation: Conversation;
}>();

const currentUser = page.props.auth.user;
</script>

<style scoped></style>