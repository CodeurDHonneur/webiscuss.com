<template>
    <div>
        <Menu as="div" class="relative inline-block text-left ">
            <MenuButton class="inline-flex w-full justify-center rounded-md ">
                <span class="sr-only">Ouvrir le menu contextuel</span>
                <Icon icon="heroicons:ellipsis-vertical-solid" class="w-6 h-6" />
            </MenuButton>
            <Transition
            enter-active-class="transition duration-100 ease-out"
            enter-from-class="transform scale-95 opacity-0"
            enter-to-class="transform scale-100 opacity-100"
            leave-active-class="transition duration-75 ease-out"
            leave-from-class="transform scale-100 opacity-100"
            leave-to-class="transform scale-95 opacity-0">

            <MenuItems as="ul" class="absolute right-0 mt-2 w-56 origin-top-right divide-y bg-surface-variant">
                <MenuItem as="li" v-slot="{ active}" class="p-1">
                    <button>
                        <span @click="blockUser()" v-if="!conversation.blocked_at" class="flex p-2 text-sm items-center gap-2">
                            <Icon icon=""/>
                            Bloquer l'utilisateur</span>
                        <span @click="unblockUser()" v-else class="flex p-2 text-sm items-center gap-2">
                            <Icon icon=""/>
                            Débloquer l'utilisateur</span>
                    </button>
                </MenuItem>
                <MenuItem 
                as="li" 
                v-slot="{ active}" 
                class="p-1"
                v-if="currentUser.is_admin">
                    <button>
                        <span v-if="conversation.is_admin" class="flex p-2 text-sm items-center gap-2">
                            <Icon icon=""/>
                            Retrograder en utilisateur</span>
                        <span v-else class="flex p-2 text-sm items-center gap-2">
                            <Icon icon="heroicons:shiel-check-solid"/>
                            Promouvoir en admin</span>
                    </button>
                </MenuItem>
            </MenuItems>
            </Transition>
        </Menu>
       
    </div>
</template>

<script setup lang='ts'>
import { Icon } from '@iconify/vue/dist/iconify.js';
import { Menu, MenuButton, MenuItem, MenuItems} from '@headlessui/vue'
import { Conversation } from '@/types';
import { usePage } from '@inertiajs/vue3';

const page = usePage();
const currentUser = page.props.auth.user;
const props = defineProps<{
    conversation: Conversation
}>();

async function blockUser(){
    // si c'est un groupe, on ne fait rien 
    if(props.conversation.is_group) return;

    const res = await window.axios.post(route('user.block', props.conversation.id));
    console.log(res);
}

async function unblockUser(){
    const res = await window.axios.post(route('user.unblock', props.conversation.id));
    console.log(res);
}
</script>

<style scoped></style>