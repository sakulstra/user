<div class="groups index row">
    <div class="table-responsive col-lg-9">
        <h2><?php echo __('Groups'); ?></h2>
        <table class="table">
        <tr>
                <th><?php echo $this->Paginator->sort('id'); ?></th>
                <th><?php echo $this->Paginator->sort('name'); ?></th>
                <th><?php echo $this->Paginator->sort('created'); ?></th>
                <th><?php echo $this->Paginator->sort('modified'); ?></th>
                <th class="actions"><?php echo __('Actions'); ?></th>
        </tr>
        <?php foreach ($groups as $group): ?>
        <tr>
            <td><?php echo h($group['Group']['id']); ?>&nbsp;</td>
            <td><?php echo h($group['Group']['name']); ?>&nbsp;</td>
            <td><?php echo h($group['Group']['created']); ?>&nbsp;</td>
            <td><?php echo h($group['Group']['modified']); ?>&nbsp;</td>
            <td class="actions">
                <?php echo $this->Html->link(__('View'), array('action' => 'view', $group['Group']['id'])); ?>
                <?php //echo $this->Html->link(__('Edit'), array('action' => 'edit', $group['Group']['id'])); ?>
                <?php //echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $group['Group']['id']), null, __('Are you sure you want to delete # %s?', $group['Group']['id'])); ?>
            </td>
        </tr>
    <?php endforeach; ?>
        </table>
    </div>
    <div class="actions col-lg-3">
        <h3><?php echo __('Actions'); ?></h3>
        <ul class="list-group">
            <!--		<li>--><?php //echo $this->Html->link(__('New Group'), array('action' => 'add')); ?><!--</li>-->
            <li class="list-group-item"><?php echo $this->Html->link(__('List Users'), array('controller' => 'users', 'action' => 'index')); ?> </li>
            <!--		<li>--><?php //echo $this->Html->link(__('New User'), array('controller' => 'users', 'action' => 'add')); ?><!-- </li>-->
        </ul>
    </div>
</div>

