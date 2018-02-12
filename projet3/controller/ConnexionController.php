<?php



class ConnexionController 
{
function connexion()
    {
    	require('view/connexionView.phtml');
    }

function deconnexion()
    {
        session_unset();
    	session_destroy();
        header('location: index2.php');
        exit;

    }

function verifyController()
    {
        $userManager = new VerifyManager();
        $user = $userManager->verifModel($_POST['login'], $_POST['pass']);
        
        
        if (!$user)  
        {
            $_SESSION['user'] = FALSE;
            echo "Mot de passe ou identifiant erroné, vérifiez";
        }
        
        else 
        {  
        $user = new UserController();
        $sign = $user->signIn();
        echo 'Vous êtes connecté';

        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters();

        $commentsManager = new CommentManager();
        $listcomments = $commentsManager->getCommentsAdmin();
        
        require('view/adminView.phtml');     
        }  	
    }
}