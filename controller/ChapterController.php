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

            require ('view/connexionView.phtml');

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
                header('Location: index.php?action=showAdmin');
                exit();
            }  
            else
            {
                $chapterManager = new ChapterManager();
                $chapter = $chapterManager->getChapter($_GET['id']);
                
                require ('view/editChapterView.phtml');    
            }
        } 

    }

function removeChapter()
    {
        $chapterManager = new ChapterManager();
        $chapters=$chapterManager->getChapters();
        $removeLine=$chapterManager->cancelChapter($_GET['id']);
        header('Location: index.php?action=showAdmin');
        exit();
    }
}