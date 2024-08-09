<template>
    <div>
        Chat Layouts
        <pre> {{  onlineUserObj }}</pre>
    </div>
</template>

<script setup lang='ts'>
import { User } from '@/types';
import { ref, onMounted, onBeforeUnmount } from 'vue';

// Données partagées


// Données réactives de gestion des conversations


// Utilisateurs connectés
const onlineUserObj = ref<Record<string, User>>({});

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
        console.error('error',error)
    })
}


/** Hook pour la connection au canal */
onMounted(() => {
    setupchannel();
})

/** Hook pour le composant avant le démontage */
onBeforeUnmount(() => {
    window.Echo.leave('online');
})
</script>

<style scoped></style>