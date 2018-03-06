<?php


class HomeController 
{

public function showHome()
    {
        $chapterManager = new ChapterManager(); 
	    $chapters = $chapterManager->getChapters(); 

        $connected= new UserSession();
        $logged=$connected->isLogged();

        $req = new FlashMessageSession();
        $flash = $req->asMessage();

        $template = 'home';
        $title = 'Page Accueil';
        
        require('view/layoutView.phtml');

	    
    }

public function chapter()
    {
        
        $chapterManager = new ChapterManager();
        $commentManager = new CommentManager();
        if (isset($_GET['id']) && $_GET['id'] > 0)
        {
            $chapter = $chapterManager->getChapter($_GET['id']);
            $comments = $commentManager->getComments($_GET['id']);

            $connected= new UserSession();
            $logged=$connected->isLogged();

            $req = new FlashMessageSession();
            $flash = $req->asMessage();
        }
        $template = 'chapter';
        $title = 'Page chapitre';
        
        require('view/layoutView.phtml');
    }
}