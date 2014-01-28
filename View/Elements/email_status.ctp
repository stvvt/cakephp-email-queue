<span class="status">
    <?php if ($r['EmailQueue']['sent']) : ?>
        <span class="label label-success"><?php echo __('sent')?>
    <?php elseif ($r['EmailQueue']['locked']) : ?>
        <span class="label label-warning"><?php echo __('sending')?>
    <?php elseif ($r['EmailQueue']['send_tries'] >= 4) : ?>
        <span class="label label-danger"><?php echo __('error')?>
    <?php else : ?>
        <span class="label label-default">
            <?php echo __('pending')?>
    <?php endif;?>

    <?php if ($r['EmailQueue']['send_tries'] > 0) : ?>
        (<?php echo $r['EmailQueue']['send_tries']?>)
    <?php endif; ?>
    </span>
</span>