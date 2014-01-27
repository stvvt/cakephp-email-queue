<?php $this->extend('/Layouts/Content/container')?>


<dl>
    <dt><?php echo 'id'; ?></dt>
        <dd><?php echo $this->Html->link($data['EmailQueue']['id'],array('action'=>'view', $data['EmailQueue']['id']) ); ?>&nbsp;</dd>

    <dt><?php echo 'to'; ?></dt>
        <dd><?php echo $data['EmailQueue']['to_name'] .'<br>'. $data['EmailQueue']['to']; ?>&nbsp;</dd>

    <dt><?php echo 'subject'; ?></dt>
        <dd><?php echo $data['EmailQueue']['subject']; ?>&nbsp;</dd>

    <dt><?php echo 'template'; ?></dt>
        <dd><?php echo $data['EmailQueue']['template']; ?>&nbsp;</dd>

    <dt><?php echo 'format'; ?></dt>
        <dd><?php echo $data['EmailQueue']['format']; ?>&nbsp;</dd>

    <dt><?php echo 'sent / locked / send_tries'; ?></dt>
        <dd><?php echo $data['EmailQueue']['sent'].' / '.$data['EmailQueue']['locked'].' / '.$data['EmailQueue']['send_tries']; ?>&nbsp;</dd>



    <dt><?php echo 'send_at'; ?></dt>
          <dd><?php echo $this->Time->niceShort($data['EmailQueue']['send_at']); ?>&nbsp;</dd>

    <dt><?php echo 'created'; ?></dt>
        <dd><?php echo $this->Time->niceShort($data['EmailQueue']['created']); ?>&nbsp;</dd>

    <dt><?php echo 'modified'; ?></dt>
        <dd><?php echo $this->Time->niceShort($data['EmailQueue']['modified']); ?>&nbsp;</dd>

</dl>


<p> <pre> <?php echo $email_text['headers'];?> </pre></p>

<p> <pre> <?php echo $email_text['message'];?> </pre></p>