<?php

namespace FS\ForumAutoReply\Admin\Controller;

use XF\Admin\Controller\AbstractController;
use XF\Mvc\ParameterBag;

class ForumAutoController extends AbstractController
{
    public function actionIndex(ParameterBag $params)
    {
        $page = $this->filterPage();

        $perPage = 5;

        $from = (($perPage * $page) - $perPage) + 1;
        $start = $from - 1;
        $limit = $perPage;

        $result = $this->pagination($start, $limit);

        $prefixListData = $this->getPrefixRepo();

        $viewParams = [
            'data' => $result['data'],
            'nodeTree' => $this->getNodesRepo(),
            'userGroups' => $this->getUserGroupRepo()->findUserGroupsForList()->fetch(),
            'prefixGroups' => $prefixListData['prefixGroups'],
            'prefixesGrouped' => $prefixListData['prefixesGrouped'],
            'page' => $page,
            'perPage' => $perPage,
            'totalReturn' => $result['totalReturn'],
            'total' => $result['total']
        ];

        return $this->view('FS\ForumAutoReply:ForumAutoController\Index', 'forum_auto_reply_all', $viewParams);
    }

    public function actionAdd()
    {
        $message = $this->em()->create('FS\ForumAutoReply:ForumAutoReply');
        return $this->messageAddEdit($message);
    }

    public function actionEdit(ParameterBag $params)
    {
        /** @var \FS\ForumAutoReply\Entity\ForumAutoReply $message */
        $message = $this->assertMessageExists($params->message_id);
        return $this->messageAddEdit($message);
    }

    public function actionEditSingle(ParameterBag $params)
    {
        /** @var \FS\ForumAutoReply\Entity\ForumAutoReply $message */
        $message = $this->assertMessageExists($params->message_id);

        $viewParams = [
            'message' => $message
        ];

        return $this->view('FS\ForumAutoReply:ForumAutoController\EditSingle', 'forum_auto_reply_edit_single', $viewParams);
    }

    public function actionEditSave(ParameterBag $params)
    {
        $this->isExistedUser();

        $input = $this->filterMessageInputs();

        /** @var \FS\ForumAutoReply\Entity\ForumAutoReply $message */
        $message = $this->assertMessageExists($params->message_id);

        foreach ($input['words'] as $key => $value) {

            if ($value && $input['messages'][$key] && $input['from_users'][$key] != '') {

                $user = $this->finder('XF:User')->where('username', $input['from_users'][$key])->fetchOne();

                $message->word = $value;
                $message->message = $input['messages'][$key];
                $message->user_id = $user['user_id'];

                $message->save();
            }
        }

        return $this->messageAddEdit($message);
    }

    protected function messageAddEdit(\FS\ForumAutoReply\Entity\ForumAutoReply $message)
    {
        $data = $this->finder('FS\ForumAutoReply:ForumAutoReply')->where('node_id', $message['node_id'])
            ->with('User');

        $prefixListData = $this->getPrefixRepo();

        $viewParams = [
            'message' => $message,
            'nodeId' => $message['node_id'],
            'userGroupId' => $message['user_group_id'],
            'prefixId' => $message['prefix_id'],
            'data' => $data->fetch(),
            'nodeTree' => $this->getNodesRepo(),
            'userGroups' => $this->getUserGroupRepo()->findUserGroupsForList()->fetch(),
            'prefixGroups' => $prefixListData['prefixGroups'],
            'prefixesGrouped' => $prefixListData['prefixesGrouped'],
        ];

        return $this->view('FS\ForumAutoReply:ForumAutoController\Add', 'forum_auto_reply_add', $viewParams);
    }

    public function actionSave(ParameterBag $params)
    {
        $this->isExistedUser();

        $input = $this->filterMessageInputs();

        if ($params->message_id) {
            /** @var \FS\ForumAutoReply\Entity\ForumAutoReply $message */
            $message = $this->assertMessageExists($params->message_id);
            if ($message['node_id'] != $input['node_id']) {
                $this->isNodeExisted();
            } else {
                $this->preDeleteNodes($message);
            }
            $this->messageSaveProcess();
        } else {
            $this->isNodeExisted();
            $this->messageSaveProcess();
        }



        return $this->redirect($this->buildLink('forumAutoReply'));
    }

    protected function messageSaveProcess()
    {
        $input = $this->filterMessageInputs();

        foreach ($input['words'] as $key => $value) {

            $message = $this->em()->create('FS\ForumAutoReply:ForumAutoReply');

            if ($value && $input['messages'][$key] && $input['from_users'][$key] != '') {

                $user = $this->finder('XF:User')->where('username', $input['from_users'][$key])->fetchOne();

                $message->node_id = $input['node_id'];
                $message->word = $value;
                $message->message = $input['messages'][$key];
                $message->user_id = $user['user_id'];
                $message->user_group_id = $input['user_group_id'];
                $message->prefix_id = $input['prefix_id'];

                $message->save();
            }
        }

        return $this->redirect($this->buildLink('forumAutoReply'));
    }

    public function actionDelete(ParameterBag $params)
    {
        $replyExists = $this->assertMessageExists($params->message_id);

        /** @var \XF\ControllerPlugin\Delete $plugin */
        $plugin = $this->plugin('XF:Delete');
        return $plugin->actionDelete(
            $replyExists,
            $this->buildLink('forumAutoReply/delete', $replyExists),
            null,
            $this->buildLink('forumAutoReply'),
            "{$replyExists->word} - {$replyExists->message}"
        );
    }

    public function actionDeleteAll(ParameterBag $params)
    {
        /** @var \FS\ForumAutoReply\Entity\ForumAutoReply $replyExists */
        $replyExists = $this->assertMessageExists($params->message_id);

        /** @var \XF\ControllerPlugin\Delete $plugin */
        $plugin = $this->plugin('XF:Delete');

        if ($this->isPost()) {

            $this->preDeleteNodes($replyExists);

            return $this->redirect($this->buildLink('forumAutoReply'));
        }

        return $plugin->actionDelete(
            $replyExists,
            $this->buildLink('forumAutoReply/delete-all', $replyExists),
            null,
            $this->buildLink('forumAutoReply'),
            "Are you sure for delete this Forum ?"
        );
    }

    protected function filterMessageInputs()
    {
        return $this->filter([
            'node_id' => 'str',
            'words' => 'array',
            'messages' => 'array',
            'from_users' => 'array',
            'user_group_id' => 'str',
            'prefix_id' => 'str',
        ]);
    }

    protected function isNodeExisted()
    {
        $input = $this->filterMessageInputs();

        $node = null;

        $node = $this->finder('FS\ForumAutoReply:ForumAutoReply')->where('node_id', $input['node_id'])->fetchOne();

        if ($node) {
            throw $this->exception($this->error(\XF::phraseDeferred('node_already_exist')));
        }
    }

    protected function isExistedUser()
    {
        $input = $this->filterMessageInputs();

        foreach ($input['from_users'] as $value) {

            $user = null;
            if ($value) {
                $user = $this->finder('XF:User')->where('username', $value)->fetchOne();

                if (!$user) {
                    throw $this->exception($this->error(\XF::phraseDeferred('requested_user_x_not_found', ['name' => $value])));
                }
            }
        }
    }

    protected function preDeleteNodes(\FS\ForumAutoReply\Entity\ForumAutoReply $message)
    {
        $nodes = $this->finder('FS\ForumAutoReply:ForumAutoReply')->where('node_id', $message['node_id'])->fetch();

        foreach ($nodes as $node) {
            $node->delete();
        }
    }

    protected function pagination($start, $limit)
    {
        $db = \XF::db();
        $data = $db->fetchAll('SELECT node_id,MIN(message_id) as message_id ,MIN(user_group_id) as user_group_id ,MIN(prefix_id) as prefix_id FROM xf_forum_auto_reply GROUP BY node_id LIMIT ' . (int) $start . "," . (int) $limit);


        $total = count($db->fetchAll('SELECT node_id,MIN(message_id) as message_id ,MIN(user_group_id) as user_group_id ,MIN(prefix_id) as prefix_id FROM xf_forum_auto_reply GROUP BY node_id'));

        $viewParams = [
            'data' => $data,
            'total' => $total,
            'totalReturn' => count($data),
        ];

        return $viewParams;
    }

    /**
     * @return \XF\Repository\UserGroup
     */
    protected function getUserGroupRepo()
    {
        return $this->repository('XF:UserGroup');
    }

    /**
     * @return \XF\Repository\Node
     */
    protected function getNodesRepo()
    {
        /** @var \XF\Repository\Node $nodeRepo */
        $nodeRepo = \XF::repository('XF:Node');
        $nodeTree = $nodeRepo->createNodeTree($nodeRepo->getFullNodeList());

        return $nodeTree;
    }

    /**
     * @return \XF\Repository\ThreadPrefix
     */
    protected function getPrefixRepo()
    {
        /** @var \XF\Repository\ThreadPrefix $prefixRepo */
        $prefixRepo = $this->repository('XF:ThreadPrefix');
        $prefixListData = $prefixRepo->getPrefixListData();

        return $prefixListData;
    }

    /**
     * @param string $id
     * @param array|string|null $with
     * @param null|string $phraseKey
     *
     * @return \CRUD\XF\Entity\Crud
     */
    protected function assertMessageExists($id, array $extraWith = [], $phraseKey = null)
    {
        return $this->assertRecordExists('FS\ForumAutoReply:ForumAutoReply', $id, $extraWith, $phraseKey);
    }
}
