<div id="menue" class="row">
    <div class="col-lg-12">
        <div class="btn-group">
            <?php echo $this->Html->link(__('Add User'),array('plugin'=>'user','controller'=>'users','action'=>'add'),array('class'=>"btn btn-success"));?>
            <?php echo $this->Html->link(__('List Groups'),array('plugin'=>'user','controller'=>'groups','action'=>'index'),array('class'=>"btn btn-default"));?>
        </div>
        <div class="btn-group pull-right">
            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                <a href="#"><span class="glyphicon glyphicon-list"></span> Sort by</a>
                <span class="caret"></span>
            </button>
            <ul class="dropdown-menu">
                <li><?php echo $this->Paginator->sort('username'); ?></li>
                <li><?php echo $this->Paginator->sort('email'); ?></li>
                <li><?php echo $this->Paginator->sort('group_id'); ?></li>
                <li><?php echo $this->Paginator->sort('active'); ?></li>
                <li><?php echo $this->Paginator->sort('modified'); ?></li>
                <li><?php echo $this->Paginator->sort('created'); ?></li>
            </ul>
        </div>
    </div>
</div>
<div id="menue" class="row">
    <div class="table-responsive col-lg-12">
        <table class="table table-hover">
            <tr>
                <th><?php echo $this->Paginator->sort('username'); ?></th>
                <th><?php echo $this->Paginator->sort('email'); ?></th>
                <th><?php echo $this->Paginator->sort('group_id'); ?></th>
                <th><?php echo $this->Paginator->sort('active'); ?></th>
                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
            </tr>
               <?php foreach ($users as $user): ?>
            <tr>
                <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
                <td>
                    <?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
                </td>
                <td><?php echo $user['User']['active']==1?'<span class="glyphicon glyphicon-ok"></span>':'<span class="glyphicon glyphicon-remove"></span>'; ?>&nbsp;</td>
                <td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
                <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
                <td class="actions">
                    <div class="btn-group">
                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                            <a href="#"><span class="glyphicon glyphicon-cog"></span></a>
                            <span class="caret"></span>
                        </button>
                        <ul class="dropdown-menu">
                            <li><?php echo $this->Html->link('<i class="glyphicon glyphicon-pencil"></i> '.__('Edit'),array('plugin'=>'user','controller'=>'users','action'=>'edit',$user['User']['id']),array('escape'=>false));?></li>
                            <li><?php echo $this->Form->postLink('<i class="glyphicon glyphicon-remove"></i> '.__('Delete'),array('plugin'=>'user','controller'=>'users','action'=>'delete',$user['User']['id']),array('escape'=>false), __('Are you sure you want to delete # %s?', $user['User']['id']));?></li>
                        </ul>
                    </div>
                </td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>
<?php /*
<div id="page-container">

    <div id="sidebar" class="row">

        <div class="actions" class="col-sm-12">

            <ul class="list-group">
                <?php if ($user['Group']['name'] === 'admin'): ?>
                    <li class="list-group-item"><?php echo $this->Html->link(__('New User'), array('action' => 'add'), array('class' => '')); ?></li>                <?php endif; ?>
                <li class="list-group-item"><?php echo $this->Html->link(__('List Groups'), array('controller' => 'groups', 'action' => 'index'), array('class' => '')); ?></li>
                <?php if ($user['Group']['name'] === 'admin'): ?>
                    <li class="list-group-item"><?php echo $this->Html->link(__('New Group'), array('controller' => 'groups', 'action' => 'add'), array('class' => '')); ?></li>
                <?php endif; ?>
            </ul>
            <!-- /.list-group -->

        </div>
        <!-- /.actions -->

    </div>
    <!-- /#sidebar .col-sm-3 -->

    <div id="page-content" class="row">

        <div class="users index col-sm-12">

            <h2><?php echo __('Users'); ?></h2>

            <div class="table-responsive">
                <table cellpadding="0" cellspacing="0" class="table table-striped table-bordered">
                    <thead>
                    <tr>
                        <th><?php echo $this->Paginator->sort('username'); ?></th>
                        <th><?php echo $this->Paginator->sort('email'); ?></th>
                        <th><?php echo $this->Paginator->sort('group_id'); ?></th>
                        <th><?php echo $this->Paginator->sort('active'); ?></th>
                        <th><?php echo $this->Paginator->sort('modified'); ?></th>
                        <th><?php echo $this->Paginator->sort('created'); ?></th>
                        <th class="actions"><?php echo __('Actions'); ?></th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php
                    foreach ($users as $user): ?>
                        <tr>
                            <td><?php echo h($user['User']['username']); ?>&nbsp;</td>
                            <td><?php echo h($user['User']['email']); ?>&nbsp;</td>
                            <td>
                                <?php echo $this->Html->link($user['Group']['name'], array('controller' => 'groups', 'action' => 'view', $user['Group']['id'])); ?>
                            </td>
                            <td><?php echo h($user['User']['active']); ?>&nbsp;</td>
                            <td><?php echo h($user['User']['modified']); ?>&nbsp;</td>
                            <td><?php echo h($user['User']['created']); ?>&nbsp;</td>
                            <td class="actions">
                                <?php echo $this->Html->link(__('View'), array('action' => 'view', $user['User']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                <?php if ($user['Group']['name'] === 'admin'): ?>            <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $user['User']['id']), array('class' => 'btn btn-default btn-xs')); ?>
                                    <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $user['User']['id']), array('class' => 'btn btn-default btn-xs'), __('Are you sure you want to delete # %s?', $user['User']['id'])); ?>
                                <?php endif; ?>        </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- /.table-responsive -->

            <p>
                <small>
                    <?php
                    echo $this->Paginator->counter(array(
                        'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
                    ));
                    ?>            </small>
            </p>

            <ul class="pagination">
                <?php
                echo $this->Paginator->prev('< ' . __('Previous'), array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
                echo $this->Paginator->numbers(array('separator' => '', 'currentTag' => 'a', 'tag' => 'li', 'currentClass' => 'disabled'));
                echo $this->Paginator->next(__('Next') . ' >', array('tag' => 'li'), null, array('class' => 'disabled', 'tag' => 'li', 'disabledTag' => 'a'));
                ?>
            </ul>
            <!-- /.pagination -->

        </div>
        <!-- /.index -->

    </div>
    <!-- /#page-content .col-sm-9 -->

</div><!-- /#page-container .row-fluid -->
*/