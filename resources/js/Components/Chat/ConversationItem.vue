<template>
  <div class="flex max-w-full">
    <Link
      :href="
        conversation.is_user
          ? route('chat.user', conversation.id)
          : route('chat.group', conversation.id)
      "
      class="w-full inline-flex items-center gap-2 p-2 hover:bg-slate-400/30 transition-all"
    >
      <!-- Affichage de profil pour les users simples -->
      <UserAvatar
        :avatar="conversation.avatar"
        :name="conversation.name"
        v-if="conversation.is_user"
        :isOnline="isOnline"
      />
      <!-- Affichage de profil pour les groupes -->
      <GroupAvatar v-if="conversation.is_group" />
      <div class="flex-1 maw-w-full overflow-hidden text-xs">
        <div class="flex gap-1 justify-between items-center">
          <h3 class="font-semibold text-sm text-nowrap text-ellipsis truncate">
            {{ conversation.name }}
          </h3>
          <span v-if="conversation.last_message_date" class="text-nowrap italic">
            {{ conversation.last_message_date }}
          </span>
        </div>
        <p
          v-if="conversation.last_message"
          class="text-xs text-nowrap overflow-hidden text-ellipsis truncate"
        >
          {{ conversation.last_message }}
        </p>
      </div>
      <UserOptionsDropdown :conversation="conversation" class="inline-block cursor-pointer" />
    </Link>
  </div>
</template>

<script setup lang="ts">
import { Conversation } from '@/types';
import { Link, usePage } from '@inertiajs/vue3';
import UserAvatar from './UserAvatar.vue';
import GroupAvatar from './GroupAvatar.vue';
import UserOptionsDropdown from './UserOptionsDropdown.vue';

const page = usePage();

const props = defineProps<{
  conversation: Conversation;
  isOnline: boolean;
}>();

const currentUser = page.props.auth.user;
</script>

<style scoped></style>
