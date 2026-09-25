<?php

/**
 * example.php
 *
 * PHP Version 8.1
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

use Blackcube\Bleet\Bleet;
use Blackcube\Dboard\Models\Forms\BlocForm;

/**
 *
 * @var int $blocId
 * @var BlocForm $blocForm,
 * @var array $attributes
 * @var array $fileEndpoints
 */
foreach ($attributes as $attribute):
        $finalAttribute = '['.$blocId.']'.$attribute;
?>

    <?php echo Bleet::elastic($fileEndpoints)->active($blocForm, $finalAttribute)->render(); ?>

<?php endforeach;

