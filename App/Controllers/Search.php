<?php

namespace App\Controllers;


use App\AController;
use App\Model\Article;

class Search
    extends AController
{
    protected $str;

    public function actionDefault($str)

    {
        if (isset($_POST['txt'])) {
            $this->str = strip_tags($_POST['txt']);
            if (strlen($this->str) < 3) {
                echo '<p>Слишком короткий поисковый запрос.</p>';
                die;
            } else {
                $search = Article::getSearchLike($this->str);
            }
        }

        $this->view->search = $search;
        $this->view->title = 'Поиск - ' . $this->str;
        $this->view->display(__DIR__. '/../view/search.php');
    }
}