<?php

declare(strict_types=1);

/**
 * PageHandler.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Handlers;

use App\Commons\AbstractCmsHandler;
use App\Helpers\ElasticToWidget;
use Blackcube\Ssr\Attributes\RoutingHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * Page handler — 3-column layout with sidebar, prev/next and TOC.
 */
#[RoutingHandler(route: 'page')]
class PageHandler extends AbstractCmsHandler implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $hero = ElasticToWidget::convert($this->element);
        $blocs = ElasticToWidget::convertAll($this->element->getBlocsQuery());
        return $this->render('Page/index', [
            'element' => $this->element,
            'hero' => $hero,
            'blocs' => $blocs,
        ]);
    }
}
