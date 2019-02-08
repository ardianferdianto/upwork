<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Date $date
 */
?>
<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $date->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $date->id)]
            )
        ?></li>
        <li><?= $this->Html->link(__('List Dates'), ['action' => 'index']) ?></li>
    </ul>
</nav>
<div class="dates form large-9 medium-8 columns content">
    <?= $this->Form->create($date) ?>
    <fieldset>
        <legend><?= __('Edit Date') ?></legend>
        <?php
            echo $this->Form->control('date_from');
            echo $this->Form->control('date_to');
            echo $this->Form->control('difference');
        ?>
    </fieldset>
    <?= $this->Form->button(__('Submit')) ?>
    <?= $this->Form->end() ?>
</div>
