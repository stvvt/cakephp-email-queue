<div class="emailQueues index">
    <h2><?php echo __('Email Queues'); ?></h2>
    <table cellpadding="0" cellspacing="0">
    <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('to'); ?></th>

            <th><?php echo $this->Paginator->sort('subject'); ?></th>

            <th><?php echo $this->Paginator->sort('template'); ?></th>

            <th><?php echo $this->Paginator->sort('format'); ?></th>
            <th><?php echo $this->Paginator->sort('sent/locked/ send_tries'); ?></th>
            <th><?php //echo $this->Paginator->sort('locked'); ?></th>
            <th><?php //echo $this->Paginator->sort('send_tries'); ?></th>
            <th><?php echo $this->Paginator->sort('send_at'); ?></th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('modified'); ?></th>
            <th class="actions"><?php echo __('Actions'); ?></th>
    </tr>
    <?php foreach ($emailQueues as $emailQueue): ?>
    <tr>
        <td><?php echo h($emailQueue['EmailQueue']['id']); ?>&nbsp;</td>
        <td><?php echo h($emailQueue['EmailQueue']['to_name']) .'<br>'. h($emailQueue['EmailQueue']['to']); ?>&nbsp;</td>
        <td><?php echo h($emailQueue['EmailQueue']['subject']); ?>&nbsp;</td>
        <td><?php echo h($emailQueue['EmailQueue']['template']); ?>&nbsp;</td>
        <td><?php echo h($emailQueue['EmailQueue']['format']); ?>&nbsp;</td>
        <td><?php echo h($emailQueue['EmailQueue']['sent']).' / '.h($emailQueue['EmailQueue']['locked']).' / '.h($emailQueue['EmailQueue']['send_tries']); ?>&nbsp;</td>
        <td><?php echo $this->Time->niceShort(h($emailQueue['EmailQueue']['send_at'])); ?>&nbsp;</td>
        <td><?php echo $this->Time->niceShort(h($emailQueue['EmailQueue']['created'])); ?>&nbsp;</td>
        <td><?php echo $this->Time->niceShort(h($emailQueue['EmailQueue']['modified'])); ?>&nbsp;</td>
    </tr>
<?php endforeach; ?>
    </table>

    <div class="paging">
    <?php
        echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
        echo $this->Paginator->numbers(array('separator' => ''));
        echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
    ?>
    </div>
</div>
<div class="actions">
    <h3><?php echo __('Actions'); ?></h3>
    <ul>
        <li><?php echo $this->Html->link(__('New Email Queue'), array('action' => 'add')); ?></li>
    </ul>
</div>
