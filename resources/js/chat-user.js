/**
 * Echo exposes an expressive API for subscribing to channels and listening
 * for events that are broadcast by Laravel. Echo and event broadcasting
 * allow your team to quickly build robust real-time web applications.
 */

import './echo';


class Chat {
    constructor() {
        this.messagesContainer = document.querySelector('#messages-container');
        this.sendForm = document.querySelector('#send-message');
        this.errorBox = this.sendForm.querySelector('#error');
        this.senderId = window.Laravel.senderId;
        this.receiverId = window.Laravel.receiverId;
        console.log(this.senderId,this.receiverId)
        this.events();
    }

    events(){
        console.log(`chat.${this.senderId}.${this.receiverId}`)
        this.sendForm.addEventListener('submit', this.sendMessage.bind(this));
        window.Echo.private(`chat.${this.senderId}.${this.receiverId}`)
            .listen('MessageSent', (e) => this.pushMessage(e.message));

    }

    async sendMessage(e){
        e.preventDefault()
        this.errorBox.innerHTML = "";

        const formData = new FormData(this.sendForm);
        try {
            const response = await window.axios.post(`/chat/${this.receiverId}/send`, formData);
            const data = await response.data;
            this.pushMessage(data)
            this.sendForm.reset();
        } catch (error) {
            this.errorBox.innerHTML = error.response.data.message;
        }
    }


    pushMessage (message) {
        const isMyMessage = message.is_my_message;

        const messageDiv = document.createElement('div');
        messageDiv.classList.add('flex', isMyMessage ? 'justify-end' : 'justify-start');

        const innerDiv = document.createElement('div');
        innerDiv.classList.add(
            'p-2',
            isMyMessage ? 'bg-blue-600' : 'bg-green-600',
            'text-white',
            'rounded-lg',
            'max-w-xs'
        );
        innerDiv.innerHTML = message.text;
        messageDiv.appendChild(innerDiv);
        this.messagesContainer.appendChild(messageDiv);
        this.messagesContainer.scrollTop = this.messagesContainer.scrollHeight;
    }
}

document.addEventListener('DOMContentLoaded', () => {
    new Chat();
})



