<script >
import AppLayout from '@/Layouts/AppLayout.vue';
import { usePage } from '@inertiajs/inertia-vue3'
import NewTweet from "../Components/NewTweet.vue";

export default {
    components: {AppLayout, NewTweet},
    data: () => ({
        tweets: []
    }),
    methods: {
        async fetchTweets () {
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
    mounted () {
        this.fetchTweets()
    }
}
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">

            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <NewTweet></NewTweet>
                <hr class="my-4 border-gray-300">
                <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                    <div class="py-4">
                        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                            <div class="bg-white overflow-hidden  sm:rounded-lg">
                                <ul class="divide-y">
                                    <li v-for="tweet in tweets" :key="tweet.id" class="py-4">
                                        <div class="flex items-center space-x-4">
                                            <img :src="tweet.user.profile_photo_url" alt="User profile photo" class="h-8 w-8 rounded-full" />
                                            <p>By <b>{{ tweet.user.name }}</b></p>
                                        </div>
                                        <p class="py-2">{{ tweet.status }}</p>
                                        <p class="text-gray-400">{{ formatDate(new Date(tweet.created_at)) }}</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
