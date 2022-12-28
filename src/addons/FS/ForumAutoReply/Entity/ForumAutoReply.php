<?php

namespace FS\ForumAutoReply\Entity;

use XF\Mvc\Entity\Entity;
use XF\Mvc\Entity\Structure;

class ForumAutoReply extends Entity
{

    public static function getStructure(Structure $structure)
    {
        $structure->table = 'xf_forum_auto_reply';
        $structure->shortName = 'FS\ForumAutoReply:ForumAutoReply';
        $structure->contentType = 'xf_forum_auto_reply';
        $structure->primaryKey = 'id';
        $structure->columns = [
            'id' => ['type' => self::UINT, 'autoIncrement' => true],
            'forum_words' => ['type' => self::JSON_ARRAY, 'maxLength' => 255, 'default' => []],
        ];

        $structure->relations = [];
        $structure->defaultWith = [];
        $structure->getters = [];
        $structure->behaviors = [];

        return $structure;
    }
}
