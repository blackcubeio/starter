<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 * @var Throwable|null $exception
 * @var int|null $httpCode
 * @var string|null $path
 * @var string $locale
 * @var bool $debug
 */

use App\Helpers\HeadingClass;
use Blackcube\Ssr\Helpers\Quill;
use Yiisoft\Html\Html;

$description = $elastic->description ?? '';

$labels = [
    404 => ['fr' => 'Page introuvable', 'en' => 'Page not found'],
    500 => ['fr' => 'Erreur interne', 'en' => 'Internal error'],
];
$labelDefault = $locale === 'fr' ? 'Erreur' : 'Error';
$label = $httpCode !== null && isset($labels[$httpCode][$locale])
    ? $labels[$httpCode][$locale]
    : $labelDefault;

$homeLabel = $locale === 'fr' ? 'Retour à l\'accueil →' : 'Back to home →';
$urlLabel = $locale === 'fr' ? 'URL :' : 'URL:';
?>
<section>
    <div class="mx-auto max-w-page w-full px-6 lg:px-10 py-10 lg:py-14">
        <p class="font-mono text-xs uppercase tracking-widest opacity-60 mb-8 flex items-center gap-3">
            <span class="inline-block w-6 h-px bg-current"></span>
<?php if ($httpCode !== null): ?>
            <?php echo $httpCode; ?> — <?php echo $label; ?>
<?php else: ?>
            <?php echo $label; ?>
<?php endif; ?>
        </p>
<?php if ($httpCode !== null): ?>
        <p class="font-bold tracking-tight leading-none text-7xl sm:text-8xl md:text-9xl opacity-15 select-none"><?php echo $httpCode; ?></p>
<?php endif; ?>
        <?php echo Html::tag('h1', $label, ['class' => 'mt-6 '.HeadingClass::for(1)])->encode(false); ?>
<?php if (empty($description) === false): ?>
        <div class="rich mt-6 max-w-2xl text-base leading-relaxed opacity-85 space-y-3">
            <?php echo Quill::cleanHtml($description); ?>
        </div>
<?php endif; ?>
<?php if (empty($path) === false): ?>
        <div class="mt-6 inline-flex items-center gap-3 font-mono text-xs uppercase tracking-widest opacity-70 max-w-full">
            <span class="opacity-60"><?php echo $urlLabel; ?></span>
            <code class="truncate"><?php echo $path; ?></code>
        </div>
<?php endif; ?>
<?php if ($debug === true && $exception !== null): ?>
        <div class="mt-8 max-w-full">
<?php
            $current = $exception;
            $depth = 0;
            while ($current !== null):
?>
            <div class="mt-4 font-mono text-xs leading-relaxed border-l-2 border-current opacity-80 pl-4">
                <p class="uppercase tracking-widest opacity-60">
                    <?php echo $depth === 0 ? 'Exception' : 'Caused by'; ?>
                    <?php echo $current->getCode() !== 0 ? ' #'.$current->getCode() : ''; ?>
                    <span class="opacity-70">— <?php echo $current::class; ?></span>
                </p>
                <p class="mt-1"><code class="whitespace-pre-wrap break-words"><?php echo $current->getMessage(); ?></code></p>
                <p class="mt-1 opacity-70"><code><?php echo $current->getFile(); ?>:<?php echo $current->getLine(); ?></code></p>
                <pre class="mt-2 overflow-x-auto whitespace-pre text-[11px] opacity-80"><?php echo $current->getTraceAsString(); ?></pre>
            </div>
<?php
                $current = $current->getPrevious();
                $depth++;
            endwhile;
?>
        </div>
<?php endif; ?>
        <div class="mt-10">
            <a href="/" class="inline-flex items-center gap-2 bg-secondary-900 text-secondary-50 dark:bg-secondary-50 dark:text-secondary-900 px-6 py-3 font-mono text-xs uppercase tracking-widest hover:bg-primary-700 hover:text-secondary-50 dark:hover:bg-primary-300 dark:hover:text-secondary-900 transition-colors">
                <?php echo $homeLabel; ?>
            </a>
        </div>
    </div>
</section>
