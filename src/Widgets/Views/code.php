<?php

declare(strict_types=1);

/**
 * @var Blackcube\ActiveRecord\Elastic\ElasticInterface $elastic
 */

use Yiisoft\Html\Html;

if ($elastic->language === 'html') {
    $code = str_replace('<', '&lt;', $elastic->code ?? '');
} else {
    $code = $elastic->code ?? '';
}
?>
<div class="mt-5 mb-8 first:mt-0 last:mb-0 relative overflow-hidden rounded-2xl">
    <div class="pt-2 bg-secondary-900 dark:bg-secondary-50 shadow-lg group">
        <div class="flex text-secondary-400 dark:text-secondary-500 text-xs leading-6">
            <div class="flex-none border-t border-b border-t-transparent border-b-secondary-700 dark:border-b-secondary-300 px-4 py-1 flex items-center"><?php echo $elastic->filename ?? ''; ?></div>
            <div class="flex-auto flex items-center bg-secondary-800/50 dark:bg-secondary-200/50 border border-secondary-700/30 dark:border-secondary-300/30 rounded-tl"></div>
            <button type="button" data-code-highlight="copy" class="flex-none px-4 py-1 flex items-center text-secondary-400 dark:text-secondary-500 hover:text-white dark:hover:text-secondary-900 cursor-pointer">
                <svg data-code-highlight="icon-copy" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4"><path stroke-linecap="round" stroke-linejoin="round" d="M15.75 17.25v3.375c0 .621-.504 1.125-1.125 1.125h-9.75a1.125 1.125 0 0 1-1.125-1.125V7.875c0-.621.504-1.125 1.125-1.125H6.75a9.06 9.06 0 0 1 1.5.124m7.5 10.376h3.375c.621 0 1.125-.504 1.125-1.125V11.25c0-4.46-3.243-8.161-7.5-8.876a9.06 9.06 0 0 0-1.5-.124H9.375c-.621 0-1.125.504-1.125 1.125v3.5m7.5 10.375H9.375a1.125 1.125 0 0 1-1.125-1.125v-9.25m12 6.625v-1.875a3.375 3.375 0 0 0-3.375-3.375h-1.5a1.125 1.125 0 0 1-1.125-1.125v-1.5a3.375 3.375 0 0 0-3.375-3.375H9.75" /></svg>
                <svg data-code-highlight="icon-copied" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="size-4 hidden transition duration-300"><path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 0 0 2.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 0 0-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 0 0 .75-.75 2.25 2.25 0 0 0-.1-.664m-5.8 0A2.251 2.251 0 0 1 13.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25ZM6.75 12h.008v.008H6.75V12Zm0 3h.008v.008H6.75V15Zm0 3h.008v.008H6.75V18Z" /></svg>
            </button>
        </div>
        <div class="children:my-0 children:!shadow-none children:bg-transparent py-4">
            <?php echo Html::openTag('pre', ['class' => 'my-0 mx-2 text-secondary-200 dark:text-secondary-800 overflow-x-auto', 'code-highlight' => $elastic->language]); ?><?php echo Html::tag('code', $code); ?><?php echo Html::closeTag('pre'); ?>
        </div>
    </div>
    <div class="pointer-events-none absolute inset-0 rounded-2xl" aria-hidden="true"></div>
</div>
