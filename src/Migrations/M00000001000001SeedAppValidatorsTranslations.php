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
 * Loads every application translation category of src/i18n (one file per category
 * under en/, one directory per locale) into the database message source.
 *
 * @copyright 2010-2026 Blackcube - Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */
class M00000001000001SeedAppValidatorsTranslations implements RevertibleMigrationInterface
{
    public function up(MigrationBuilder $b): void
    {
        $i18nPath = dirname(__DIR__).'/i18n';
        $categories = [];
        if (is_dir($i18nPath.'/en') === true) {
            foreach (glob($i18nPath.'/en/*.php') as $file) {
                $categories[] = pathinfo($file, PATHINFO_FILENAME);
            }
        }

        if ($categories !== []) {
            $locales = [];
            foreach (glob($i18nPath.'/*', GLOB_ONLYDIR) as $dir) {
                $locales[] = basename($dir);
            }

            $transaction = $b->getDb()->beginTransaction();
            try {
                $messageMap = [];
                foreach ($categories as $category) {
                    $messages = require $i18nPath.'/en/'.$category.'.php';
                    foreach ($messages as $messageId => $translation) {
                        $b->insert('{{%yii_source_message}}', [
                            'category' => $category,
                            'message_id' => $messageId,
                        ]);
                        $messageMap[$category][$messageId] = (int) $b->getDb()->getLastInsertID();
                    }
                }

                $translationRows = [];
                foreach ($locales as $locale) {
                    foreach ($categories as $category) {
                        $file = $i18nPath.'/'.$locale.'/'.$category.'.php';
                        if (file_exists($file) === true) {
                            $messages = require $file;
                            foreach ($messages as $messageId => $translation) {
                                if (isset($messageMap[$category][$messageId]) === true) {
                                    $translationRows[] = [
                                        $messageMap[$category][$messageId],
                                        $locale,
                                        $translation,
                                    ];
                                }
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
        $i18nPath = dirname(__DIR__).'/i18n';
        if (is_dir($i18nPath.'/en') === true) {
            foreach (glob($i18nPath.'/en/*.php') as $file) {
                $category = pathinfo($file, PATHINFO_FILENAME);
                $b->delete('{{%yii_source_message}}', [
                    'category' => $category,
                ]);
            }
        }
    }
}
