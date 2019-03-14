var app = new Vue({
        el: '#gauge',
        data: {
            // showModal: false,
            
            coin: "100000",
            
            user_id: "",
            coin_done: "",
            post_id: "",
            comment: '',
            
            progress_done1:    "",
            denominator_done1: "",
            ttl_done1:         "",
            level_done1:       "",
            
            progress_done2:    "",
            denominator_done2: "",
            ttl_done2:         "",
            level_done2:       "",
            
            progress_done3:    "",
            denominator_done3: "",
            ttl_done3:         "",
            level_done3:       "",
            
            coins:         [],
            act_titles:    [],
            appeals:       [],
            nextactions:   [],
            frees:         [],
            activity_imgs: [],
            
            
            subject_name: "",
            
            activity_at:  "",
            act_title:    "",
            appeal:       "",
            nextaction:   "",
            free:         "",
            activity_img: "",
            subjects: [
                {
                    title:"SWIM",
                    progress: 0,
                    denominator: 2,
                    ttl: 0,
                    level: 1,
                },
                {
                    title:"BIKE",
                    progress: 0,
                    denominator: 2,
                    ttl: 0,
                    level: 1,
                },
                {
                    title:"RUN",
                    progress: 0,
                    denominator: 2,
                    ttl: 0,
                    level: 1,
                }
            ]
        },
        
        mounted() {
            this.getCoins();
        },
        
        methods: {
            getCoins() {
                const url = '/ajax/gauge';
                axios.get(url)
                    .then((response) => {
                        
                        activity_at:  response.date;
                        act_title:    response.data;
                        appeal:       response.data;
                        nextaction:   response.data;
                        free:         response.data;
                        activity_img: response.data;
                    });
            },
            
            start() {
                const coinDone = window.sessionStorage.getItem("coin_done");
                this.coin      = Number(coinDone);
                
                // SWIM ------------------------------------------------------------------------------------------
                const targetSubject1 = this.subjects.find(el => el.title === "SWIM");
                // progress----------------------------------
                const progressDone1     = window.sessionStorage.getItem("progress_done1");
                targetSubject1.progress = progressDone1;
                // ttl---------------------------------------
                const ttlDone1     = window.sessionStorage.getItem("ttl_done1");
                targetSubject1.ttl = ttlDone1;
                
                
                // denominator-------------------------------
                const denominatorDone1 = window.sessionStorage.getItem("denominator_done1");
                
                if (denominatorDone1) {
                    const targetSubject1 = this.subjects.find(el => el.title === "SWIM");
                    targetSubject1.denominator = denominatorDone1;
                } else {
                    const targetSubject1 = this.subjects.find(el => el.title === "SWIM");
                    const denominatorDone01    = Number(denominatorDone1) + 2;
                    targetSubject1.denominator = denominatorDone01;
                }
                // level--------------------------------------
                const levelDone1 = window.sessionStorage.getItem("level_done1");
                
                if (levelDone1) {
                    const targetSubject1 = this.subjects.find(el => el.title === "SWIM");
                    targetSubject1.level = levelDone1;
                } else {
                    const targetSubject1 = this.subjects.find(el => el.title === "SWIM");
                    const levelDone01    = Number(levelDone1) + 1;
                    targetSubject1.level = levelDone01;
                }
                
                // BIKE ------------------------------------------------------------------------------------------
                const targetSubject2 = this.subjects.find(el => el.title === "BIKE");
                // progress----------------------------------
                const progressDone2     = window.sessionStorage.getItem("progress_done2");
                targetSubject2.progress = progressDone2;
                // ttl---------------------------------------
                const ttlDone2     = window.sessionStorage.getItem("ttl_done2");
                targetSubject2.ttl = ttlDone2;
                // denominator-------------------------------
                const denominatorDone2 = window.sessionStorage.getItem("denominator_done2");
                
                if (denominatorDone2) {
                    const targetSubject2 = this.subjects.find(el => el.title === "BIKE");
                    targetSubject2.denominator = denominatorDone2;
                } else {
                    const targetSubject2 = this.subjects.find(el => el.title === "BIKE");
                    const denominatorDone02    = Number(denominatorDone2) + 2;
                    targetSubject2.denominator = denominatorDone02;
                }
                // level--------------------------------------
                const levelDone2 = window.sessionStorage.getItem("level_done2");
                
                if (levelDone2) {
                    const targetSubject2 = this.subjects.find(el => el.title === "BIKE");
                    targetSubject2.level = levelDone2;
                } else {
                    const targetSubject2 = this.subjects.find(el => el.title === "BIKE");
                    const levelDone02    = Number(levelDone2) + 1;
                    targetSubject2.level = levelDone02;
                }
                
                // RUN ------------------------------------------------------------------------------------------
                const targetSubject3 = this.subjects.find(el => el.title === "RUN");
                // progress----------------------------------
                const progressDone3     = window.sessionStorage.getItem("progress_done3");
                targetSubject3.progress = progressDone3;
                // ttl---------------------------------------
                const ttlDone3     = window.sessionStorage.getItem("ttl_done3");
                targetSubject3.ttl = ttlDone3;
                // denominator-------------------------------
                const denominatorDone3 = window.sessionStorage.getItem("denominator_done3");
                
                if (denominatorDone3) {
                    const targetSubject3 = this.subjects.find(el => el.title === "RUN");
                    targetSubject3.denominator = denominatorDone3;
                } else {
                    const targetSubject3 = this.subjects.find(el => el.title === "RUN");
                    const denominatorDone03    = Number(denominatorDone3) + 2;
                    targetSubject3.denominator = denominatorDone03;
                }
                // level--------------------------------------
                const levelDone3 = window.sessionStorage.getItem("level_done3");
                
                if (levelDone3) {
                    const targetSubject3 = this.subjects.find(el => el.title === "RUN");
                    targetSubject3.level = levelDone3;
                } else {
                    const targetSubject3 = this.subjects.find(el => el.title === "RUN");
                    const levelDone03    = Number(levelDone3) + 1;
                    targetSubject3.level = levelDone03;
                }
        
        
                const targetSubject = this.subjects.find(el => el.title === this.subject_name);
                
                targetSubject.progress ++;
                targetSubject.ttl ++;
                this.coin += 100;
                
                if(targetSubject.denominator == targetSubject.progress) {
                    this.coin += 500;
                    targetSubject.denominator++ ;
                    targetSubject.level++;
                    targetSubject.progress = 0;
                }
                const userId = window.sessionStorage.getItem("user_id");
                this.users_id = userId;
                const url = '/ajax/gauge';
                const params = {
                    
                    coin:      this.coin,
                    users_id:  this.users_id,
                    
                    progress:    targetSubject.progress,
                    ttl:         targetSubject.ttl,
                    level:       targetSubject.level,
                    language:    this.subject_name,
                    denominator: targetSubject.denominator,
                    
                    activity_at:  this.activity_at,
                    act_title:    this.act_title,
                    appeal:       this.appeal,
                    nextaction:   this.nextaction,
                    free:         this.free,
                    activity_img: this.activity_img
                    
                };
                
                axios.post(url, params)
                    .then((response) => {
                    
                    this.activity_at  = "";
                    this.act_title    = "";
                    this.subject_name = "";
                    this.appeal       = "";
                    this.nextaction   = "";
                    this.free         = "";
                    this.activity_img = "";
                    
                    console.log(response);
                    
                    if (response.status == 200) {
                        
                    }
                    
                    });
            },
            
            discussion() {
                const userId = window.sessionStorage.getItem("user_id");
                this.users_id = userId;
                
                const postId = window.sessionStorage.getItem("post_id");
                this.posts_id = postId;
                
                
                const url = '/discussion';
                const params = {
                    
                    users_id:  this.users_id,
                    posts_id:  this.posts_id,
                    comment:   this.comment,
                    
                };
                
                axios.post(url, params)
                    .then((response) => {
                    
                    this.comment = '';
                    
                    });
                
            }
        }
    })