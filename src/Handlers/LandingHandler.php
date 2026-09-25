<?php

declare(strict_types=1);

/**
 * LandingHandler.php
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
 * Landing page handler.
 */
#[RoutingHandler(route: 'landing')]
class LandingHandler extends AbstractCmsHandler implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $hero = ElasticToWidget::convert($this->element);
        $blocs = ElasticToWidget::convertAll($this->element->getBlocsQuery());
        return $this->render('Landing/index', [
            'element' => $this->element,
            'hero' => $hero,
            'blocs' => $blocs,
        ]);
    }
}
