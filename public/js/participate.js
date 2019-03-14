var app = new Vue({
        el: '#go',
        data: {
            go_cnt: 0,
            undecided_cnt: 0,
            ungo_cnt: 0,
            // _token: token
        },
    
        methods: {
            // 参加ボタン押下------------------------------
             go() {
                this.go_cnt++;
                
                const userId = window.sessionStorage.getItem("user_id");
                this.users_id = userId;
                
                const eventId = window.sessionStorage.getItem("event_id");
                this.events_id = eventId;
                
                const url = '/ajax/goes';
                const params = {
                    go_cnt:        this.go_cnt,
                    undecided_cnt: this.undecided_cnt,
                    ungo_cnt:      this.ungo_cnt,
                    
                    users_id:  this.users_id,
                    events_id: this.events_id
                };
                
                axios.post(url, params)
                    .then((response) => {
                    });
            },
            // 未定ボタン押下------------------------------
            undecided() {
                this.undecided_cnt++;
                
                const userId = window.sessionStorage.getItem("user_id");
                this.users_id = userId;
                
                const eventId = window.sessionStorage.getItem("event_id");
                this.events_id = eventId;
                
                const url = '/ajax/goes';
                const params = {
                    go_cnt:        this.go_cnt,
                    undecided_cnt: this.undecided_cnt,
                    ungo_cnt:      this.ungo_cnt,
                    
                    users_id:  this.users_id,
                    events_id: this.events_id
                };
                
                axios.post(url, params)
                    .then((response) => {
                    });
            },
            // 不参加ボタン押下----------------------------
            ungo() {
                this.ungo_cnt++;
                
                const userId = window.sessionStorage.getItem("user_id");
                this.users_id = userId;
                
                const eventId = window.sessionStorage.getItem("event_id");
                this.events_id = eventId;
                
                const url = '/ajax/goes';
                const params = {
                    go_cnt:        this.go_cnt,
                    undecided_cnt: this.undecided_cnt,
                    ungo_cnt:      this.ungo_cnt,
                    
                    users_id:  this.users_id,
                    events_id: this.events_id
                };
                
                axios.post(url, params)
                    .then((response) => {
                    });
            }
            
        }
    })