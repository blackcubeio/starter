<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Commons;

use Blackcube\Dcore\Entities\Content;
use Blackcube\Dcore\Entities\Tag;
use Blackcube\Handler\HandlerConfig;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Throwable;
use Yiisoft\Aliases\Aliases;
use Yiisoft\DataResponse\ResponseFactory\JsonResponseFactory;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

/**
 * Base of the CMS handlers: receives the routed element (Content or Tag)
 * and, on the error routes, the caught exception.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
abstract class AbstractCmsHandler extends AbstractBaseHandler
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
        LocaleProvider $localeProvider,
        protected Content|Tag $element,
        protected ?Throwable $exception = null,
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
            localeProvider: $localeProvider,
            params: $params,
        );
    }
}