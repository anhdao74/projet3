<?php

class VerifyId
{
	public function getCommentId()
	{
		if (array_key_exists('id',$_GET))
            {
                if (!empty($_GET['id']))
                {
                    if (ctype_digit($_GET['id']))
                    {
                        $commentManager = new CommentManager();
                        $comment = $commentManager->getComment($_GET['id']);
                        if ($comment == TRUE)
                        {
                            return $comment;
                        }
                        else
                        {
                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash('Le commentaire demandé n\'existe pas');
                            header('Location: index.php');
                            exit();
                        }
                    }
                    else
                    {
                        $req = new FlashMessageSession();
                        $flash = $req->asMessage();
                        $flash = $req->setFlash('L\'identifiant d\'un commentaire doit être un nombre entier');
                        header('Location: index.php');
                        exit(); 
                    }
                }
                else
                {
                    $req = new FlashMessageSession();
                    $flash = $req->asMessage();
                    $flash = $req->setFlash('L\'identifiant du commentaire ne peut être vide');
                    header('Location: index.php');
                    exit();
                }
            }
        else
        {
            $req = new FlashMessageSession();
            $flash = $req->asMessage();
            $flash = $req->setFlash('Aucun identifiant de commentaire envoyé');
            header('Location: index.php');
            exit();
        }          
	}

	public function getChapterId()
	{
		if (array_key_exists('id',$_GET))
            {
                if (!empty($_GET['id']))
                {
                    if (ctype_digit($_GET['id']))
                    {
                        $chapterManager = new ChapterManager();
                        $chapter = $chapterManager->getChapter($_GET['id']);
                        if ($chapter == TRUE)
                        {
                            return $chapter;
                        }
                        else
                        {
                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash('Le chapitre demandé n\'existe pas');
                            header('Location: index.php');
                            exit();
                        }
                    }
                    else
                    {
                        $req = new FlashMessageSession();
                        $flash = $req->asMessage();
                        $flash = $req->setFlash('L\'identifiant d\'un chapitre doit être un nombre entier');
                        header('Location: index.php');
                        exit(); 
                    }
                }
                else
                {
                    $req = new FlashMessageSession();
                    $flash = $req->asMessage();
                    $flash = $req->setFlash('L\'identifiant du chapitre ne peut être vide');
                    header('Location: index.php');
                    exit();
                }
            }
        else
        {
            $req = new FlashMessageSession();
            $flash = $req->asMessage();
            $flash = $req->setFlash('Aucun identifiant de chapitre envoyé');
            header('Location: index.php');
            exit();
        }          
	}
}