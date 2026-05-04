<?php

declare(strict_types=1);

/**
 * MergeBlocs.php
 *
 * PHP Version 8.3+
 *
 * @copyright 2010-2026 Philippe Gaultier
 * @license https://www.blackcube.io/license
 * @link https://www.blackcube.io
 */

namespace App\Helpers;

use Blackcube\ActiveRecord\Elastic\ElasticInterface;

/**
 * Groups consecutive blocs that share the same elasticSchemaId and have the group flag set.
 */
final class MergeBlocs
{
    /**
     * @param ElasticInterface[] $blocs
     * @return array<ElasticInterface|ElasticInterface[]>
     */
    public static function merge(array $blocs): array
    {
        $result = [];
        $currentGroup = [];
        $currentSchemaId = null;

        foreach ($blocs as $bloc) {
            $schemaId = $bloc->getElasticSchemaId();
            $grouped = !empty($bloc->group);

            if ($grouped && $schemaId === $currentSchemaId && $currentGroup !== []) {
                $currentGroup[] = $bloc;
            } else {
                if (count($currentGroup) > 1) {
                    $result[] = $currentGroup;
                } elseif (count($currentGroup) === 1) {
                    $result[] = $currentGroup[0];
                }

                if ($grouped) {
                    $currentGroup = [$bloc];
                    $currentSchemaId = $schemaId;
                } else {
                    $result[] = $bloc;
                    $currentGroup = [];
                    $currentSchemaId = null;
                }
            }
        }

        if (count($currentGroup) > 1) {
            $result[] = $currentGroup;
        } elseif (count($currentGroup) === 1) {
            $result[] = $currentGroup[0];
        }

        return $result;
    }
}
