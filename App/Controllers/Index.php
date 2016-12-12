<?php


namespace App\Controllers;


use App\AController;
use App\Exceptions\BaseException;
use App\Exceptions\Main;
use App\Model;
use App\Model\Article;
use App\Pagination;

class Index
    extends AController
{
	
	
	public function actionDefault()
    {
        $this->view->title = 'Главная';
        $this->view->display(__DIR__. '/../view/main.php');
    }

    /**
     * @param $page
     */
    public function actionMain($page)
    {
        $total = Article::getTotal();

        $pagination = new Pagination($total->count,$page,Model::LIMMIT);
        $this->view->pagination = $pagination;

        if (isset($page)) {
            $news = Article::getOffset($page);
        } else {
            $news = Article::getOffset(1);
        }
        $this->view->title = 'Список новостей';
        $this->view->news = $news;
        $this->view->display(__DIR__. '/../view/index.php');
    }

    /**
     * @param int $id
     * @throws BaseException
     */
    public function actionOne (int $id)
    {
        $article = Article::findByid($id);
        if ($article == false) {
            throw new BaseException('Ошибка 404 - не найдено');
        }
        $this->view->title = $article->title;
        $this->view->article = $article;
        $this->view->display(__DIR__. '/../view/article.php');
    }

}