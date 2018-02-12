<?php



class CommentManager extends Manager
{
	public function getComments($chapterId)
	{
	    $comments= $this ->pdo-> prepare('SELECT id, author,content, DATE_FORMAT(add_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comments WHERE chapterId=? ORDER BY id DESC');
	    $comments->execute(array($chapterId));

	    return $comments;
	}

	public function getCommentsAdmin()
	{
	    $list = $this ->pdo-> query('SELECT id, author, content, DATE_FORMAT(add_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comments ORDER BY id DESC');

	    return $list;
	}

	public function getSignaledComment($signaled)
	{
	    $comment = $this ->pdo-> execute('UPDATE comments SET signaled = "1" WHERE id = ?');
	    $signaled=$comment-> execute(array($signaled));
	    return $signaled;
	}

	public function getComment($chapterId)
	{
	    $req= $this->pdo-> prepare('SELECT id, author, content, DATE_FORMAT(add_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM comments WHERE id=?');
	    $req->execute(array($chapterId));
        $comment = $req->fetch();
	    
	    return $comment;
	}

	public function postComment($chapterId, $author, $content)
	{
	    $comment= $this ->pdo->prepare('INSERT INTO comments(chapterId, author, content, add_date) VALUES (?,?,?,NOW())');
	    $affectedLines=$comment -> execute(array($chapterId, $author, $content));
	    return $affectedLines;
	}

	public function cancelComment($chapterId)
	{
	    $comment= $this ->pdo->prepare('DELETE FROM comments WHERE id=?');
	    $removeLine=$comment-> execute(array($chapterId ));
	    return $removeLine;
	}

}