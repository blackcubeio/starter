<?php
/**
 * contact.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 * @var App\Forms\ContactForm|null $form
 * @var bool $isSuccess
 * @var Yiisoft\Yii\View\Renderer\Csrf|null $csrf
 * @var Yiisoft\Translator\TranslatorInterface|null $translator
 */

use App\Widgets\Svg;
use Blackcube\Dcore\Helpers\Element;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$description = $elastic->description ?? '';
$successTitle = $elastic->successTitle ?? '';
$successDescription = $elastic->successDescription ?? '';

$routeUrl = Element::extractUrl($elastic, ['route']) ?? '';
$formAction = (empty($routeUrl) === false) ? $routeUrl : '#contact';

$errors = [];
if ($form !== null && $form->isValidated() === true) {
    $errors = $form->getValidationResult()->getErrorMessagesIndexedByProperty();
}

$arrowIconSvg = Svg::icon('arrow-right')->addClass('w-4 h-4')->render();

$labelClass = 'block text-sm font-medium text-secondary-700 dark:text-secondary-300 mb-1.5';
$requiredMarkClass = 'text-danger-500';
$inputClass = 'w-full px-3.5 py-2.5 rounded-lg border border-secondary-300 dark:border-secondary-600 bg-white dark:bg-secondary-800 text-secondary-900 dark:text-white text-sm placeholder:text-secondary-400 focus:outline-2 focus:outline-primary-500 focus:border-primary-500 transition-colors';
$textareaClass = $inputClass.' resize-y';
$errorClass = 'mt-1 text-sm text-danger-600 dark:text-danger-500';
$submitClass = 'inline-flex items-center gap-2 px-6 py-3 text-sm font-semibold text-white bg-primary-700 hover:bg-primary-800 rounded-lg transition-colors focus:outline-2 focus:outline-offset-2 focus:outline-primary-500 cursor-pointer';
?>
<section id="contact" class="mx-auto max-w-screen-xl px-6 py-4">
    <div blackcube-fade-up class="fade-up max-w-2xl mx-auto">
<?php if (empty($description) === false): ?>
        <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => 'rich text-secondary-600 dark:text-secondary-400 leading-relaxed mb-8 space-y-3'])->encode(false); ?>
<?php endif; ?>
<?php if ($isSuccess === true): ?>
        <div class="rounded-xl border border-dashed border-success-300 dark:border-success-700 bg-success-50 dark:bg-success-900/20 p-6">
<?php if (empty($successTitle) === false): ?>
            <?php echo Html::tag('h3', $successTitle, ['class' => 'text-lg font-semibold text-success-800 dark:text-success-300 mb-2'])->encode(false); ?>
<?php endif; ?>
<?php if (empty($successDescription) === false): ?>
            <?php echo Html::tag('div', Quill::cleanHtml($successDescription), ['class' => 'rich text-sm text-success-700 dark:text-success-400 leading-relaxed space-y-2'])->encode(false); ?>
<?php endif; ?>
        </div>
<?php else: ?>
        <?php echo Html::form()
            ->post($formAction)
            ->csrf($csrf)
            ->noValidate()
            ->class('flex flex-col gap-5')
            ->open(); ?>
            <div>
                <label for="contact-name" class="<?php echo $labelClass; ?>">
                    <?php echo Html::encode($translator?->translate('Name', category: 'app-contact') ?? 'Name'); ?> <span class="<?php echo $requiredMarkClass; ?>" aria-hidden="true">*</span>
                </label>
                <input
                    type="text"
                    id="contact-name"
                    name="ContactForm[name]"
                    autocomplete="name"
                    aria-required="true"
                    required
                    value="<?php echo Html::encode($form?->getName() ?? ''); ?>"
                    class="<?php echo $inputClass; ?>"
                />
<?php foreach ($errors['name'] ?? [] as $errorMessage): ?>
                <?php echo Html::tag('p', $errorMessage, ['class' => $errorClass, 'role' => 'alert'])->encode(false); ?>
<?php endforeach; ?>
            </div>
            <div>
                <label for="contact-email" class="<?php echo $labelClass; ?>">
                    <?php echo Html::encode($translator?->translate('Email', category: 'app-contact') ?? 'Email'); ?> <span class="<?php echo $requiredMarkClass; ?>" aria-hidden="true">*</span>
                </label>
                <input
                    type="email"
                    id="contact-email"
                    name="ContactForm[email]"
                    autocomplete="email"
                    aria-required="true"
                    required
                    value="<?php echo Html::encode($form?->getEmail() ?? ''); ?>"
                    class="<?php echo $inputClass; ?>"
                />
<?php foreach ($errors['email'] ?? [] as $errorMessage): ?>
                <?php echo Html::tag('p', $errorMessage, ['class' => $errorClass, 'role' => 'alert'])->encode(false); ?>
<?php endforeach; ?>
            </div>
            <div>
                <label for="contact-company" class="<?php echo $labelClass; ?>">
                    <?php echo Html::encode($translator?->translate('Company', category: 'app-contact') ?? 'Company'); ?> <span class="text-secondary-400 dark:text-secondary-500 font-normal"><?php echo Html::encode($translator?->translate('Optional', category: 'app-contact') ?? '(optional)'); ?></span>
                </label>
                <input
                    type="text"
                    id="contact-company"
                    name="ContactForm[company]"
                    autocomplete="organization"
                    value="<?php echo Html::encode($form?->getCompany() ?? ''); ?>"
                    class="<?php echo $inputClass; ?>"
                />
<?php foreach ($errors['company'] ?? [] as $errorMessage): ?>
                <?php echo Html::tag('p', $errorMessage, ['class' => $errorClass, 'role' => 'alert'])->encode(false); ?>
<?php endforeach; ?>
            </div>
            <div>
                <label for="contact-message" class="<?php echo $labelClass; ?>">
                    <?php echo Html::encode($translator?->translate('Message', category: 'app-contact') ?? 'Message'); ?> <span class="<?php echo $requiredMarkClass; ?>" aria-hidden="true">*</span>
                </label>
                <textarea
                    id="contact-message"
                    name="ContactForm[message]"
                    rows="6"
                    aria-required="true"
                    required
                    placeholder="<?php echo Html::encode($translator?->translate('MessagePlaceholder', category: 'app-contact') ?? ''); ?>"
                    class="<?php echo $textareaClass; ?>"
                ><?php echo Html::encode($form?->getMessage() ?? ''); ?></textarea>
<?php foreach ($errors['message'] ?? [] as $errorMessage): ?>
                <?php echo Html::tag('p', $errorMessage, ['class' => $errorClass, 'role' => 'alert'])->encode(false); ?>
<?php endforeach; ?>
            </div>
            <div class="pt-2">
                <?php echo Html::submitButton(
                    Html::encode($translator?->translate('Send', category: 'app-contact') ?? 'Send').$arrowIconSvg,
                    ['class' => $submitClass],
                )->encode(false); ?>
            </div>
        <?php echo Html::closeTag('form'); ?>
<?php endif; ?>
    </div>
</section>
