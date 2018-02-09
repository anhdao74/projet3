<?php

class UserController 
{
	public function __construct()
	{
		if (!isset($_SESSION))
		{
        	session_start();
    	}
		
	}



	public function signIn()
	{
		$_SESSION['user'] = TRUE;
 
	}

	public function isLogged()
	{
		if (isset($_SESSION['user']) && $_SESSION['user'] ==TRUE)
        {
       		return TRUE;
        } 
        else
        {
         	return FALSE;
        }
         
	}
	
}