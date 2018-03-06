<?php


class AdminController 
{
	public function showAdmin()
	{
        $chapterManager = new ChapterManager(); 
        $commentManager = new CommentManager();
	    $chapters = $chapterManager->getChapters(); 
        $listcomments = $commentManager->getCommentsAdmin();

        $req = new FlashMessageSession();
        $message = $req->setFlash('Vous êtes connecté');
        $flash = $req->asMessage();

	    $template = 'admin';
        $title = 'Page administration';
        
        require('view/layoutView.phtml');
	}
}