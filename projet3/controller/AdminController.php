<?php


class AdminController 
{
	public function showAdmin()
	{
        $chapterManager = new ChapterManager(); 
        $commentManager = new CommentManager();
	    $chapters = $chapterManager->getChapters(); 
        $listcomments = $commentManager->getCommentsAdmin();

	    require('view/adminView.phtml');
	}
}