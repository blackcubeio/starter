<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Commons;

use Blackcube\Handler\AbstractHandler;
use Blackcube\Handler\HandlerConfig;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\DataResponse\ResponseFactory\JsonResponseFactory;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

/**
 * Base of the application handlers: the blackcube/handler base with the locale provider.
 * A view name starting with an alias (@...) is resolved to its file.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
abstract class AbstractBaseHandler extends AbstractHandler
{
    /**
     * @param array<string, mixed> $params Application parameters
     */
    public function __construct(
        LoggerInterface $logger,
        HandlerConfig $config,
        WebViewRenderer $viewRenderer,
        ResponseFactoryInterface $responseFactory,
        JsonResponseFactory $jsonResponseFactory,
        UrlGeneratorInterface $urlGenerator,
        Aliases $aliases,
        protected LocaleProvider $localeProvider,
        array $params = [],
    ) {
        parent::__construct(
            logger: $logger,
            config: $config,
            viewRenderer: $viewRenderer,
            responseFactory: $responseFactory,
            jsonResponseFactory: $jsonResponseFactory,
            urlGenerator: $urlGenerator,
            aliases: $aliases,
        );
    }

    protected function extractViewPath(string $view): string
    {
        if (str_starts_with($view, '@') === true) {
            $viewPath = $this->aliases->get($view);
        } else {
            $viewPath = parent::extractViewPath($view);
        }
        return $viewPath;
    }
}