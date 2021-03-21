class EventMapper {
    getMappedEvent(event) {
        let newEventData;

        if (event.tickerEventType === "DefaultTickerEvent") {
            newEventData = new DefaultTickerEventData(
                event.tickerEventData.heading,
                event.tickerEventData.content,
                event.tickerEventData.badge.text,
                event.tickerEventData.badge.color,
                event.tickerEventData.icon
            );
        }

        return new TickerEvent(
            event.tickerEventID,
            event.tickerEventType,
            newEventData
        );
    }
}