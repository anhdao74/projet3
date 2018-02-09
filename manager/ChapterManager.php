<?php



class ChapterManager extends Manager
{
	public function getChapters()
	{
	    $req = $this ->pdo-> query('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters ORDER BY id');

	    return $req;
	}

	public function getChapter($chapterId)
	{
	    $req= $this ->pdo-> prepare('SELECT id, title, content, DATE_FORMAT(creation_date, \'%d/%m/%Y à %Hh%imin%ss\') AS creation_date_fr FROM chapters WHERE id=?');
	    $req-> execute(array($chapterId));
	    $chapter=$req-> fetch();
	    
	    return $chapter;
	}

	public function postChapter($title, $content)
	{
	    $chapter= $this ->pdo->prepare('INSERT INTO chapters(title, content, creation_date) VALUES (?,?,NOW())');
	    $affectedLines=$chapter -> execute(array($title, $content));
	    return $affectedLines;
	}

	public function modifyChapter($chapterId, $newtitle, $newcontent)
	{
	    $chapter= $this ->pdo->prepare('UPDATE chapters SET title = :newtitle, content= :newcontent WHERE id= :id');
	    $editedLines=$chapter->execute(array('id'=>$chapterId, 'newtitle'=>$newtitle,'newcontent'=>$newcontent));
	    return $editedLines;
	}

	public function cancelChapter($chapterId)
	{
	    $chapter= $this ->pdo->prepare('DELETE FROM chapters WHERE id=?');
	    $removeLine=$chapter-> execute(array($chapterId ));
	    return $removeLine;
	}

}