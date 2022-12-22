<?php

namespace CRUD\XF\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Pub\Controller\AbstractController;

class Crud extends AbstractController
{

    // Fatch all records from xf_crud database

    // http://localhost/xenforo/index.php?crud/

    public function actionIndex(ParameterBag $params)
    {
        $data = $this->finder('CRUD\XF:Crud')->order('id', 'DESC');
        //                          or
        // $data = $this->finder('CRUD\XF:Crud')->order('id', 'DESC')->fetch();

        // \XF::dump($data);
        // exit;

        $page = $params->page;
        $perPage = 3;

        $data->limitByPage($page, $perPage);


        $viewParams = [
            'data' => $data->fetch(),

            'page' => $page,
            'perPage' => $perPage,
            'total' => $data->total()
        ];

        return $this->view('CRUD\XF:Crud\Index', 'crud_record_all', $viewParams);
    }


    // Move to add from view 

    // http://localhost/xenforo/index.php?crud/add/

    // public function actionAdd()
    // {
    //     return $this->view('CRUD\XF:Crud\Add', 'crud_record_insert');
    // }


    public function actionAdd()
    {
        $crud = $this->em()->create('CRUD\XF:Crud');
        return $this->crudAddEdit($crud);
    }

    public function actionEdit(ParameterBag $params)
    {
        $crud = $this->assertDataExists($params->id);
        return $this->crudAddEdit($crud);
    }

    protected function crudAddEdit(\CRUD\XF\Entity\Crud $crud)
    {
        $viewParams = [
            'crud' => $crud
        ];

        return $this->view('CRUD\XF:Crud\Add', 'crud_record_insert', $viewParams);
    }

    public function actionSave(ParameterBag $params)
    {
        if ($params->id) {
            $crud = $this->assertDataExists($params->id);
            // var_dump($params);
        } else {
            $crud = $this->em()->create('CRUD\XF:Crud');
            // $input = $this->filter([
            //     'title' => 'str',
            //     'content' => 'str',
            // ]);

            // echo $input['content'];
        }

        $this->crudSaveProcess($crud)->run();

        return $this->redirect($this->buildLink('crud'));
    }


    protected function crudSaveProcess(\CRUD\XF\Entity\Crud $crud)
    {
        $input = $this->filter([
            'name' => 'str',
            'class' => 'str',
            'rollNo' => 'int',
        ]);

        $form = $this->formAction();
        $form->basicEntitySave($crud, $input);

        return $form;
    }

    // to save data in data base using this method

    // http://localhost/xenforo/index.php?crud/insert/    


    // To update record in data base using this method

    // http://localhost/xenforo/index.php?crud/update/


    // To delete record from data base using this method

    // http://localhost/xenforo/index.php?crud/id/delete-record/ 


    public function actionDeleteRecord(ParameterBag $params)
    {
        $replyExists = $this->assertDataExists($params->id);

        /** @var \XF\ControllerPlugin\Delete $plugin */
        $plugin = $this->plugin('XF:Delete');
        return $plugin->actionDelete(
            $replyExists,
            $this->buildLink('crud/delete-record', $replyExists),
            null,
            $this->buildLink('crud'),
            "{$replyExists->id} - {$replyExists->name}"
        );
    }

    // plugin for check id exists or not 

    /**
     * @param string $id
     * @param array|string|null $with
     * @param null|string $phraseKey
     *
     * @return \CRUD\XF\Entity\Crud
     */
    protected function assertDataExists($id, array $extraWith = [], $phraseKey = null)
    {
        return $this->assertRecordExists('CRUD\XF:Crud', $id, $extraWith, $phraseKey);
    }
}
