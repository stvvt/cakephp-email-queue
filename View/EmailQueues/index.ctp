<?php $this->extend('/Layouts/Content/container')?>


<div class="emailQueues index">
    <h2><?php echo __('Email Queue'); ?></h2>

    <?php $this->Paginator->options(array('url'=>$this->request->params['named']+$this->request->params['pass']))?>
    <?php echo $this->element('pagination'); ?>
    <div class="pull-right">
        <?php echo $this->element('paging', array('format'=>'Page %page% of %pages%, total %count% record(s)')); ?>
    </div>

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
        </tr>
        </thead>

        <?php foreach ($emailQueues as $r): ?>
        <tr>
            <td nowrap="nowrap">
                <?php echo $this->Html->link($r['EmailQueue']['id'],array('action'=>'view', $r['EmailQueue']['id']) ); ?>
                <?php echo $this->element('email_status', compact('r')); ?>
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
            <td nowrap="nowrap"><?php echo $this->Time->niceShort(h($r['EmailQueue']['created'])); ?>&nbsp;</td>
            <td nowrap="nowrap">
                <?php if ($r['EmailQueue']['sent']) : ?>
                    <?php echo $this->Time->niceShort($r['EmailQueue']['send_at'], 4); ?>
                <?php endif; ?>
            </td>
        </tr>
    <?php endforeach; ?>

    </table>

    <?php echo $this->element('pagination'); ?>
    <div class="pull-right">
        <?php echo $this->element('paging', array('format'=>'Page %page% of %pages%, total %count% record(s)')); ?>
    </div>

</div>

