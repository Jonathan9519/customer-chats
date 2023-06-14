<template>
  <div class="flex-col w-full">
    <div class="p-4">
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
      messages: []
    }
  },
  created() {
    this.fetchMessages();
  },
  methods: {
    fetchMessages() {
      let owner_id = window.location.href.split('/')[4];
      let user_id = window.location.href.split('/')[5];
      axios.get(`/messages/${owner_id}/${user_id}`).then(response => {
        this.messages = response.data.messages;
      });
      window.Echo.private(`chat.${owner_id}.${user_id}`)
      .listen('MessageSent', (e) => {
        console.log('event-> ', e);
        this.messages.push({
          user_id: e.message.user_id,
          message: e.message.message,
          user: e.user
        });
      });
    },
  },
};
</script>



