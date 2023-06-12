<template>
    <div>
        <h1 class="text-2xl font-bold mb-4">Feed de publicaciones</h1>
        <div v-for="post in posts" :key="post.id" class="border p-4 mb-4">
            <h2 class="text-lg font-semibold">{{ post.title }}</h2>
            <p class="mb-2">{{ post.content }}</p>
            <button @click="openChat(post)"
                class="bg-blue-500 bg-indigo-500 text-black font-bold py-2 px-4 rounded">
                Chat
            </button>
        </div>
    </div>
</template>

<script>
export default {
    name: 'FeedPublicaciones',
    data() {
        return {
            posts: [
                {
                    id: 1,
                    title: 'Publicación 1',
                    content: 'Contenido de la publicación 1',
                    owner_id: 'Usuario1'
                },
                {
                    id: 2,
                    title: 'Publicación 2',
                    content: 'Contenido de la publicación 2',
                    owner_id: 'Usuario2'
                },
                {
                    id: 3,
                    title: 'Publicación 3',
                    content: 'Contenido de la publicación 3',
                    owner_id: 'Usuario3'
                }
            ]
        };
    },
    methods: {
    openChat(user) {
      // Lógica para abrir una conversación con el usuario
      let uid = user.owner_id;
      window.location.href = `/chat/${uid}`;
      console.log('Abrir chat con:', user);
    }
  }
}
</script>