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
                <?= $this->Form->create($dates,['url' => false, "id" => 'form_count']) ?>
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
                <button class="btn btn-primary button-sbmt" type="button" id="count" data-url="/dates/count">
                    <span class="spinner-border spinner-border-sm loader" role="status" aria-hidden="true"></span>
                    Count
                </button>
                <button class="btn btn-danger button-sbmt" type="button" id="save" data-url="/dates/add" style="display:none;">
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
            Recent
        </a>
        <?php foreach ($dates as $date): ?>
            <a href="#" class="list-group-item list-group-item-action">
                <?= h($date->date_from) ?> To <?= h($date->date_to) ?>
                Difference = <?= $this->Number->format($date->difference) ?> Days
            </a>
        <?php endforeach; ?>
        <a href="#" class="list-group-item list-group-item-action list-group-item-light" id="refresh">
            <div class="d-flex justify-content-center">
                <div class="spinner-border loader" role="status" style="display:none;"></div>
                Refresh
            </div>

        </a>
    </div>
</div>


<script>
    $(document).ready(function(){
        $("#refresh").on('click', function () {
            location.reload();
        });

        $("#form_count").on('click', '.button-sbmt',function(e){

            id = this.id;

            $.ajax({
                url: $(this).data('url'),
                type: 'POST',
                data:
                    $('#form_count').serialize()
                ,
                beforeSend: function() {
                    $('.loader').fadeIn();
                    $('.form-count').attr('disabled', true);
                },
                error: function(e) {

                    $(".alert.alert-danger").show();
                    $(".alert.alert-danger").text("Something wrong on submit");

                },
                dataType: 'json',
                success: function(data) {

                    if(id === "count")
                        $('input[name=difference]').val(data.data);
                        $('#save').fadeIn('slow');
                    if(id === "save")
                        $(".alert.alert-success").fadeIn();
                        $(".alert.alert-success").text("Data successfully saved");
                },
                complete: function(){
                    $('.form-count').attr('disabled', false);
                    $('.loader').fadeOut('slow');

                }

            });

        });
    });
</script>