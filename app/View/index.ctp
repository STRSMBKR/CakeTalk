<h2>掲示板</h2>
<ul>
<?php foreach($posts as $post) : ?>
<li>
<?php
debug($post);
?>
</li>
<?php endforeach; ?>
</ul>