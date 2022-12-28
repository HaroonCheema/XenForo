<?php

namespace FS\ForumAutoReply\Admin\Controller;

use XF\Mvc\ParameterBag;
use FS\ForumAutoReply\Entity\ForumAutoReply;
use XF\Admin\Controller\AbstractController;

class ForumAutoController extends AbstractController
{
    public function actionIndex()
    {
        $viewParams = [];

        return $this->view('FS\ForumAutoReply:ForumAutoController\Index', 'forum_auto_reply_all', $viewParams);
    }

    public function actionAdd()
    {
        $searcher = $this->searcher('XF:Thread');

        /** @var \XF\Repository\Node $nodeRepo */
        $nodeRepo = \XF::repository('XF:Node');
        $nodeTree = $nodeRepo->createNodeTree($nodeRepo->getFullNodeList());

        /** @var \XF\Repository\ThreadPrefix $prefixRepo */
        $prefixRepo = $this->repository('XF:ThreadPrefix');
        $prefixListData = $prefixRepo->getPrefixListData();

        $viewParams = [];

        $viewParams = [
            'nodeTree' => $nodeTree,
            'userGroups' => $this->getUserGroupRepo()->findUserGroupsForList()->fetch(),
            'prefixGroups' => $prefixListData['prefixGroups'],
            'prefixesGrouped' => $prefixListData['prefixesGrouped'],
        ] + $searcher->getFormData();

        // echo "<pre>";
        // print_r($prefixListData['prefixGroups']);
        // // var_dump($availablePrefixes);
        // exit;

        return $this->view('FS\ForumAutoReply:ForumAutoController\Add', 'forum_auto_reply_add', $viewParams);
    }

    public function actionSave()
    {
        $alert = $this->filter([
            'from_user' => 'str',
        ]);

        $user = null;
        if ($alert['from_user']) {
            $user = $this->finder('XF:User')->where('username', $alert['from_user'])->fetchOne();
            if (!$user) {
                throw $this->exception($this->error(\XF::phraseDeferred('requested_user_x_not_found', ['name' => $alert['from_user']])));
            }
        }

        return $this->message("ok");
    }

    /**
     * @return \XF\Repository\UserGroup
     */
    protected function getUserGroupRepo()
    {
        return $this->repository('XF:UserGroup');
    }
}
