<?php
/**
 * index.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
/**
 * @var Blackcube\Dcore\Entities\Content|Blackcube\Dcore\Entities\Tag $element
 * @var App\Widgets\AbstractWidget|null $hero
 * @var array<App\Widgets\AbstractWidget|App\Widgets\AbstractGroupWidget> $blocs
 * @var App\Forms\ContactForm $contactForm
 * @var bool $contactSuccess
 * @var Yiisoft\Yii\View\Renderer\Csrf $csrf
 */

use App\Widgets\Contact;
use App\Widgets\Footer;
use App\Widgets\Header;
?>
<?php echo Header::widget()->element($element)->render(); ?>

<main id="main" role="main">
<?php if ($hero !== null): ?>
    <?php echo $hero->render(); ?>
<?php endif; ?>
<?php foreach ($blocs as $bloc): ?>
<?php if ($bloc instanceof Contact): ?>
    <?php echo $bloc->form($contactForm)->success($contactSuccess)->csrf($csrf)->render(); ?>
<?php else: ?>
    <?php echo $bloc->render(); ?>
<?php endif; ?>
<?php endforeach; ?>
</main>

<?php echo Footer::widget()->render(); ?>
