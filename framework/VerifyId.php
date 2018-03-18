<?php

class VerifyId
{
	public function getCommentId()
	{
		$verif = new CommentManager;
		$comment = $verif-> getComment($commentId);
		if (isset($_GET['id']))
		{
			if (array_key_exists($_GET['id']))
			{
				if (!empty($_GET['id']))
				{
					if (ctype_digit($_GET['id']))
					{
						return $commentId;
					}
				}
			}
		}
		else
		{
			echo 'Aucun identifiant de commentaire envoyé';
		}
	}
}