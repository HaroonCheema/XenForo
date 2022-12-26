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

        $finder = $this->finder('CRUD\XF:Crud');

        // ager filter search wala set hai to ye code chaley ga or is k ander wala function or code run ho ga
        if ($this->filter('search', 'uint')) {
            $finder = $this->getCrudSearchFinder();

            if (count($finder->getConditions()) == 0) {
                return $this->error(\XF::phrase('please_complete_required_field'));
            }
        }
        // nai to ye wala run ho ga code jo is ka defaul hai or sarey record show kerwaye ga
        else {
            $finder->order('id', 'DESC');
        }


        $page = $params->page;
        $perPage = 3;

        $finder->limitByPage($page, $perPage);

        $viewParams = [
            'data' => $finder->fetch(),

            'page' => $page,
            'perPage' => $perPage,
            'total' => $finder->total(),

            // ager filter me koch search kia hai to wo is k zareiye hm input tag me show kerwa sakte hain
            'conditions' => $this->filterSearchConditions(),
        ];

        return $this->view('CRUD\XF:Crud\Index', 'crud_record_all', $viewParams);
    }

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
        } else {
            $crud = $this->em()->create('CRUD\XF:Crud');
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

    // filter bar k input tag k ander value ko get or set krney k liye ye method call kr rahey hain

    protected function filterSearchConditions()
    {
        return $this->filter([
            'name' => 'str',
            'rClass' => 'str',
            'rollNo' => 'str',
        ]);
    }

    // filter wala form show kerwaney k liye ye use ho ga

    public function actionRefineSearch()
    {

        $viewParams = [
            'conditions' => $this->filterSearchConditions(),
        ];

        return $this->view('CRUD\XF:Crud\RefineSearch', 'crud_record_search_filter', $viewParams);
    }

    // ider hm condition apply kr rahey hain kr filter me koi ho gi to or wapis index waley function me return kr k result ko show kerwa rahey hain

    protected function getCrudSearchFinder()
    {
        $conditions = $this->filterSearchConditions();

        $finder = $this->finder('CRUD\XF:Crud');

        if ($conditions['name'] != '') {
            $finder->where('name', 'LIKE', '%' . $finder->escapeLike($conditions['name']) . '%');
        }

        if ($conditions['rClass'] != '') {
            $finder->where('class', 'LIKE', '%' . $finder->escapeLike($conditions['rClass']) . '%');
        }

        if ($conditions['rollNo'] != '') {
            $finder->where('rollNo', 'LIKE', '%' . $finder->escapeLike($conditions['rollNo']) . '%');
        }

        return $finder;
    }
}
