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

  public function postNewComment (array $commentData)
  {
    $this->comment->hydrate($commentData);
    $affectedLine = $this->commentManager->addComment($this->comment);
    if(!$affectedLine):
      throw new Exception("Le commentaire n'a pu être enregistré");
    endif;

    header("Location: index.php?action=read-chapter&chapterId=" . $this->comment->getChapterId());
  }

  public function reportComment(int $commentId)
  {
    $this->comment->hydrate($this->commentManager->getComment($commentId));
    if(!$this->comment->getId())
    {
      throw new Exception("Une erreur est survenue");
    }

    $this->commentManager->updateOfCommentReportingField($this->comment->getId(), 1);

    header("Location: index.php?action=read-chapter&chapterId=" . $this->comment->getChapterId());
  }
}