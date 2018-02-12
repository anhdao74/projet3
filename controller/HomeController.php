<?php


class HomeController 
{

public function showHome()
    {
        $db = Db::getConnexionPDO();
        $chapterManager = new ChapterManager($db); 
	    $chapters = $chapterManager->getChapters(); 

	    require('view/homeView.phtml');
    }

public function chapter()
    {
        
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
            $chapter = $chapterManager->getChapter($_GET['id']);
            $comments = $commentManager->getComments($_GET['id']);
        }
        

        require ('view/chapterView.phtml');
    }
}