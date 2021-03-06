<?php



class ChapterController 
{

function addChapter()
    {
        $chapterManager = new ChapterManager();
        $chapters= $chapterManager->getChapters();
		if (empty($_POST['title']) && empty($_POST['content'])) 
            {
                $verif = new VerifyId();
                $chapter = $verif-> getAddChapterId(); 

                $req = new FlashMessageSession();
                $flash = $req->asMessage();
                $flash = $req->setFlash('Vous n\'avez pas rempli tous les champs');
                header('Location: index.php?action=showAdmin');
                exit();  
            }            
        else 
            {
                $affectedLines= $chapterManager->postChapter(strip_tags($_POST['title']), strip_tags($_POST['content']));

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
                $newtitle = strip_tags($_POST['newtitle']);
                $newcontent = strip_tags($_POST['newcontent']);
                $chapterId = strip_tags($_POST['id']);
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
                $verif = new VerifyId();
                $chapter = $verif-> getChapterId();

                $chapterManager = new ChapterManager();
                $chapter = $chapterManager->getChapter(strip_tags($_GET['id']));
                
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
        $verif = new VerifyId();
        $chapter = $verif-> getChapterId();

        $chapterManager = new ChapterManager();
        $chapters=$chapterManager->getChapters();
        $removeLine=$chapterManager->cancelChapter(strip_tags($_GET['id']));

        $req = new FlashMessageSession();
        $message = $req->setFlash('Le chapitre a bien été supprimé');
        $flash = $req->asMessage();
        header('Location: index.php?action=showAdmin');
        exit();
    }
}