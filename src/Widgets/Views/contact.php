<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 * @var App\Forms\ContactForm|null $form
 * @var bool $isSuccess
 * @var Yiisoft\Yii\View\Renderer\Csrf|null $csrf
 * @var Yiisoft\Translator\TranslatorInterface $translator
 */

use App\Forms\ContactForm;
use App\Helpers\HeadingClass;
use App\Widgets\Form\Button;
use App\Widgets\Form\Input;
use App\Widgets\Form\Label;
use App\Widgets\Form\Textarea;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

if ($form === null) {
    $form = new ContactForm($translator);
    $form->setScenario(ContactForm::SCENARIO_SUBMIT);
}

$description = $elastic->description ?? '';
$successTitle = $elastic->successTitle ?? '';
$successDescription = $elastic->successDescription ?? '';

$errors = [];
if ($form->isValidated() === true) {
    $errors = $form->getValidationResult()->getErrorMessagesIndexedByProperty();
}

$labelClass = 'font-mono text-xs uppercase tracking-widest opacity-80';
$fieldClass = 'field px-4 py-3 text-base';
$textareaClass = $fieldClass.' resize-y';
$errorClass = 'text-xs text-danger-600 dark:text-danger-400';
$submitClass = 'inline-flex items-center gap-2 bg-secondary-900 text-secondary-50 dark:bg-secondary-50 dark:text-secondary-900 px-6 py-3 font-mono text-xs uppercase tracking-widest hover:bg-primary-700 hover:text-secondary-50 dark:hover:bg-primary-300 dark:hover:text-secondary-900 transition-colors cursor-pointer';
?>
<section id="contact">
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">

<?php if ($isSuccess === true): ?>
        <div blackcube-fade-up class="border-l-4 border-success-500 bg-success-50 dark:bg-success-900/30 p-8 flex flex-col gap-3 max-w-3xl fade-up">
            <?php echo Html::tag('div', $translator->translate('Sent', category: 'app-contact'), ['class' => 'font-mono text-xs uppercase tracking-widest text-success-700 dark:text-success-300']); ?>
<?php if (empty($successTitle) === false): ?>
            <?php echo Html::tag('h3', $successTitle, ['class' => HeadingClass::for(3)])->encode(false); ?>
<?php endif; ?>
<?php if (empty($successDescription) === false): ?>
            <?php echo Html::tag('div', Quill::cleanHtml($successDescription), ['class' => 'rich text-base leading-relaxed opacity-90 space-y-3'])->encode(false); ?>
<?php endif; ?>
        </div>
<?php else: ?>
        <div blackcube-fade-up class="flex flex-col lg:flex-row gap-10 lg:gap-16 max-w-5xl fade-up">
            <div class="w-full lg:w-2/5">
                <?php echo Html::tag('p', $translator->translate('Form', category: 'app-contact'), ['class' => 'font-mono text-xs uppercase tracking-widest opacity-60 mb-6']); ?>
<?php if (empty($description) === false): ?>
                <?php echo Html::tag('div', Quill::cleanHtml($description), ['class' => 'rich text-base leading-relaxed opacity-90 space-y-3'])->encode(false); ?>
<?php endif; ?>
            </div>

            <?php echo Html::form()
                ->post('#contact')
                ->csrf($csrf)
                ->noValidate()
                ->class('w-full lg:w-3/5 flex flex-col gap-5')
                ->open(); ?>
                <div class="flex flex-col gap-2">
                    <?php echo Label::widget()->active($form, 'name')->addClass($labelClass)->render(); ?>
                    <?php echo Input::widget()->active($form, 'name')->text()->autocomplete('name')->addClass($fieldClass)->render(); ?>
<?php foreach ($errors['name'] ?? [] as $errorMessage): ?>
                    <?php echo Html::tag('p', $errorMessage, ['class' => $errorClass]); ?>
<?php endforeach; ?>
                </div>
                <div class="flex flex-col gap-2">
                    <?php echo Label::widget()->active($form, 'email')->addClass($labelClass)->render(); ?>
                    <?php echo Input::widget()->active($form, 'email')->email()->autocomplete('email')->addClass($fieldClass)->render(); ?>
<?php foreach ($errors['email'] ?? [] as $errorMessage): ?>
                    <?php echo Html::tag('p', $errorMessage, ['class' => $errorClass]); ?>
<?php endforeach; ?>
                </div>
                <div class="flex flex-col gap-2">
                    <?php echo Label::widget()->active($form, 'company')->addClass($labelClass)->render(); ?>
                    <?php echo Input::widget()->active($form, 'company')->text()->autocomplete('organization')->addClass($fieldClass)->render(); ?>
<?php foreach ($errors['company'] ?? [] as $errorMessage): ?>
                    <?php echo Html::tag('p', $errorMessage, ['class' => $errorClass]); ?>
<?php endforeach; ?>
                </div>
                <div class="flex flex-col gap-2">
                    <?php echo Label::widget()->active($form, 'message')->addClass($labelClass)->render(); ?>
                    <?php echo Textarea::widget()->active($form, 'message')->rows(6)->placeholder($translator->translate('MessagePlaceholder', category: 'app-contact'))->addClass($textareaClass)->render(); ?>
<?php foreach ($errors['message'] ?? [] as $errorMessage): ?>
                    <?php echo Html::tag('p', $errorMessage, ['class' => $errorClass]); ?>
<?php endforeach; ?>
                </div>
                <div class="flex flex-wrap items-center gap-x-6 gap-y-3 pt-2">
                    <?php echo Button::widget($translator->translate('Send', category: 'app-contact').' →')->encode(false)->submit()->addClass($submitClass)->render(); ?>
                </div>
            <?php echo Html::closeTag('form'); ?>
        </div>
<?php endif; ?>

    </div>
</section>
