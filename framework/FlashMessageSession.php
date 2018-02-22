<?php

class FlashMessageSession
{
	public function __construct()
	{
		if (!isset($_SESSION))
		{
        	session_start();
    	}
		
	}

    public function setFlash($message)
    {
        $_SESSION['flash'] = $message;
        	
    }

    public function asMessage()
	{
   		if (isset($_SESSION['flash']))
   		{
   			echo $_SESSION['flash'];
   			unset ($_SESSION['flash']);
   		}   
	}
}