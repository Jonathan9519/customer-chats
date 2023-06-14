<template>
    <div class="flex flex-col h-screen">
        <div class="flex-1 p-4 overflow-y-auto">
            <div v-for="conversation in conversations" :key="conversation.id"
                @click="selectConversation(conversation)"
                class="flex p-4 cursor-pointer">
                <div class="w-16 h-16 bg-gray-300 rounded-full mr-4"></div>
                <div>
                    <h4 class="text-lg">{{ conversation.sender.name }}</h4>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    props: ['user'],
    data() {
        return {
            conversations: []
        }
    },
    created() {
        this.fetchConvesations();
    },
    methods: {
        fetchConvesations() {
            axios.get(`/convesations`).then(response => {
                this.conversations = response.data;
            });
        },
        selectConversation(conversation) {
            let uid = conversation.sender_id;
            window.location.href = `/chat/${this.user.id}/${uid}`;
        }
    }
}
</script>