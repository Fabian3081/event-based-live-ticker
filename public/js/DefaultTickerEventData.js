class DefaultTickerEventData {
    constructor(heading, content, badgeText, badgeColor, icon) {
        this.heading = heading;
        this.content = content;
        this.badge = {
            "text": badgeText,
            "color": badgeColor
        };
        this.icon = icon;
    }
}