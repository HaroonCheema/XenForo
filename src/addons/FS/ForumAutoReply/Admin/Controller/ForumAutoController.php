<?php

namespace FS\ForumAutoReply\Admin\Controller;

use XF\Admin\Controller\AbstractController;
use XF\Mvc\ParameterBag;

class ForumAutoController extends AbstractController
{
    public function actionIndex(ParameterBag $params)
    {
        $data = $this->finder('FS\ForumAutoReply:ForumAutoReply')->order('message_id', 'DESC')
            ->with('Node')
            ->with('User')
            ->with('UserGroup')
            ->with('Prefix');

        $page = $params->page;
        $perPage = 5;

        $data->limitByPage($page, $perPage);

        $viewParams = [
            'data' => $data->fetch(),

            'page' => $page,
            'perPage' => $perPage,
            'total' => $data->total()
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
        $with[] = 'User';

        /** @var \FS\ForumAutoReply\Entity\ForumAutoReply $message */
        $message = $this->assertMessageExists($params->message_id, $with);
        return $this->messageAddEdit($message);
    }

    protected function messageAddEdit(\FS\ForumAutoReply\Entity\ForumAutoReply $message)
    {
        $prefixListData = $this->getPrefixRepo();

        $viewParams = [
            'message' => $message,
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

        if ($params->message_id) {
            /** @var \FS\ForumAutoReply\Entity\ForumAutoReply $message */
            $message = $this->assertMessageExists($params->message_id);
            $this->messageSaveProcess($message, false);
        } else {
            $message = $this->em()->create('FS\ForumAutoReply:ForumAutoReply');
            $this->messageSaveProcess($message, true);
        }



        return $this->redirect($this->buildLink('forumAutoReply'));
    }

    protected function messageSaveProcess(\FS\ForumAutoReply\Entity\ForumAutoReply $message, $new)
    {
        $input = $this->filterMessageInputs();

        // $message['message_id'];

        foreach ($input['words'] as $key => $value) {

            if ($new) {
                $message = $this->em()->create('FS\ForumAutoReply:ForumAutoReply');
            }

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

        return $message;
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
