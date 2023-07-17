<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="edit" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h4 class="modal-title custom_align" id="Heading"><?= Lang::get('{Silmə əməliyyatı}') ?></h4>
            </div>
            <div class="modal-body">
                <div class="alert alert-danger"><span class="glyphicon glyphicon-warning-sign"></span> <?=Lang::get('{Bu sətrin silinməsinə əminsinizmi?}')?></div>
            </div>
            <div class="modal-footer">
                <a href="#" class="btn btn-danger danger" id="btnYes"><span class="glyphicon glyphicon-ok-sign"></span> <?=Lang::get('{Bəli}')?></a>
                <a href="#" class="btn btn-warning secondary" data-dismiss="modal" aria-hidden="true"><span class="glyphicon glyphicon-remove"></span> <?=Lang::get('{Xeyr}')?></a>
            </div>
        </div>
    </div>
</div>