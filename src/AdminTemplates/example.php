<?php

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
        $finalAttribute = '['.$blocId.']' . $attribute;
?>

    <?php echo Bleet::elastic($fileEndpoints)->active($blocForm, $finalAttribute)->render(); ?>

<?php endforeach;

