<?php

declare(strict_types=1);

namespace App\Handlers;

use App\Commons\AbstractCmsHandler;
use Blackcube\Ssr\Attributes\RoutingHandler;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Yiisoft\Http\Header;
use Yiisoft\Http\Status;

/**
 * Redirects to the first child content matching the browser language.
 */
#[RoutingHandler(route: 'redirect-lang')]
final class RedirectLangHandler extends AbstractCmsHandler implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $locale = $this->getLocale($request);

        $child = $this->element->relativeQuery()
            ->children()
            ->andWhere(['languageId' => $locale])
            ->one();

        if ($child === null) {
            $child = $this->element->relativeQuery()
                ->children()
                ->one();
        }

        if ($child !== null && $child->getSlugId() !== null) {
            $slug = $child->getSlugQuery()->one();
            if ($slug !== null) {
                $link = $slug->getLink();
                $url = $link->isTemplated()
                    ? '/' . ltrim($slug->getPath(), '/')
                    : $link->getHref();

                return $this->responseFactory
                    ->createResponse(Status::FOUND)
                    ->withHeader(Header::LOCATION, $url);
            }
        }

        return $this->responseFactory->createResponse(Status::NOT_FOUND);
    }
}
