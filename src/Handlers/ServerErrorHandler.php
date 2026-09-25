<?php

declare(strict_types=1);

/**
 * ServerErrorHandler.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Handlers;

use App\AppEnvironment;
use App\Commons\AbstractCmsHandler;
use App\Helpers\ElasticToWidget;
use App\Widgets\Error;
use Blackcube\Ssr\Attributes\RoutingHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

/**
 * 5xx error handler.
 */
#[RoutingHandler(route: 'server-error', errorCodesRange: [500, 599])]
class ServerErrorHandler extends AbstractCmsHandler implements RequestHandlerInterface
{
    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        if ($this->exception !== null) {
            $chain = [];
            $current = $this->exception;
            while ($current !== null) {
                $chain[] = [
                    'class' => $current::class,
                    'message' => $current->getMessage(),
                    'file' => $current->getFile(),
                    'line' => $current->getLine(),
                    'trace' => $current->getTraceAsString(),
                ];
                $current = $current->getPrevious();
            }
            $this->logger->error(
                '[ServerError] '.$this->exception->getMessage(),
                [
                    'uri' => (string) $request->getUri(),
                    'method' => $request->getMethod(),
                    'chain' => $chain,
                ]
            );
        }

        $path = $request->getUri()->getPath();
        $hero = ElasticToWidget::convert($this->element);
        $blocs = ElasticToWidget::convertAll($this->element->getBlocsQuery());
        $hasErrorBloc = $this->enrichErrorBlocs($blocs, 500, $path);
        $timestamp = (new \DateTimeImmutable())->format('Y-m-d H:i:s').' UTC';

        return $this->render('ServerError/index', [
            'element' => $this->element,
            'hero' => $hero,
            'blocs' => $blocs,
            'hasErrorBloc' => $hasErrorBloc,
            'timestamp' => $timestamp,
        ]);
    }

    /**
     * @param array<\App\Widgets\AbstractWidget|\App\Widgets\AbstractGroupWidget> $blocs
     */
    private function enrichErrorBlocs(array $blocs, int $httpCode, string $path): bool
    {
        $hasErrorBloc = false;
        $isDebug = AppEnvironment::create()->isDebug();
        foreach ($blocs as $bloc) {
            if ($bloc instanceof Error) {
                $bloc->setException($this->exception)
                    ->setHttpCode($httpCode)
                    ->setPath($path)
                    ->setDebug($isDebug);
                $hasErrorBloc = true;
            }
        }
        return $hasErrorBloc;
    }
}
