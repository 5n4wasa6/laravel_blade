

new Vue({
    el: '#clubchat',
    data: {
        body2: '',
        user_id: "",
        post_id: "",
        club_id: "",
    },
    
    methods: {
        
        discussion() {
                const userId = window.sessionStorage.getItem("user_id");
                this.users_id = userId;
                
                console.log(this.users_id);
                
                const postId = window.sessionStorage.getItem("post_id");
                this.posts_id = postId;
                
                console.log(this.posts_id);
                
                const clubId = window.sessionStorage.getItem("club_id");
                this.clubs_id = clubId;
                
                console.log(this.clubs_id);
                
                const url = '/club/chat';
                const params = {
                    
                    users_id:  this.users_id,
                    posts_id:  this.posts_id,
                    clubs_id:  this.clubs_id,
                    body2:     this.body2
                    
                };
                
                axios.post(url, params)
                    .then((response) => {
                    
                    this.body2 = '';
                    
                    });
                
            }
    }
});