<?php

class Routeur
{
    public function getAction()
    {
    try

    {

        if (isset($_GET['action'])) 

        {
            if ($_GET['action'] == 'showHome') 
            { 
                $controller = new HomeController;
                
                return [$controller, 'showHome'];
            
            }

            elseif ($_GET['action'] == 'chapter') 
            {
                $controller = new HomeController;
                
                return [$controller, 'chapter'];
            }

            elseif ($_GET['action'] == 'comment') 
            {
                $ommentController = new CommentController;
                
                return [$commentController, 'comment'];
            }

            elseif ($_GET['action'] == 'listCommentsAdmin') 
            {
                $ommentController = new CommentController;
                
                return [$commentController, 'listCommentsAdmin'];
            }

            elseif ($_GET['action'] == 'connexion') 
            {
                $connexionController = new ConnexionController;

                return [$connexionController, 'connexion'];
            }

            elseif ($_GET['action'] == 'deconnexion') 
            {
                $connexionController= new ConnexionController;

                return [$connexionController, 'deconnexion'];
            }

            elseif ($_GET['action'] == 'verifyController') 
            {                 
                $connexionController = new ConnexionController;

                return [$connexionController,'verifyController'];  
                 
            }

            elseif ($_GET['action'] == 'showAdmin') 
            {                 
                $adminController = new AdminController;

                return [$adminController,'showAdmin'];  
                 
            }

            elseif ($_GET['action'] == 'addChapter') 
            {
                $chapterController = new ChapterController;

                return [$chapterController, 'addChapter'];
            }

            elseif ($_GET['action'] == 'addComment') 
            {
                $commentController = new CommentController;

                return [$commentController, 'addComment'];
            }
             
            
            elseif ($_GET['action'] == 'editChapter') 
            {
                $chapterController = new ChapterController;

                return [$chapterController, 'editChapter'];
                
            }
            elseif ($_GET['action'] == 'removeChapter') 
            {
                $chapterManager = new ChapterManager;
                $chapter=$chapterManager->getChapter($_GET['id']);

                $chapterController = new ChapterController;
                return [$chapterController, 'removeChapter'];
            }

            elseif ($_GET['action'] == 'removeComment') 
            {
                $commentManager = new CommentManager($db);
                $comment=$commentManager->getComment($_GET['id']);

                $commentController = new CommentController;
                return [$commentController, 'removeComment'];
            }

        }
        else 
        {
            $controller = new HomeController;
                
            return [$controller, 'showHome'];
        }
    }
    catch(Exception $e) 
    { // S'il y a eu une erreur, alors...
        echo 'Erreur : ' . $e->getMessage();
    }
    }
}