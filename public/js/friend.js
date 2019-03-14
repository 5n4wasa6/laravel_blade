var app = new Vue({
        el: '#apply',
        data: {

            user_id: "",
            to_who: "",
            
            state: ""
            
        },
        
        methods: {
            remove() {
                alert("フォローを解除しますか？");
                
                const url = '/delete';
                const params = {
                    
                };
                
                axios.post(url, params)
                    .then((response) => {
                        
                    });
            },
            
            friend() {
                const userId = window.sessionStorage.getItem("user_id");
                this.users_id = userId;
                
                const toWho = window.sessionStorage.getItem("to_who");
                this.to_whos = toWho;
                
                this.status = 1;
                
                
                const url = '/apply';
                const params = {
                    
                    users_id: this.users_id,
                    to_whos:  this.to_whos,
                    status:   this.status
                };
                
                const friend = axios.post(url, params);
                console.log(friend);
               
            }
        }
    })