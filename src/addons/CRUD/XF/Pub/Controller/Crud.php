<?php

namespace CRUD\XF\Pub\Controller;

use XF\Mvc\ParameterBag;
use XF\Pub\Controller\AbstractController;

class Crud extends AbstractController
{

    // Fatch all records from xf_crud database

    // http://localhost/xenforo/index.php?crud/

    public function actionIndex()
    {
        $data = $this->finder('CRUD\XF:Crud')->where('id', '<>', 0);

        $viewParams = [
            'data' => $data
        ];

        return $this->view('CRUD\XF:Crud\Index', 'crud_record_all', $viewParams);
    }


    // Move to add from view 

    // http://localhost/xenforo/index.php?crud/add/

    public function actionAdd()
    {
        return $this->view('CRUD\XF:Crud\Add', 'crud_record_insert');
    }

    // to save data in data base using this method

    // http://localhost/xenforo/index.php?crud/insert/    


    public function actionInsert()
    {

        /** @var \CRUD\XF\Entity\Crud $crud */
        $crud = $this->em()->create('CRUD\XF:Crud');

        $input = $this->filter([
            'name' => 'str',
            'class' => 'str',
            'rollNo' => 'int',
        ]);

        $crud->name = $input['name'];
        $crud->class = $input['class'];
        $crud->rollNo = $input['rollNo'];


        $crud->save();

        return $this->redirect($this->buildLink('crud'));
    }

    // To delete record from data base using this method

    // http://localhost/xenforo/index.php?crud/id/deletes/ 


    public function actionDelete(ParameterBag $params)
    {
        $cruds = $this->finder('CRUD\XF:Crud')->whereId($params->id);

        /** @var \CRUD\XF\Entity\Crud $crud */
        $crud = $cruds->fetchOne();

        $crud->delete();

        return $this->redirect($this->buildLink('crud'));
    }

    // To edit record from data base using this method

    // http://localhost/xenforo/index.php?crud/id/edit-view/ 

    public function actionEditView(ParameterBag $params)
    {
        $cruds = $this->finder('CRUD\XF:Crud')->whereId($params->id);

        /** @var \CRUD\XF\Entity\Crud $crud */
        $crud = $cruds->fetchOne();

        $viewParams = [
            'data' => $crud
        ];

        return $this->view('CRUD\XF:Crud\EditView', 'crud_record_update', $viewParams);
    }

    // To update record in data base using this method

    // http://localhost/xenforo/index.php?crud/update/

    public function actionUpdate()
    {
        $input = $this->filter([
            'id' => 'int',
            'name' => 'str',
            'class' => 'str',
            'rollNo' => 'int',
        ]);

        $recordFinder = $this->finder('CRUD\XF:Crud')->whereId($input['id']);

        /** @var \CRUD\XF\Entity\Crud $crud */
        $crud = $recordFinder->fetchOne();

        $crud->name = $input['name'];
        $crud->class = $input['class'];
        $crud->rollNo = $input['rollNo'];


        $crud->save();

        return $this->redirect($this->buildLink('crud'));
    }
}
