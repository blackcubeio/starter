<?php

declare(strict_types=1);

/**
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Migrations;

use Yiisoft\Db\Migration\MigrationBuilder;
use Yiisoft\Db\Migration\RevertibleMigrationInterface;
use Throwable;

/**
 * Reloads the app-contact translation category of src/i18n into the database message
 * source, replacing the messages that category already had.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class M00000001000002SeedAppContactTranslations implements RevertibleMigrationInterface
{
    private const CATEGORY = 'app-contact';

    public function up(MigrationBuilder $b): void
    {
        $i18nPath = dirname(__DIR__).'/i18n';
        $enFile = $i18nPath.'/en/'.self::CATEGORY.'.php';
        if (file_exists($enFile) === true) {
            $messages = require $enFile;
            $transaction = $b->getDb()->beginTransaction();
            try {
                $b->delete('{{%yii_source_message}}', [
                    'category' => self::CATEGORY,
                ]);

                $messageMap = [];
                foreach ($messages as $messageId => $translation) {
                    $b->insert('{{%yii_source_message}}', [
                        'category' => self::CATEGORY,
                        'message_id' => $messageId,
                    ]);
                    $messageMap[$messageId] = (int) $b->getDb()->getLastInsertID();
                }

                $translationRows = [];
                foreach (glob($i18nPath.'/*', GLOB_ONLYDIR) as $dir) {
                    $locale = basename($dir);
                    $file = $i18nPath.'/'.$locale.'/'.self::CATEGORY.'.php';
                    if (file_exists($file) === true) {
                        $localeMessages = require $file;
                        foreach ($localeMessages as $messageId => $translation) {
                            if (isset($messageMap[$messageId]) === true) {
                                $translationRows[] = [
                                    $messageMap[$messageId],
                                    $locale,
                                    $translation,
                                ];
                            }
                        }
                    }
                }

                if ($translationRows !== []) {
                    $b->insertBatch('{{%yii_message}}', $translationRows, [
                        'id',
                        'locale',
                        'translation',
                    ]);
                }
                $transaction->commit();
            } catch (Throwable $e) {
                $transaction->rollBack();
                throw $e;
            }
        }
    }

    public function down(MigrationBuilder $b): void
    {
        $b->delete('{{%yii_source_message}}', [
            'category' => self::CATEGORY,
        ]);
    }
}
