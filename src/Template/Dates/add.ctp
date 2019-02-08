<nav class="large-3 medium-4 columns" id="actions-sidebar">
    <ul class="side-nav">
        <li class="heading"><?= __('Actions') ?></li>
        <li><?= $this->Html->link(__('New Date'), ['action' => 'add']) ?></li>
    </ul>
</nav>
<div class="dates index large-9 medium-8 columns content">
    <h3><?= __('Dates') ?></h3>
    <table cellpadding="0" cellspacing="0">
        <thead>
        <tr>
            <th scope="col"><?= $this->Paginator->sort('id') ?></th>
            <th scope="col"><?= $this->Paginator->sort('date_from') ?></th>
            <th scope="col"><?= $this->Paginator->sort('date_to') ?></th>
            <th scope="col"><?= $this->Paginator->sort('difference') ?></th>
            <th scope="col"><?= $this->Paginator->sort('created') ?></th>
            <th scope="col"><?= $this->Paginator->sort('modified') ?></th>
            <th scope="col" class="actions"><?= __('Actions') ?></th>
        </tr>
        </thead>
        <tbody>
        <?php foreach ($dates as $date): ?>
            <tr>
                <td><?= $this->Number->format($date->id) ?></td>
                <td><?= h($date->date_from) ?></td>
                <td><?= h($date->date_to) ?></td>
                <td><?= $this->Number->format($date->difference) ?></td>
                <td><?= h($date->created) ?></td>
                <td><?= h($date->modified) ?></td>
                <td class="actions">
                    <?= $this->Html->link(__('View'), ['action' => 'view', $date->id]) ?>
                    <?= $this->Html->link(__('Edit'), ['action' => 'edit', $date->id]) ?>
                    <?= $this->Form->postLink(__('Delete'), ['action' => 'delete', $date->id], ['confirm' => __('Are you sure you want to delete # {0}?', $date->id)]) ?>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
    <div class="paginator">
        <ul class="pagination">
            <?= $this->Paginator->first('<< ' . __('first')) ?>
            <?= $this->Paginator->prev('< ' . __('previous')) ?>
            <?= $this->Paginator->numbers() ?>
            <?= $this->Paginator->next(__('next') . ' >') ?>
            <?= $this->Paginator->last(__('last') . ' >>') ?>
        </ul>
        <p><?= $this->Paginator->counter(['format' => __('Page {{page}} of {{pages}}, showing {{current}} record(s) out of {{count}} total')]) ?></p>
    </div>
</div>

<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\Date $date
 */

?>
<div class="row">
    <div class="col-lg-8">
        <div class="card">
            <div class="card-header">
                Find Date Difference
            </div>
            <div class="card-body">
                <?= $this->Form->create($date,['url' => false, "id" => 'form_count']) ?>
                <div class="form-row">
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="Name">From</label>
                        <input class="form-control form-count" type="date" name="date_from">
                    </div>
                    <div class="form-group col-md-6">
                        <label class="col-form-label" for="Password">To</label>
                        <input class="form-control form-count" type="date" name="date_to">
                    </div>
                </div>
                <div class="form-row">

                </div>
                <div class="form-row">
                    <div class="form-group col-md-12">
                        <label class="col-form-label" for="Password">Difference (In days)</label>
                        <input class="form-control form-count" type="text" name="difference">
                    </div>
                </div>
                <button class="btn btn-primary" type="button" id="count">
                    <span class="spinner-border spinner-border-sm loader" role="status" aria-hidden="true"></span>
                    Count
                </button>
                <button class="btn btn-danger" type="button" id="save" style="display:none;">
                    <span class="spinner-border spinner-border-sm loader" role="status" aria-hidden="true"></span>
                    Save Result
                </button>
                <?= $this->Form->end() ?>
                <div class="input-group">

                </div>
            </div>
        </div>
    </div>

    <div class="list-group col-lg-4">
        <a href="#" class="list-group-item list-group-item-action active">
            Cras justo odio
        </a>
        <a href="#" class="list-group-item list-group-item-action">Dapibus ac facilisis in</a>
        <a href="#" class="list-group-item list-group-item-action">Morbi leo risus</a>
        <a href="#" class="list-group-item list-group-item-action">Porta ac consectetur ac</a>
        <a href="#" class="list-group-item list-group-item-action disabled">Vestibulum at eros</a>
    </div>
</div>


<script>
    $(document).ready(function(){
        $("#save").on('click', function () {
            $('#form_count').attr('action', '/dates/add');
            $('#form_count').submit();
        });

        $("#count").on('click', function(e){
            date_from = $('input[name=date_from]').val();
            date_to = $('input[name=date_to]').val();

            $.ajax({
                url: "/dates/count",
                type: 'POST',
                data:
                    $('#form_count').serialize()
                ,
                beforeSend: function() {
                    $('.loader').fadeIn();
                    $('.form-count').attr('disabled', true);
                },
                error: function() {
                    alert("Error On request");
                },
                dataType: 'json',
                success: function(data) {
                    $('input[name=difference]').val(data);
                },
                complete: function(){
                    $('.form-count').attr('disabled', false);
                    $('.loader').fadeOut('slow');
                    $('#save').fadeIn('slow');
                }

            });

        });

    });
</script>