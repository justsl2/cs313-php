<?php
require "dbConnect.php";
$db = get_db();
$book = $_POST['bookName'];
$chapter = $_POST['chapterNum'];
$verse = $_POST['verseNum'];
$content = $_POST['content'];

$stmt = $db->prepare('insert into scripture (book, chapter, verse, content) values (:book, :chapter, :verse, :content)');
$stmt->bindValue(':book',$book); 
$stmt->bindValue(':chapter',$chapter); 
$stmt->bindValue(':verse',$verse); 
$stmt->bindValue(':content',$content); 
$stmt->execute();

$scriptureID = $db->lastInsertId("scripture_id_seq");

if (isset($_POST['topics']))
{
    $topics = $_POST['topics'];
    foreach ($topics as $topic)
    {
        $stmt = $db->prepare('insert into scripture_topic (scripture_id, topic_id) values (:scriptureID, :topicID)');
        $stmt->bindValue(':scriptureID',$scriptureID); 
        $stmt->bindValue(':topicID',$topic); 
        $stmt->execute();
    };
};

    $stmt = $db->prepare('select id, book, chapter, verse, content from scripture');
    $stmt->execute();
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC))
	{
		echo '<p>';
		echo '<strong>' . $row['book'] . ' ' . $row['chapter'] . ':';
		echo $row['verse'] . '</strong>' . ' - ' . $row['content'];
		echo '<br />';
		echo 'Topics: ';
		// get the topics now for this scripture
		$stmtTopics = $db->prepare('SELECT name FROM topic t'
			. ' INNER JOIN scripture_topic st ON st.topic_id = t.id'
			. ' WHERE st.scripture_id = :scriptureId');
		$stmtTopics->bindValue(':scriptureId', $row['id']);
		$stmtTopics->execute();
		// Go through each topic in the result
		while ($topicRow = $stmtTopics->fetch(PDO::FETCH_ASSOC))
		{
			echo $topicRow['name'] . ' ';
		}
		echo '</p>';
	}

?>
