<template>
  <div ref="messageList" class="flex flex-col">
    <div class="flex-1 p-4">
      <div v-for="message in messages" :key="message.id" class="flex my-2 w-full">
        <div
          :class="['px-4 py-2 rounded-lg w-fit ', message.user_id === this.user.id ? 'ml-auto bg-blue-500 text-white' : 'mr-auto bg-gray-300']">
          <div class="w-full">
            <strong>
              {{ message.user.name }}
            </strong>
          </div>
          {{ message.message }}
        </div>
      </div>
    </div>
  </div>
</template>
<script>
export default {
  props: ["user"],
  data() {
    return {
      messages: [],
    }
  },
  created() {
    this.fetchMessages();

  },
  methods: {
    async fetchMessages() {
      let owner_id = window.location.href.split('/')[4];
      let user_id = window.location.href.split('/')[5];
      const { data } = await axios.get(`/messages/${owner_id}/${user_id}`);
      this.messages = data.messages;

      let conversation_id = data.id;
      await window.Echo.private(`chat.${conversation_id}`)
        .listen('MessageSent', (e) => {
          this.messages.push({
            user_id: e.message.user_id,
            message: e.message.message,
            user: e.user
          });
        });
    }
  },
};
</script>



