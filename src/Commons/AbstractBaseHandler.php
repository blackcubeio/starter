<?php

declare(strict_types=1);

/**
 * AbstractBaseAction.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Commons;

use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\DataResponse\ResponseFactory\JsonResponseFactory;
use Yiisoft\Http\Header;
use Yiisoft\Http\Method;
use Yiisoft\Http\Status;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

/**
 * Abstract base action providing common utilities for all actions.
 * Handles view rendering, JSON responses, redirects, and debug mode.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
abstract class AbstractBaseHandler
{
    protected string $viewsAlias = '@src/Views';
    protected bool $debug = false;
    protected ServerRequestInterface $request;

    /**
     * @param WebViewRenderer $viewRenderer The view renderer
     * @param ResponseFactoryInterface $responseFactory The response factory
     * @param JsonResponseFactory $jsonResponseFactory The JSON response factory
     * @param UrlGeneratorInterface $urlGenerator The URL generator
     * @param Aliases $aliases The aliases service
     * @param array<string, mixed> $params Application parameters
     */
    public function __construct(
        protected WebViewRenderer $viewRenderer,
        protected ResponseFactoryInterface $responseFactory,
        protected JsonResponseFactory $jsonResponseFactory,
        protected UrlGeneratorInterface $urlGenerator,
        protected Aliases $aliases,
        protected LocaleProvider $localeProvider,
        protected LoggerInterface $logger,
        array $params = [],
    ) {
    }

    /**
     * Returns the parsed body parameters.
     * Returns null for GET requests.
     *
     * @return array<string, mixed>|null
     */
    protected function getBodyParams(): ?array
    {
        $params = null;
        if ($this->request->getMethod() !== Method::GET) {
            $params = $this->request->getParsedBody();
        }
        return $params;
    }

    protected function render(string $view, array $parameters = []): ResponseInterface
    {
        $viewPath = $this->aliases->get($this->viewsAlias);
        $layoutPath = $viewPath.'/Layouts/main.php';
        if (str_starts_with($view, '@') === true) {
            $view = $this->aliases->get($view);
        }
        return $this->viewRenderer
            ->withViewPath($viewPath)
            ->withLayout($layoutPath)
            ->render($view, $parameters)
            ->withStatus(Status::OK);
    }

    protected function renderPartial(string $view, array $parameters = []): ResponseInterface
    {
        $viewPath = $this->aliases->get($this->viewsAlias);
        if (str_starts_with($view, '@') === true) {
            $view = $this->aliases->get($view);
        }
        return $this->viewRenderer
            ->withViewPath($viewPath)
            ->withLayout(null)
            ->render($view, $parameters)
            ->withStatus(Status::OK);
    }

    protected function renderJson(array $data): ResponseInterface
    {
        return $this->jsonResponseFactory->createResponse($data);
    }

    protected function redirect(string $routeName, array $parameters = []): ResponseInterface
    {
        $url = $this->urlGenerator->generate($routeName, $parameters);
        return $this->responseFactory
            ->createResponse(Status::FOUND)
            ->withHeader(Header::LOCATION, $url);
    }

    protected function isAjax(): bool
    {
        return $this->request->getHeaderLine('X-Requested-With') === 'XMLHttpRequest';
    }

    protected function isAjaxify(): bool
    {
        return $this->request->getHeaderLine('X-Requested-For') === 'Ajaxify';
    }

    /**
     * Returns a response with downloadable content.
     *
     * @param string $content The content to download
     * @param string $filename The filename for the download
     * @param array{mimeType?: string} $options Download options
     * @return ResponseInterface
     */
    protected function downloadContent(string $content, string $filename, array $options = []): ResponseInterface
    {
        $mimeType = $options['mimeType'] ?? 'application/octet-stream';

        $response = $this->responseFactory->createResponse();
        $response->getBody()->write($content);

        return $response
            ->withHeader(Header::CONTENT_TYPE, $mimeType)
            ->withHeader(Header::CONTENT_DISPOSITION, 'attachment; filename="'.$filename.'"');
    }

    /**
     * Returns a response with a downloadable file.
     *
     * @param string $filepath The path to the file
     * @param string|null $filename The filename for the download (defaults to basename)
     * @param array{mimeType?: string} $options Download options
     * @return ResponseInterface
     */
    protected function downloadFile(string $filepath, ?string $filename = null, array $options = []): ResponseInterface
    {
        $filename = $filename ?? basename($filepath);
        $mimeType = $options['mimeType'] ?? mime_content_type($filepath) ?: 'application/octet-stream';

        $content = file_get_contents($filepath);

        return $this->downloadContent($content, $filename, ['mimeType' => $mimeType]);
    }
}