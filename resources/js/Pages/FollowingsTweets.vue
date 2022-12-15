<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <ul class="divide-x text-gray-400">
                        <li v-for="tweet in tweets" :key="tweet.id">
                            <p>{{ tweet.status }}</p>
                            <p>By {{ tweet.user.name }}</p>
                            <p class="text-gray-400">{{ formatDate(tweet.created_at) }}</p>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </AppLayout>
</template>

<script>
import { usePage } from '@inertiajs/inertia-vue3'
import AppLayout from '@/Layouts/AppLayout.vue';

export default {
    components: {AppLayout},
    data: () => ({
        tweets: []
    }),
    methods: {
        async fetchTweets() {
            // Inertia.get(`/users/followings-tweets`)
            this.tweets = usePage().props.value.tweets
        },
        formatDate(date) {
            const monthNames = [
                "January", "February", "March",
                "April", "May", "June", "July",
                "August", "September", "October",
                "November", "December"
            ];

            const day = date.getDate();
            const monthIndex = date.getMonth();
            const year = date.getFullYear();
            const hours = date.getHours();
            const minutes = date.getMinutes();
            const seconds = date.getSeconds();

            return `${monthNames[monthIndex]} ${day}, ${year} ${hours}:${minutes}:${seconds}`;
        }
    },
    mounted() {
        this.fetchTweets()
    }
}
</script>
