<template>
    <AppLayout title="Users">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Users
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="divide-y">
                        <div v-for="user in users" :key="user.id" class="px-4 py-2">
                            <p class="inline-block py-2 pr-4">{{ user.name }}</p>
                            <button :class="{ 'rounded px-4 py-2 font-bold text-white bg-blue-500 hover:bg-blue-700 focus:outline-none focus:shadow-outline': !following(user.id), 'rounded px-4 py-2 font-bold text-white bg-red-500 hover:bg-red-700 focus:outline-none focus:shadow-outline': following(user.id) }" @click="follow(user.id)">
                                {{ following(user.id) ? 'Unfollow' : 'Follow' }}
                            </button>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </AppLayout>

</template>

<script>
import { Inertia } from '@inertiajs/inertia';
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {AppLayout},
    props: {
        users: {
            type: Array,
            required: true
        }
    },
    methods: {
        following(id) {
            return this.users.find(user => user.id === id).following;
        },
        follow(id) {
            Inertia.post('follow/' + id);
        }
    }
}
</script>
