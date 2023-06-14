/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

import './bootstrap';
import '../css/app.css'; 
import { createApp } from 'vue';

/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp();

import ExampleComponent from './components/ExampleComponent.vue';
import ChatMessages from './components/ChatMessages.vue';
import ChatForm from './components/ChatForm.vue';
import FeedPosts from './components/FeedPosts.vue';
import Conversations from './components/Conversations.vue';

app.component('example-component', ExampleComponent);

app.component('chat-messages', ChatMessages);
app.component('chat-form', ChatForm);
app.component('posts-feed', FeedPosts);
app.component('conversations', Conversations);

app.mount('#app')
