<?php



class ChapterController 
{

function addChapter()
    {
        $chapterManager = new ChapterManager();
        $chapters= $chapterManager->getChapters();
		if (empty($_POST['title']) && empty($_POST['content'])) 
            {
            	throw new Exception ('Vous n\'avez pas rempli tous les champs, vérifiez');    
            }            
        else 
            {
                
                $affectedLines= $chapterManager->postChapter($_POST['title'], $_POST['content']);

                $req = new FlashMessageSession();
                $flash = $req->setFlash('Le chapitre a bien été ajouté');
            	header('Location: index.php?action=showAdmin');
               	exit();
            }    
    }
    
function editChapter()
    {
        $userSession = new UserSession();
        $logged = $userSession->isLogged();
        if ($logged===False)
        {
        $template = 'connexion';
        $title = 'Page de connexion';
        
        require('view/layoutView.phtml'); 
        }

        else
        {
         if (isset($_POST['newtitle']) && isset($_POST['newcontent']))

            
            {
                $newtitle = $_POST['newtitle'];
                $newcontent = $_POST['newcontent'];
                $chapterId = $_POST['id'];
                $chapterManager = new ChapterManager();
                $chapter= $chapterManager-> getChapter($chapterId);
                $editChapter=$chapterManager->modifyChapter($chapterId, $newtitle, $newcontent);
                $req = new FlashMessageSession();
                $message = $req->setFlash('Le chapitre a bien été modifié');
                $flash = $req->asMessage();
                header('Location: index.php?action=showAdmin');
                exit();
            }  
            else
            {
                $chapterManager = new ChapterManager();
                $chapter = $chapterManager->getChapter($_GET['id']);

                $req = new FlashMessageSession();
                $message = $req->setFlash('Votre chapitre est prêt a être modifié');
                $flash = $req->asMessage();
                
                $template = 'editChapter';
                $title = 'Page modification chapitre';
        
                require('view/layoutView.phtml');    
            }
        } 

    }

function removeChapter()
    {
        $chapterManager = new ChapterManager();
        $chapters=$chapterManager->getChapters();
        $removeLine=$chapterManager->cancelChapter($_GET['id']);

        $req = new FlashMessageSession();
        $message = $req->setFlash('Le chapitre a bien été supprimé');
        $flash = $req->asMessage();
        header('Location: index.php?action=showAdmin');
        exit();
    }
}