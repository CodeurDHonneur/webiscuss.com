<template>
  <div class="flex flex-1 overflow-hidden">
    <!-- Sidebar -->
    <div
      class="transition-all w-full sm:w-[220px] md:w-[320px] bg-accent flex flex-col overflow-hidden"
    >
      <!-- En-tête fixe -->
      <div class="flex flex-col">
        <div class="flex items-center justify-between py-2 px-3 font-medium sticky top-0 z-10">
          Conversations
          <button title="Créer un groupe" class="text-icon cursor-pointer">
            <Icon class="h-5 w-5" icon="heroicons:pencil-square" />
          </button>
        </div>
        <div class="p-3 border-b border-border sticky top-[3rem] z-10">
          <TextInput v-model="search" class="w-full" />
        </div>
      </div>
      <div
        class="flex-1 overflow-y-auto px-3 h-full scrollbar-thumb-slate-700 scrollbar-track-slate-300 scrollbar-thin"
      >
        <ConversationItem
          v-for="conversation in filteredConversations"
          :key="conversation.is_group ? `group_${conversation.id}` : `user_${conversation.id}`"
          :conversation="conversation"
          :isOnline="isUserOnline(conversation.id.toString())"
        />
      </div>
    </div>

    <div class="flex-1">
      Messages users connectés
      {{ onlineUserObj }}
      <!-- Item de conversation pour chaque conversation -->
    </div>
  </div>
</template>

<script setup lang="ts">
import TextInput from '@/Components/TextInput.vue';
import { Conversation, User } from '@/types';
import { usePage } from '@inertiajs/vue3';
import { ref, onMounted, onBeforeUnmount, computed } from 'vue';
import { Icon } from '@iconify/vue';
import ConversationItem from '@/Components/Chat/ConversationItem.vue';

// Données partagées
const page = usePage();

// Données réactives de gestion des conversations
const conversations = ref<Conversation[]>(page.props.conversations);
const localConversations = computed<Conversation[]>(() => conversations.value);
const search = ref<string>('');

const sortedConversations = computed<Conversation[]>(() => {
  return localConversations.value.sort((a, b) => {
    //on recherche les personnes bloquées d'abord
    if (a.blocked_at && b.blocked_at) {
      return a.blocked_at > b.blocked_at ? 1 : -1;
    } else if (a.blocked_at) {
      return 1;
    } else {
      return -1;
    }

    if (a.last_message_date && b.last_message_date) {
      return b.last_message_date.localeCompare(a.last_message_date);
    } else if (a.last_message_date) {
      return -1;
    } else if (a.last_message_date) {
      return 1;
    } else {
      return 0;
    }
  });
});

const filteredConversations = computed<Conversation[]>(() => {
  return sortedConversations.value.filter((conversation) => {
    const searchTerm = search.value.toLowerCase();
    return (
      conversation.name.toLowerCase().includes(searchTerm) ||
      conversation.email?.toLowerCase().includes(searchTerm)
    );
  });
});

// Utilisateurs connectés
const onlineUserObj = ref<Record<string, User>>({});

function isUserOnline(id: string): boolean {
  return onlineUserObj.value[id] ? true : false;
}

/**
 * function pour rejoindre le canal 'online' et récupérer les utilisateurs connectés
 */
function setupchannel() {
  window.Echo.join('online')
    .here((users: User[]) => {
      const usersObj = Object.fromEntries(users.map((user) => [user.id, user]));
      onlineUserObj.value = usersObj;
    })
    .joining((user: User) => {
      onlineUserObj.value[user.id] = user;
    })
    .leaving((user: User) => {
      delete onlineUserObj.value[user.id];
    })
    .error((error: any) => {
      console.error('error', error);
    });
}

/** Hook pour la connection au canal */
onMounted(() => {
  setupchannel();
});

/** Hook pour le composant avant le démontage */
onBeforeUnmount(() => {
  window.Echo.leave('online');
});
</script>

<style scoped></style>
