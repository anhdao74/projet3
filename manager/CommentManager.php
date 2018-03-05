<?php



class CommentManager extends Manager
{
	public function getComments($chapterId)
	{
	    $query= $this ->pdo-> prepare('SELECT id, author,content, DATE_FORMAT(add_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM comments WHERE chapterId=? ORDER BY id DESC');
	    $query->execute(array($chapterId));

	    return $query;
	}

	public function getCommentsAdmin()
	{
	    $query = $this ->pdo-> query('SELECT id, author, content, signaled, DATE_FORMAT(add_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM comments ORDER BY signaled DESC');
	    
	    return $query;
	}

	public function getSignaledComment($chapterId)
	{
	    $query = $this ->pdo-> prepare('UPDATE comments SET signaled=1 WHERE id = ?');
	    $signaled=$query-> execute(array($chapterId));
	    return $signaled;
	}

	public function getComment($chapterId)
	{
	    $req= $this->pdo-> prepare('SELECT id, author, content, DATE_FORMAT(add_date, \'%d/%m/%Y à %Hh%i\') AS creation_date_fr FROM comments WHERE id=?');
	    $req->execute(array($chapterId));
        $comment = $req->fetch();
	    
	    return $comment;
	}

	public function postComment($chapterId, $author, $content)
	{
	    $query= $this ->pdo->prepare('INSERT INTO comments(chapterId, author, content, add_date) VALUES (?,?,?,NOW())');
	    $affectedLines=$query -> execute(array($chapterId, $author, $content));
	    return $affectedLines;
	}

	public function cancelComment($chapterId)
	{
	    $query= $this ->pdo->prepare('DELETE FROM comments WHERE id=?');
	    $removeLine=$query-> execute(array($chapterId));
	    return $removeLine;
	}

}