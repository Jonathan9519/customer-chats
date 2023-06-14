
<template>
  <div class="input-group">
    <input
      id="btn-input"
      type="text"
      name="message"
      class="form-control input-sm"
      placeholder="Type your message here..."
      v-model="newMessage"
      @keyup.enter="sendMessage"
    />
    <span class="input-group-btn">
      <button class="btn btn-primary btn-sm" id="btn-chat" @click="sendMessage">
        Send
      </button>
    </span>
  </div>
</template>

<script>
export default {
  props: ["user"],
  data() {
    return {
      newMessage: "",
    };
  },
  methods: {
    
    sendMessage() {
      this.addMessage(this.newMessage)
      //Clear the input
      this.newMessage = "";
      
    },

    addMessage(message) {
            //Pushes it to the messages array
            let urlSplit =  window.location.href.split('/')[4];
            let objectMessage = {message:message, owner_id: urlSplit}
            //POST request to the messages route with the message data in order for our Laravel server to broadcast it.
            axios.post('/messages', objectMessage).then(response => {
                console.log(response.data);
            });
        }
  },
};
</script>
