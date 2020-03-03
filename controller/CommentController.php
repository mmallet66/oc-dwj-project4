<?php

class CommentController
{
  public $commentManager;
  public $comment;

  public function __construct()
  {
    $this->commentManager = new CommentManager();
    $this->comment = new Comment();
  }

  public function reportComment(int $commentId)
  {
    $this->comment->hydrate($this->commentManager->getComment($commentId));
    if(!$this->comment->getId())
    {
      throw new Exception("Une erreur est survenue");
    }
    $this->comment->setReported(1);
    $this->commentManager->updateComment($this->comment);

    header("Location: index.php?action=read-chapter&chapterId=" . $this->comment->getChapterId());
  }
}