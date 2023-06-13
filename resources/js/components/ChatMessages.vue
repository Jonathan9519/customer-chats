<template>
  <ul class="chat">
    <li class="left clearfix" v-for="message in messages" :key="message.id">
      <div class="clearfix">
        <div class="header">
          <strong>
            {{ message.user.name }}
          </strong>
        </div>
        <p>
          {{ message.message }}
        </p>
      </div>
    </li>
  </ul>
</template>
<script>
export default {
  data(){
    return {
        messages: []
    }
  },
  created (){
    this.fetchMessages();
  },
  mounted() {
        this.subscribeToChannel();
    },
  methods: {
    fetchMessages() {
            //GET request to the messages route in our Laravel server to fetch all the messages
            let urlSplit =  window.location.href.split('/')[4];
            // let idOwner = urlSplit;
            axios.get(`/messages/${urlSplit}`).then(response => {
                //Save the response in the messages array to display on the chat view
                this.messages = response.data.messages;
            });
        },
  },
  subscribeToChannel() {
            this.channel = this.echo.channel('chat.' + this.post.id);
            this.channel.listen('.message.created', (message) => {
                this.messages.push(message);
            });
        },
};
</script>
