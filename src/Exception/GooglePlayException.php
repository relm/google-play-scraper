<?php
declare(strict_types=1);

/**
 * @author   Ne-Lexa
 * @license  MIT
 * @link     https://github.com/Ne-Lexa/google-play-scraper
 */

namespace Nelexa\GPlay\Exception;

use GuzzleHttp\Exception\RequestException;
use Psr\Http\Message\ResponseInterface;

/**
 * Exception thrown if there is an error accessing the Google Play server.
 */
class GooglePlayException extends \Exception
{
    /** @var string|null URL associated with the exception. */
    private $url;

    /**
     * Construct the GooglePlayException.
     *
     * @param string $message The Exception message to throw.
     * @param int $code The Exception code.
     * @param \Throwable $previous The previous throwable used for the exception chaining.
     */
    public function __construct($message = '', $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
        if (($previous instanceof RequestException) && $previous->getRequest() !== null) {
            $this->url = $previous->getRequest()->getUri()->__toString();
        }
    }

    /**
     * Set the URL associated with the exception.
     *
     * @param string $url URL associated with the exception.
     *
     * @return GooglePlayException Returns the same object to support the call chain.
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;
        return $this;
    }

    /**
     * Returns the URL with which the exception is associated.
     *
     * URL maybe `null`.
     *
     * @return string|null URL associated with the exception or `null`.
     */
    public function getUrl(): ?string
    {
        return $this->url;
    }

    /**
     * Returns an HTTP response if present.
     *
     * @return ResponseInterface|null PSR-7 ResponseInterface or null.
     *
     * @see https://www.php-fig.org/psr/psr-7/ PSR-7: HTTP message interfaces
     */
    public function getResponse(): ?ResponseInterface
    {
        $e = $this->getPrevious();
        if ($e instanceof RequestException && $e->getResponse() !== null) {
            return $e->getResponse();
        }
        return null;
    }
}
