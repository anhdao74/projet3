<?php



class CommentController 
{

function listComments()
    {
        $db = Db::getConnexionPDO();
        $commentManager = new CommentManager($db); 
	    $comments = $commentManager->getComments($chapterId); 

	    
    }

function listCommentsAdmin()
    {
        $commentManager = new CommentManager(); 
        $listcomments = $commentManager->getCommentsAdmin(); 

        $template = 'admin';
        $title = 'Page administration';
        
        require('view/layoutView.phtml');

        
    }

function addComment()
    {
        $commentManager = new CommentManager(); 

        if (isset($_POST['id']))
                {
                if (!empty($_POST['author']) && !empty($_POST['content']))
                {
                    $affectedLines = $commentManager->postComment(strip_tags($_POST['id']),strip_tags($_POST['author']), ($_POST['content']));
                    $req = new FlashMessageSession();
                    $message = $req->setFlash('Votre commentaire a bien été ajouté');
                    $flash = $req->asMessage();
                }
                else 
                {
                    throw new Exception('Tous les champs ne sont pas remplis !');
                }
                }
        else 
        {
            throw new Exception('Aucun identifiant de billet envoyé');
        }
    header('Location: index.php?action=chapter&id=' . strip_tags($_POST['id']));
    exit();
    }


    function removeComment()
    {
        $commentManager = new CommentManager();  
        $removeLine=$commentManager->cancelComment(strip_tags($_GET['id']));
        if ($removeLine)
        {
            if (isset($_GET['id']))
            {
               $_GET['id'] = (int) $_GET['id'];
               if ($_GET['id'] >= 1 AND $_GET['id'] <=500)
               {
                    $req = new FlashMessageSession();
                    $flash = $req->asMessage();
                    $flash = $req->setFlash('Le commentaire a bien été supprimé');
                    header('Location: index.php?action=showAdmin');
                    exit();
                }  
            }
        }
        else 
        {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }
    }

    function signaledComment()
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
                            $signaled = $commentManager->getSignaledComment(strip_tags($_GET['id']));

                            $req = new FlashMessageSession();
                            $flash = $req->asMessage();
                            $flash = $req->setFlash('Votre message a bien été signalé');
                            
                            header('Location: index.php?action=chapter&id=' . strip_tags($comment['chapterId']));
                            exit();
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
                    $flash = $req->setFlash('L\'identifiant ne peut être vide');
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
}
