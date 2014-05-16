<h2>記事一覧</h2>
<ul>

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

<?php
/*echo $this->Html->div(null, 'This is Ajax Result.',
	array('id'=>'res_div'));
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows'=>3));
echo $this->Js->submit('click',array('update' => '#res_div',
 'url' => array('action' => 'getAjax')));
echo $this->Form->end(null);
echo $this->Js->writeBuffer
*/
echo $this->Form->create('Post');
echo $this->Form->input('title');
echo $this->Form->input('body', array('rows'=> 3));
echo $this->Js->submit('Add',array('before' => $this->Js->get('#sending')->effect('fadeIn'),
						'success'=> $this->Js->get('#sending')->effect('fadeOut'),
						'update' => '#success'));
echo $this->Form->end();
?>

<h2>Add Post</h2>
<?php echo $this->Html->link('Add post',array('controller'=>'posts','action'=>'add'));
?>
<?php 
echo $this->Js->writeBuffer(); 
?>
<?php
echo $this->Html->div(null, 'This is Ajax Result.',
	array('id'=>'success'));

echo $this->Html->div(null, 'This is Ajax Result.',
	array('id'=>'sending'));
	?>
<script>
$(function(){
	$('a.delete').click(function(e){
		if(confirm('sure?')){
		$.post('/cakephp/posts/delete/'+$(this).data('post-id'),{},function(res){
	$('#post_'+res.id).fadeOut();
},"json");
}
	return false;
});

	});
</script>
<?php
/*
$(function(){
	$('#add').submit(function(){
	$.post('/cakephp/posts/index',{
	title:$())))

*/