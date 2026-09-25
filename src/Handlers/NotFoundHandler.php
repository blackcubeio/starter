<?php

declare(strict_types=1);

/**
 * NotFoundHandler.php
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
use App\Widgets\Error;
use Blackcube\Ssr\Attributes\RoutingHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 404 error handler.
 */
#[RoutingHandler(route: 'not-found', errorCode: 404)]
class NotFoundHandler extends AbstractCmsHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $path = $request->getUri()->getPath();
        $hero = ElasticToWidget::convert($this->element);
        $blocs = ElasticToWidget::convertAll($this->element->getBlocsQuery());
        $hasErrorBloc = $this->enrichErrorBlocs($blocs, 404, $path);

        return $this->render('NotFound/index', [
            'element' => $this->element,
            'hero' => $hero,
            'blocs' => $blocs,
            'path' => $path,
            'hasErrorBloc' => $hasErrorBloc,
        ]);
    }

    /**
     * @param array<\App\Widgets\AbstractWidget|\App\Widgets\AbstractGroupWidget> $blocs
     */
    private function enrichErrorBlocs(array $blocs, int $httpCode, string $path): bool
    {
        $hasErrorBloc = false;
        foreach ($blocs as $bloc) {
            if ($bloc instanceof Error) {
                $bloc->setException($this->exception)
                    ->setHttpCode($httpCode)
                    ->setPath($path);
                $hasErrorBloc = true;
            }
        }
        return $hasErrorBloc;
    }
}
