<?php



class ConnexionController 
{
function connexion()
    {
    	$user = new UserSession();
        $sign = $user->signIn();
        
        $template = 'connexion';
        $title = 'Page de connexion';
        
        require('view/layoutView.phtml');
    }

function deconnexion()
    {
        $user = new UserSession();
        $sign = $user->logOut();
    	session_destroy();
        header('location: index.php');
        exit();

    }

function verifyController()
    {
        $userManager = new ConnexionManager();
        $user = $userManager->verifModel($_POST['login'], $_POST['pass']);
        
        
        if (!$user)  
        {
            $_SESSION['user'] = FALSE;

            $req = new FlashMessageSession();
            $flash = $req->setFlash('Mot de passe ou identifiant erroné, vérifiez');

            $template = 'connexion';
            $title = 'Page de connexion';
        
            require('view/layoutView.phtml');

        }
        
        else 
        {  
        $user = new UserSession();
        $sign = $user->signIn();
        
        $req = new FlashMessageSession();
        $flash = $req->setFlash('Vous êtes connecté');

        $chapterManager = new ChapterManager();
        $chapters = $chapterManager->getChapters();

        $commentsManager = new CommentManager();
        $listcomments = $commentsManager->getCommentsAdmin();
        
        $template = 'admin';
        $title = 'Page administration';
        
        require('view/layoutView.phtml');    
        }  	
    }
}