<?php

declare(strict_types=1);

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasBlocks;
use A17\Twill\Models\Behaviors\HasMedias;
use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasRevisions;
use A17\Twill\Models\Behaviors\HasSlug;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use Illuminate\Support\Arr;
use Kalnoy\Nestedset\NodeTrait;

class Page extends Model implements Sortable
{
    use HasBlocks, HasTranslation, HasSlug, HasMedias, HasRevisions, HasPosition, NodeTrait;

    /**
     * @var array<string>
     */
    protected $fillable = [
        'published',
        'title',
        // 'subtitle',
        'description',
        'position',
        // 'public',
        // 'featured',
        'publish_start_date',
        'publish_end_date',
    ];

    /**
     * Required when using the HasTranslation trait
     *
     * @var array<string>
     */
    public $translatedAttributes = [
        'title',
        'subtitle',
        'description',
        'active',
    ];

    /**
     * Required when using the HasSlug trait
     *
     * @var array<string>
     */
    public $slugAttributes = [
        'title',
    ];

    /**
     * Checkbox field names (published toggle is itself a checkbox)
     *
     * @var array<string>
     */
    public $checkboxes = [
        'published',
    ];

    /**
     * @var array<string>
     */
    public $mediasParams = [];

    /**
     *
     * @param array $nodesArray
     * @return void
     */
    public static function saveTreeFromIds(array $nodesArray): void
    {
        $parentNodes = self::find(Arr::pluck($nodesArray, 'id'));

        if (is_array($nodesArray)) {
            $position = 1;

            foreach ($nodesArray as $nodeArray) {
                $node = $parentNodes->where('id', $nodeArray['id'])->first();
                $node->position = $position++;
                $node->saveAsRoot();
            }
        }

        $parentNodes = self::find(Arr::pluck($nodesArray, 'id'));

        self::rebuildTree($nodesArray, $parentNodes);
    }

    /**
     *
     * @param array $nodesArray
     * @param object $parentNodes
     * @return void
     */
    public static function rebuildTree(array $nodesArray, object $parentNodes): void
    {
        if (!is_array($nodesArray)) {
            return;
        }

        foreach ($nodesArray as $nodeArray) {
            $parent = $parentNodes->where('id', $nodeArray['id'])->first();

            if (!isset($nodeArray['children']) || !is_array($nodeArray['children'])) {
                continue;
            }

            $position = 1;
            $nodes = self::find(Arr::pluck($nodeArray['children'], 'id'));

            foreach ($nodeArray['children'] as $child) {
                $descendant = $nodes->where('id', $child['id'])->first();
                $descendant->position = $position++;
                $descendant->parent_id = $parent->id;
                $descendant->save();

                self::rebuildTree($nodeArray['children'], $nodes);
            }
        }
    }
}
