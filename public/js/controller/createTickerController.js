var app = new Vue({
    el: '#controller',
    data: {
        loggedIn: sessionStorage.getItem('loggedIn') ?? false,
        username: sessionStorage.getItem('username') ?? "",
        password: "",
        eventType: "DefaultTickerEvent",
        eventData: new DefaultTickerEventData()
    },
    methods: {
        login() {
            axios
                .post("/isAuthenticated", {
                    username: this.username,
                    password: this.password
                })
                .then(response => {
                    if (response.data.authenticated) {
                        Vue.set(app, 'username', response.data.requestedUsername);
                        Vue.set(app, 'loggedIn', true);

                        sessionStorage.setItem('loggedIn', true);
                        sessionStorage.setItem('username', response.data.requestedUsername);
                    }
                });
        },
        logout() {
            Vue.set(app, 'username', "");
            Vue.set(app, 'loggedIn', false);

            sessionStorage.removeItem('loggedIn');
            sessionStorage.removeItem('username');
        },
        createEvent() {
            console.log({
                tickerEventType: this.eventType,
                tickerEventData: {
                    heading: this.eventData.heading,
                    content: this.eventData.content,
                    badgeText: this.eventData.badgeText,
                    badgeColor: this.eventData.badgeColor,
                    icon: this.eventData.icon
                }});
            axios
                .post("/createTicker", {
                    tickerEventType: this.eventType,
                    tickerEventData: {
                        heading: this.eventData.heading,
                        content: this.eventData.content,
                        badgeText: this.eventData.badgeText,
                        badgeColor: this.eventData.badgeColor,
                        icon: this.eventData.icon
                    }
                })
                .then(response => {

                });
        }
    }
});