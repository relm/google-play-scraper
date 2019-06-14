<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Model;

/**
 * Contains information about application permissions.
 */
class Permission implements \JsonSerializable
{
    use JsonSerializableTrait;

    /** @var string Permission label. */
    private $label;

    /** @var string Permission description. */
    private $description;

    /**
     * Creates an object with information about one of the permissions of the Android application.
     *
     * @param string $label Permission label.
     * @param string $description Permission description.
     */
    public function __construct(string $label, string $description)
    {
        $this->label = $label;
        $this->description = $description;
    }

    /**
     * Returns permission label.
     *
     * @return string Permission label.
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * Returns permission description.
     *
     * @return string Permission description.
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * Returns class properties as an array.
     *
     * @return array Class properties as an array.
     */
    public function asArray(): array
    {
        return [
            'label' => $this->label,
            'description' => $this->description,
        ];
    }
}
