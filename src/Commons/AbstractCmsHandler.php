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

use Blackcube\Dcore\Entities\Content;
use Blackcube\Dcore\Entities\Tag;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Log\LoggerInterface;
use Throwable;
use Yiisoft\Aliases\Aliases;
use Yiisoft\DataResponse\ResponseFactory\JsonResponseFactory;
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
abstract class AbstractCmsHandler extends AbstractBaseHandler
{
    public function __construct(
        protected WebViewRenderer $viewRenderer,
        protected ResponseFactoryInterface $responseFactory,
        protected JsonResponseFactory $jsonResponseFactory,
        protected UrlGeneratorInterface $urlGenerator,
        protected Aliases $aliases,
        protected LocaleProvider $localeProvider,
        protected LoggerInterface $logger,
        protected Content|Tag $element,
        protected ?Throwable $exception = null,
        array $params = [],
    ) {
        parent::__construct(
            $viewRenderer,
            $responseFactory,
            $jsonResponseFactory,
            $urlGenerator,
            $aliases,
            $localeProvider,
            $logger,
            $params,
        );
    }
}