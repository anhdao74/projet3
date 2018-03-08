<?php


class AdminController 
{
	public function showAdmin()
	{
        $chapterManager = new ChapterManager(); 
        $commentManager = new CommentManager();
	    $chapters = $chapterManager->getChapters(); 
        $listcomments = $commentManager->getCommentsAdmin();

        $connected= new UserSession();
        $logged=$connected->isLogged();

        $req = new FlashMessageSession();
        $flash = $req->asMessage();

	$template = 'admin';
        $title = 'Page administration';
        
        require('view/layoutView.phtml');
	}
}