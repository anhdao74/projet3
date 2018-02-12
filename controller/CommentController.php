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

        require ('view/adminView.phtml');

        
    }

function comment()
    {
        $db = Db::getConnexionPDO();
        $commentManager = new CommentManager($db); 
        if (isset($_GET['id']) > 0)
        {
            $comment = $commentManager->getComment($_GET['id']);
        }
        else 
        {
            throw new Exception('Aucun identifiant de commentaire envoyé');
        }

        require ('view/chapterView.phtml');
    }

function addComment()
    {
        $commentManager = new CommentManager(); 

        if (isset($_POST['id']))
                {
                if (!empty($_POST['author']) && !empty($_POST['content']))
                {
                    $affectedLines = $commentManager->postComment($_POST['id'], $_POST['author'], $_POST['content']);
                    
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
    header('Location: index2.php?action=chapter&id=' . $_POST['id']);
    }


    function removeComment($id)
    {
        $db = Db::getConnexionPDO();
        $commentManager = new CommentManager($db); 
        $comment= $commentManager->getComments($chapterId);
        $removeLine=$commentManager->cancelComment($id);
        require ('view/adminView.phtml');
        echo 'La suppression a bien été exécutée';
    }

    function signaledComment()
    {
        $commentManager = new CommentManager();
        $comment = $commentManager-> getComment($chapterId);
        $signalComment = $comment->getSignaledComment($signaled);
        if($signalComment == "1")
        {
            header('Location: index2.php?action=chapter&id=' . $_POST['id']);
            echo 'Votre signalement a bien été envoyé';
        }
        else
        {
            require ('view/chapterView.phtml');
        }

          
    }
}