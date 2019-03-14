

new Vue({
    el: '#chat',
    data: {
        message: '',
        messages: []
    },
    
    mounted() {
        this.getMessages();
    },
    
    methods: {
        getMessages() {
            const url = '/ajax/chat';
            axios.get(url)
                .then((response) => {
                    this.messages = response.data;
                });
        },
        
        send() {
            const url = '/ajax/chat';
            const params = { message: this.message };
            axios.post(url, params)
            .then((response) => {
                // 成功したらメッセージをクリア
                this.message = '';
            });
        }
    }
});