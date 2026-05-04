<?php
/**
 * @var string $footerLinks
 * @var string $homeUrl
 */

use Yiisoft\Html\Html;
?>
<footer class="border-t border-secondary-200 dark:border-secondary-700 bg-secondary-50 dark:bg-secondary-900 mt-16">
    <div class="mx-auto max-w-screen-2xl px-6 py-12">
        <div class="flex flex-col md:flex-row gap-10 md:gap-16">
            <div class="md:w-64 shrink-0">
                <div class="mb-4">
                    <?php echo Html::a(
                        '<svg class="w-8 h-8 text-black dark:text-white rounded-lg" viewBox="0 -5 180 165.60001" xmlns="http://www.w3.org/2000/svg"><path d="M 176.4,-5 H 3.6 C 1.6128,-5 0,-3.3872 0,-1.4 V 157 c 0,1.9908 1.6128,3.6 3.6,3.6 h 172.8 c 1.9908,0 3.6,-1.6092 3.6,-3.6 V -1.4 c 0,-1.9872 -1.6092,-3.6 -3.6,-3.6 z m -91.0548,85.3452 -36,36 c -0.702,0.702 -1.6236,1.0548 -2.5452,1.0548 -0.9216,0 -1.8432,-0.3528 -2.5452,-1.0548 -1.4076,-1.4076 -1.4076,-3.6828 0,-5.0904 L 77.7096,77.8 44.2548,44.3452 c -1.4076,-1.4076 -1.4076,-3.6828 0,-5.0904 1.4076,-1.4076 3.6828,-1.4076 5.0904,0 l 36,36 c 1.4076,1.4076 1.4076,3.6828 0,5.0904 z M 133.2,117.4 h -36 c -1.9908,0 -3.6,-1.6092 -3.6,-3.6 0,-1.9908 1.6092,-3.6 3.6,-3.6 h 36 c 1.9908,0 3.6,1.6092 3.6,3.6 0,1.9908 -1.6092,3.6 -3.6,3.6 z" fill="currentColor" stroke-width="3.5"/></svg>'
                        . '<span class="font-bold text-lg text-primary-900 dark:text-white tracking-tight">Blackcube</span>',
                        $homeUrl,
                        ['class' => 'flex items-center gap-3'],
                    )->encode(false); ?>
                </div>
                <p class="text-sm text-secondary-500 dark:text-secondary-400 leading-relaxed">The framework-agnostic PHP CMS.</p>
            </div>
            <?php echo $footerLinks ?>
        </div>
        <div class="flex flex-col sm:flex-row items-center justify-between mt-10 pt-6 border-t border-secondary-200 dark:border-secondary-700 text-xs text-secondary-400 dark:text-secondary-500">
            <p>&copy; 2025 Blackcube.</p>
            <p class="mt-2 sm:mt-0">Built with Blackcube.</p>
        </div>
    </div>
</footer>
