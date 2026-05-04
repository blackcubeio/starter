<?php

declare(strict_types=1);

/**
 * ServerErrorHandler.php
 *
 * PHP Version 8.3+
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Handlers;

use App\Commons\AbstractCmsHandler;
use Blackcube\Dcore\Entities\Content;
use Blackcube\Dcore\Entities\Tag;
use App\Helpers\ElasticToWidget;
use Blackcube\Ssr\Attributes\RoutingHandler;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Aliases\Aliases;
use Yiisoft\DataResponse\ResponseFactory\JsonResponseFactory;
use Yiisoft\I18n\Locale;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

/**
 * 5xx error handler.
 */
#[RoutingHandler(route: 'server-error', errorCodesRange: [500, 599])]
final class ServerErrorHandler extends AbstractCmsHandler implements RequestHandlerInterface
{
    public function __construct(
        WebViewRenderer $viewRenderer,
        ResponseFactoryInterface $responseFactory,
        JsonResponseFactory $jsonResponseFactory,
        UrlGeneratorInterface $urlGenerator,
        Aliases $aliases,
        LocaleProvider $localeProvider,
        Content|Tag $element,
        private ?Throwable $exception = null,
        array $params = [],
    ) {
        parent::__construct(
            $viewRenderer,
            $responseFactory,
            $jsonResponseFactory,
            $urlGenerator,
            $aliases,
            $localeProvider,
            $element,
            $params,
        );
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $locale = $this->getLocale($request);
        $this->localeProvider->set(new Locale($locale));
        // extract widget from element properties
        $hero = ElasticToWidget::convert($this->element);
        // extract all widgets from all blocs
        $blocs = ElasticToWidget::convertAll($this->element->getBlocsQuery());
        return $this->render('ServerError/index', [
            'element' => $this->element,
            'hero' => $hero,
            'blocs' => $blocs,
            'exception' => $this->exception,
        ]);
    }
}
