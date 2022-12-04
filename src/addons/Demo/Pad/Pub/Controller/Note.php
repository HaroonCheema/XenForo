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
        $postFinder = $this->finder('XF:Post')
        // JOIN lgane k liye use hota hai ->with is se user waley table ka data b postFinder me a jaye ga
        ->with('User')
        ->with('User.Profile')
        ->with('Thread')
        ->where('user_id','<>',0);

        $viewParams = [
            'posts' => $postFinder
        ];

        return $this->view('Demo\Pad:Note\Test','demo_pad_test',$viewParams);
    }


    public function actionQuerydatabase()
    {

        // for fetch by id query
        // $userFinder = $this->finder('XF:User')->wherId(2);

        $userFinder = $this->finder('XF:User')
        // ->where('user_id','<',4)
        // ->where('username','LIKE','h%')
        ->whereOr(['user_id','<',4],['username','LIKE','h%'])
        ->order('user_id', 'desc');

        $total = $userFinder->total();

        // $users = $userFinder->fetchOne();
        $users = $userFinder->fetch();

        $viewParams = [

        ];
        return $this->view('Demo\Pad:Note\Index','demo_pad_index',$viewParams);
    }


    public function actionQueryupdatebyid()
    {

        $userFinder = $this->finder('XF:User')->wherId(2);

        /** @var \XF\Entity\User $user */
        $users = $userFinder->fetchOne();

        $user->email = 'hello@example.com';
        $user->username = 'mister';

        //                 Or

        // $user->bulkset([
        //     'email' => 'hello@example.com',
        //     'username' => 'mister',
        // ]);

        $user->save();

        return $this->view('Demo\Pad:Note\Index','demo_pad_index');
    }


    public function actionQueryinsertdata()
    {
        $users = $this->em()->create('XF:User');

        $user->email = 'hello@example.com';
        $user->username = 'mister';

        //                 Or

        // $user->bulkset([
        //     'email' => 'hello@example.com',
        //     'username' => 'mister',
        // ]);

        $user->save();

        return $this->view('Demo\Pad:Note\Index','demo_pad_index');
    }

    //          ider se hm koch parameters ko pass krein gey template me phir uder print kerwaien gey

    //    Route is : http://localhost/xenforo/index.php?notes/pass-params

    public function actionPassParams()
    {
        $string = 'Hello';
        $number = 11234;
        $money = 10.1;
        $array = ['one', 'two', 'there'];
        $array1 = ['name' => 'Mr Haroon', 'email' => 'example@example.com'];

        foreach ($array as $key => $value) {
            # code...
        }

        $viewParams = [
            'string' => $string,
            'number' => $number,
            'money' => $money,
            'array' => $array,
            'array1' => $array1
        ];

        return $this->view('Demo\Pad:Note\PassParam','demo_pad_pass_param',$viewParams);

    }
}