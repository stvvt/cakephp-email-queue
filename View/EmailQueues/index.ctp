<?php $this->extend('/Layouts/Content/container')?>


<div class="emailQueues index">
    <h2><?php echo __('Email Queue'); ?></h2>

    <?php $this->Paginator->options(array('url'=>$this->request->params['named']+$this->request->params['pass']))?>
    <?php echo $this->element('pagination'); ?>
    <div class="pull-right">
        <?php echo $this->element('paging', array('format'=>'Page %page% of %pages%, total %count% record(s)')); ?>
    </div>

    <?php echo $this->Form->create(null,
        array(
           'inputDefaults' => array(
               'required'=>false,
            ),
           'url' => array('action'=>'filter'),
        )
    ); ?>

    <table class="table table-striped text-sm">
        <colgroup>
            <col width="1%" />
            <col />
            <col />
            <col width="1%" />
            <col width="1%" />
        </colgroup>
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('id'); ?></th>
            <th><?php echo $this->Paginator->sort('to', __('To')); ?></th>
            <th>
                <?php echo $this->Paginator->sort('subject', __('Subject')); ?><br/>
                (<?php echo $this->Paginator->sort('template'); ?>, <?php echo $this->Paginator->sort('format'); ?>)
            </th>
            <th><?php echo $this->Paginator->sort('created'); ?></th>
            <th><?php echo $this->Paginator->sort('send_at'); ?></th>
            <th></th>
        </tr>

        <tr>
            <th>
                <?php
                    $options = array(EmailQueue::EMAIL_STATUS_SENT, EmailQueue::EMAIL_STATUS_SENDING, EmailQueue::EMAIL_STATUS_ERROR, EmailQueue::EMAIL_STATUS_PENDING);
                    $options = array_combine($options, $options);
                    echo $this->Form->input('EmailQueue.status',
                    array(
                        'options' => $options,
                        'empty' => __('Please Select ...'),
                        'div'=>false,
                    )
                ); ?>
            </th>

            <th>
             <?php echo $this->Form->input('EmailQueue.to',
                array('required' => false,
                'div'=>false,
                )); ?>
            </th>

            <th>
                <?php
                    $options = array(
                        EmailQueue::EMAIL_TEMPLATE_AUCTION_BIDDER_AUCTION_FINISHED,
                        EmailQueue::EMAIL_TEMPLATE_AUCTION_LOSER_WINNER_SELLECTED,
                        EmailQueue::EMAIL_TEMPLATE_AUCTION_OWNER_AUCTION_FINISHED,
                        EmailQueue::EMAIL_TEMPLATE_AUCTION_RELEVANT_ACTIVATED,
                        EmailQueue::EMAIL_TEMPLATE_AUCTION_WINNER_WINNER_SELLECTED,
                        EmailQueue::EMAIL_TEMPLATE_CRM_APPROVED,
                        EmailQueue::EMAIL_TEMPLATE_CRM_COMPANY_CONFIRMED,
                        EmailQueue::EMAIL_TEMPLATE_CRM_FORGOT_PASSWORD,
                        EmailQueue::EMAIL_TEMPLATE_CRM_JOIN_REQUEST,
                        EmailQueue::EMAIL_TEMPLATE_CLIENT_WELLCOME,
                        EmailQueue::EMAIL_TEMPLATE_CLIENT_INVITATION,
                    );
                    $options = array_combine($options, ($options));
                    echo $this->Form->input('EmailQueue.template',
                    array(
                        'options' => $options,
                        'empty' => __('Please Select ...'),
                        'div'=>false,
                    )
                ); ?>
            </th>

            <th colspan="">
                <?php echo $this->Form->button($this->Html->icon('filter') . __('Filter'),
                    array('class'=>'btn btn-primary', 'type'=>'submit')) ?>
             </th>

             <th colspan="2">
                <?php echo $this->Html->link('RESET', array('action' => 'index')); ?>
            </th>
        </tr>
        </thead>

        <?php foreach ($emailQueues as $r): ?>
        <tr>
            <td nowrap="nowrap">
                <?php echo $this->Html->link($r['EmailQueue']['id'],array('action'=>'view', $r['EmailQueue']['id']) ); ?>
                <?php echo $this->element('email_status', compact('r'));?>
            </td>

            <td>
                <?php if ($r['EmailQueue']['to_name'] != $r['EmailQueue']['to']) : ?>
                    <?php echo h($r['EmailQueue']['to_name']) .'<br>'; ?>
                <?php endif; ?>
                <?php echo h($r['EmailQueue']['to']); ?>
            </td>

            <td>
                <?php echo h($r['EmailQueue']['subject']); ?><br/>
                (<?php echo h($r['EmailQueue']['template']); ?>, <?php echo h($r['EmailQueue']['format']); ?>)
            </td>
            <td nowrap="nowrap">
                <?php
                    echo $this->Time->niceShort(h($r['EmailQueue']['created']), new DateTimeZone(date_default_timezone_get()));
                ?>
            </td>
            <td nowrap="nowrap">
                <?php if ($r['EmailQueue']['sent']) : ?>
                    <?php
                        // $r['EmailQueue']['send_at'] is GMT (UTC) date. We need to convert it to default timezone
                        $_tzSentAt = new DateTime($r['EmailQueue']['send_at'], new DateTimeZone('UTC'));
                        $_tzSentAt->setTimezone(new DateTimeZone(date_default_timezone_get()));

                        echo $this->Time->niceShort($_tzSentAt);
                    ?>
                <?php endif; ?>
            </td>

            <?php
                $a = $this->element('email_status', compact('r'));
                if ( strpos($a, 'error') )
                {
                    echo '<td>';
                        echo $this->Html->link('resend', array('action'=>'resetEmailStats', $r['EmailQueue']['id']));
                    echo '</td';
                }
            ?>

        </tr>
    <?php endforeach; ?>

    </table>

    <?php echo $this->Form->end(false /* do not submit hidden referrer field */);?>

    <?php echo $this->element('pagination'); ?>
    <div class="pull-right">
        <?php echo $this->element('paging', array('format'=>'Page %page% of %pages%, total %count% record(s)')); ?>
    </div>

</div>

