<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Handlers;

use App\AppEnvironment;
use App\Commons\AbstractCmsHandler;
use App\Forms\ContactForm;
use App\Helpers\ElasticToWidget;
use Blackcube\Dcore\Entities\Content;
use Blackcube\Dcore\Entities\Tag;
use Blackcube\Handler\HandlerConfig;
use Blackcube\Ssr\Attributes\RoutingHandler;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Psr\Log\LoggerInterface;
use Throwable;
use Yiisoft\Aliases\Aliases;
use Yiisoft\DataResponse\ResponseFactory\JsonResponseFactory;
use Yiisoft\Http\Method;
use Yiisoft\I18n\LocaleProvider;
use Yiisoft\Mailer\MailerInterface;
use Yiisoft\Mailer\Message;
use Yiisoft\Router\UrlGeneratorInterface;
use Yiisoft\Translator\TranslatorInterface;
use Yiisoft\Yii\View\Renderer\WebViewRenderer;

/**
 * Contact page handler.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
#[RoutingHandler(route: 'contact')]
class ContactHandler extends AbstractCmsHandler implements RequestHandlerInterface
{
    public function __construct(
        LoggerInterface $logger,
        HandlerConfig $config,
        WebViewRenderer $viewRenderer,
        ResponseFactoryInterface $responseFactory,
        JsonResponseFactory $jsonResponseFactory,
        UrlGeneratorInterface $urlGenerator,
        Aliases $aliases,
        LocaleProvider $localeProvider,
        Content|Tag $element,
        private readonly ?MailerInterface $mailer = null,
        private readonly ?TranslatorInterface $translator = null,
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
            element: $element,
            exception: null,
            params: $params,
        );
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $contactForm = new ContactForm($this->translator);
        $contactForm->setScenario(ContactForm::SCENARIO_SUBMIT);
        $contactSuccess = false;

        if ($request->getMethod() === Method::POST) {
            $bodyParams = (array) $request->getParsedBody();
            if ($contactForm->load($bodyParams) === true && $contactForm->validate() === true) {
                $contactSuccess = $this->sendMail($contactForm);
            }
        }

        $hero = ElasticToWidget::convert($this->element);
        $blocs = ElasticToWidget::convertAll($this->element->getBlocsQuery());

        return $this->render('Contact/index', [
            'element' => $this->element,
            'hero' => $hero,
            'blocs' => $blocs,
            'contactForm' => $contactForm,
            'contactSuccess' => $contactSuccess,
        ]);
    }

    protected function sendMail(ContactForm $contactForm): bool
    {
        $status = true;
        if ($this->mailer !== null) {
            $appEnvironment = AppEnvironment::create();

            $textBody = 'Nouveau message depuis le formulaire de contact :' . "\n\n"
                . 'Nom : ' . $contactForm->getName() . "\n"
                . 'Email : ' . $contactForm->getEmail() . "\n";
            $company = $contactForm->getCompany();
            if ($company !== null && $company !== '') {
                $textBody .= 'Société : ' . $company . "\n";
            }
            $textBody .= "\n" . 'Message :' . "\n" . $contactForm->getMessage();

            $message = (new Message())
                ->withFrom($appEnvironment->getMailjetFrom() ?? '')
                ->withTo($appEnvironment->getMailjetTo() ?? '')
                ->withReplyTo($contactForm->getEmail() ?? '')
                ->withSubject('Contact depuis blackcube.io')
                ->withTextBody($textBody);

            try {
                $this->mailer->send($message);
            } catch (Throwable $e) {
                $this->logger->error('[Contact] mail not sent: ' . $e->getMessage(), [
                    'exception' => $e,
                ]);
                $status = false;
            }
        }
        return $status;
    }
}
