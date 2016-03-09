<?php if ($scratch_card['frontimg']['value']['main']['url'] && $scratch_card['backimage']['value']['main']['url']) : ?>
<section class="scratch_card">
<div id="scratch_card-<?=$index;?>">
<iframe width="90%" height=300
    layout="responsive"
    frameborder="0"
    src="/article/scratch_card/<?=$article_id?>?index=<?=$index;?><?php if ($preview) { echo '&preview=1'; };?>">
</iframe>
</div>
</section>
<?php endif; ?>
