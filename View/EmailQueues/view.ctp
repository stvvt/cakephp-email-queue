<?php $this->extend('/Layouts/Content/container')?>

<h3> <?php echo $data['EmailQueue']['to'] ?></h3>

<h3> <?php echo $data['EmailQueue']['subject']; ?> </h3>

<p> <pre> <?php echo $email_text['message'];?> </pre></p>

<dl class='dl-horizontal'>
    <dt><?php echo __('id'); ?></dt>
        <dd><?php echo $this->Html->link($data['EmailQueue']['id'],array('action'=>'view', $data['EmailQueue']['id']) ); ?>&nbsp;</dd>

    <dt><?php echo __('to'); ?></dt>
        <dd><?php echo $data['EmailQueue']['to_name'] .'<br>'. $data['EmailQueue']['to']; ?>&nbsp;</dd>

    <dt><?php echo __('subject'); ?></dt>
        <dd><?php echo $data['EmailQueue']['subject']; ?>&nbsp;</dd>

    <dt><?php echo __('template'); ?></dt>
        <dd><?php echo $data['EmailQueue']['template']; ?>&nbsp;</dd>

    <dt><?php echo __('format'); ?></dt>
        <dd><?php echo $data['EmailQueue']['format']; ?>&nbsp;</dd>

    <dt><?php echo __('sent / locked / send_tries'); ?></dt>
        <dd><?php echo $data['EmailQueue']['sent'].' / '.$data['EmailQueue']['locked'].' / '.$data['EmailQueue']['send_tries']; ?>&nbsp;</dd>

    <dt><?php echo __('send_at'); ?></dt>
          <dd><?php echo $this->Time->niceShort($data['EmailQueue']['send_at']); ?>&nbsp;</dd>

    <dt><?php echo __('created'); ?></dt>
        <dd><?php echo $this->Time->niceShort($data['EmailQueue']['created']); ?>&nbsp;</dd>

    <dt><?php echo __('modified'); ?></dt>
        <dd><?php echo $this->Time->niceShort($data['EmailQueue']['modified']); ?>&nbsp;</dd>
</dl>

<h3><?php echo __('Headers'); ?></h3>

<pre><?php echo $email_text['headers'];?></pre>