<!--送信完了メッセージ-->
メッセージが送信されました。
<?php foreach($posts as $post) : ?>
<li id = "post_<?php echo h($post['Post']['id']); ?>">
<?php
//debug($post);
//echo h($post['Post']['title']);
echo $this->Html->link($post['Post']['title'],'/posts/view/'.$post['Post']['id']);
?>
<?php
//echo $this->Html->link('編集',array('action'=>'edit',$post['Post']['id'])); 
echo $this->Html->link('削除', '#', array('class'=>'delete', 'data-post-id'=>$post['Post']['id']));
?></li>

<?php endforeach; ?>
</ul>