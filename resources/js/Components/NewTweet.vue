<template>
    <form @submit.prevent="submitForm" class="flex flex-col justify-center">
        <textarea
            class="rounded-lg p-2 w-full border-gray-300"
            placeholder="What's on your mind?"
            placeholder-color="gray"
            v-model="text"
        ></textarea>
        <button type="submit" class="mt-4 bg-blue-500 rounded-lg p-2 hover:bg-blue-600 transition duration-150 text-white font-bold">
            Send
        </button>
    </form>
</template>

<script>
export default {
    data: () => ({
        text: ''
    }),
    methods: {
        submitForm () {
            this.$inertia.post('/tweets', {
                status: this.text
            })
            this.text = ''

        }
    }
}
</script>
