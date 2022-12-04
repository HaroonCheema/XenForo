<?php

namespace Demo\Pad\Pub\Controller;

use XF\Pub\Controller\AbstractController;

class Note extends AbstractController
{

    // http://localhost/xenforo/index.php?notes/

    public function actionIndex()
    {
        return $this->view('Demo\Pad:Note\Index','demo_pad_index');
    }

    // http://localhost/xenforo/index.php?notes/test/

    public function actionTest()
    {
        return $this->view('Demo\Pad:Note\Test','demo_pad_test');
    }
}