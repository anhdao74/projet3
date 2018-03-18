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
        
        $chapter = $chapterManager->getChapter(strip_tags($_GET['id']));
        if ($chapter)
        {
            if (isset($_GET['id']))
            { 
               $_GET['id'] = (int) $_GET['id'];
               if ($_GET['id'] >= 1 AND $_GET['id'] <=500)
               {
                $comments = $commentManager->getComments(strip_tags($_GET['id']));

                $connected= new UserSession();
                $logged=$connected->isLogged();

                $req = new FlashMessageSession();
                $flash = $req->asMessage();

                $template = 'chapter';
                $title = 'Page chapitre';
                
                require('view/layoutView.phtml');
                }
            }
        }
        else
        {
            echo 'L\'identifiant du chapitre demandé n\'existe pas';
        }
    }
}
