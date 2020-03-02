<?php

namespace Code4Romania\Cms\Models;

use A17\Twill\Models\Behaviors\HasPosition;
use A17\Twill\Models\Behaviors\HasTranslation;
use A17\Twill\Models\Behaviors\Sortable;
use A17\Twill\Models\Model;
use Illuminate\Support\Arr;
use Kalnoy\Nestedset\NodeTrait;

class MenuItem extends Model implements Sortable
{
    use HasTranslation, HasPosition, NodeTrait;

    protected $fillable = [
        'type',
        'target',
        'location',
        'position',
        'parent_id',
    ];

    public $translatedAttributes = [
        'label',
        'active',
    ];

    public static function saveTreeFromIds($nodesArray)
    {
        self::fixTree();
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

    public static function rebuildTree($nodesArray, $parentNodes)
    {
        if (is_array($nodesArray)) {
            foreach ($nodesArray as $nodeArray) {
                $parent = $parentNodes->where('id', $nodeArray['id'])->first();
                if (isset($nodeArray['children']) && is_array($nodeArray['children'])) {
                    $position = 1;
                    $nodes = self::find(Arr::pluck($nodeArray['children'], 'id'));
                    foreach ($nodeArray['children'] as $child) {
                        // append the children to their (old/new)parents
                        $descendant = $nodes->where('id', $child['id'])->first();
                        $descendant->position = $position++;
                        $descendant->parent_id = $parent->id;
                        $descendant->save();
                        self::rebuildTree($nodeArray['children'], $nodes);
                    }
                }
            }
        }
    }
}
