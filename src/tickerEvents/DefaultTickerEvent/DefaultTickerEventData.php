<?php

declare(strict_types=1);

namespace tickerEvents;

use Exception;

class DefaultTickerEventData implements TickerEventData
{
    private ?string $heading;
    private ?string $content;
    private ?string $badgeText;
    private ?string $badgeColor;
    private ?string $icon;

    public function __construct(
        string $heading = null,
        string $content = null,
        string $badgeText = null,
        string $badgeColor = null,
        string $icon = null
    ) {
        $this->heading = $heading;
        $this->content = $content;
        $this->badgeText = $badgeText;
        $this->badgeColor = $badgeColor;
        $this->icon = $icon;
    }

    public function getMappedEventData(): array
    {
        return [
            "heading" => $this->heading,
            "content" => $this->content,
            "badgeText" => $this->badgeText,
            "badgeColor" => $this->badgeColor,
            "icon" => $this->icon
        ];
    }

    /**
     * @param string $json
     * @return DefaultTickerEventData
     * @throws InvalidEventDataException
     */
    public static function fromJSON(string $json): self
    {
        $eventData = json_decode($json, true);

        $requiredKeys = ["heading", "content", "badgeText", "badgeColor", "icon"];

        self::validateEventData($requiredKeys, $eventData);

        return new DefaultTickerEventData(
            $eventData["heading"],
            $eventData["content"],
            $eventData["badgeText"],
            $eventData["badgeColor"],
            $eventData["icon"]
        );
    }

    /**
     * @param array $requiredKeys
     * @param $eventData
     * @throws InvalidEventDataException
     */
    private static function validateEventData(array $requiredKeys, array $eventData)
    {
        foreach ($requiredKeys as $requiredKey) {
            try {
                if (!key_exists($requiredKey, $eventData)) {
                    throw new InvalidEventDataException($requiredKey . " is not set.");
                }
            } catch (Exception $e) {
                throw new InvalidEventDataException("JSON not valid.");
            }
        }
    }

    /**
     * @return string
     */
    public function getHeading(): string
    {
        return $this->heading;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @return string|null
     */
    public function getIcon(): ?string
    {
        return $this->icon;
    }

    /**
     * @return string|null
     */
    public function getBadgeText(): ?string
    {
        return $this->badgeText;
    }

    /**
     * @return string|null
     */
    public function getBadgeColor(): ?string
    {
        return $this->badgeColor;
    }
}
