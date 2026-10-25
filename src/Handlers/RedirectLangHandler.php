<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

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
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
#[RoutingHandler(route: 'redirect-lang')]
class RedirectLangHandler extends AbstractCmsHandler implements RequestHandlerInterface
{

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $locale = $this->localeProvider->get()->language();

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
                $url = $link->getHref();

                return $this->responseFactory
                    ->createResponse(Status::FOUND)
                    ->withHeader(Header::LOCATION, $url);
            }
        }

        return $this->responseFactory->createResponse(Status::NOT_FOUND);
    }
}
