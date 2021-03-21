var app = new Vue({
    el: '#controller',
    data: {
        displayedEvents: 5,
        tickerEvents: []
    },
    methods: {
        showMore(value) {
            let newValue = this.tickerEvents.length;
            if ((value += 5) <= this.tickerEvents.length) {
                newValue = value;
            }
            Vue.set(app, 'displayedEvents', newValue);
        },
        getLabelClassFromColor(color) {
            if (color === "red") {
                return "uk-label-danger";
            } else if (color === "green") {
                return "uk-label-success";
            } else if (color === "orange") {
                return "uk-label-warning";
            }
            return "uk-label-success";
        },
        getEvents(initial) {
            axios
                .get("/getTickerEvents/DefaultTickerEvent/0")
                .then(response => {
                    let events = response.data.reverse();
                    let oldLength = this.tickerEvents.length;
                    let newLength = 0;

                    this.tickerEvents = [];

                    events.forEach((event) => {
                        this.tickerEvents.push(
                            new EventMapper().getMappedEvent(event)
                        );
                        newLength++;
                    });

                    if (!initial) {
                        this.displayedEvents += newLength - oldLength;
                    }
                });
        }
    },
    mounted () {
        this.getEvents(true);

        setInterval(() => {
            this.getEvents(false);
        }, 3000);
    }
});