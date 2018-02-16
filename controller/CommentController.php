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
        $commentManager = new CommentManager(); 
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
    header('Location: index.php?action=chapter&id=' . $_POST['id']);
    exit();
    }


    function removeComment()
    {
        $commentManager = new CommentManager(); 
        
        $removeLine=$commentManager->cancelComment($_GET['id']);
        header('Location: index.php?action=showAdmin');
        exit();
    }

    function signaledComment()
    {
        $commentManager = new CommentManager();
        $comment = $commentManager-> getComment($chapterId);
        $signaled = $commentManager->getSignaledComment($_GET['id']);
        header('Location: index.php?action=chapter&id=' . $_POST['id']);
        exit();  
    }
}