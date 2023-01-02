<?php

namespace FS\ForumAutoReply\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class ForumAutoReply extends Entity
{

    public static function getStructure(Structure $structure)
    {
        $structure->table = 'fs_forum_auto_reply';
        $structure->shortName = 'FS\ForumAutoReply:ForumAutoReply';
        $structure->contentType = 'fs_forum_auto_reply';
        $structure->primaryKey = 'message_id';
        $structure->columns = [
            'message_id' => ['type' => self::UINT, 'autoIncrement' => true],
            'node_id' => ['type' => self::UINT],
            'word' => ['type' => self::STR, 'required' => true],
            'message' => ['type' => self::STR, 'required' => true],
            'user_id' => ['type' => self::UINT],
            'user_group_id' => ['type' => self::UINT],
            'prefix_id' => ['type' => self::UINT],
        ];

        $structure->relations = [
            'Node' => [
                'entity' => 'XF:Node',
                'type' => self::TO_ONE,
                'conditions' => 'node_id',
            ],

            'User' => [
                'entity' => 'XF:User',
                'type' => self::TO_ONE,
                'conditions' => 'user_id',
            ],

            'UserGroup' => [
                'entity' => 'XF:UserGroup',
                'type' => self::TO_ONE,
                'conditions' => 'user_group_id',
            ],

            'Prefix' => [
                'entity' => 'XF:ThreadPrefix',
                'type' => self::TO_ONE,
                'conditions' => 'prefix_id',
            ],
        ];
        $structure->defaultWith = [];
        $structure->getters = [];
        $structure->behaviors = [];

        return $structure;
    }
}
