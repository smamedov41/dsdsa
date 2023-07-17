<div class="row bg-title">
    <div class="col-lg-12">
        <h4 class="page-title"><?= Lang::get($this->menu) ?>
            <?php
            if(Func::checkAdminActionButton($this->admin, $this->menu, 'add')){
                ?><div class="pull-right"><a href="<?= URL . $this->menu ?>/add" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> <?= Lang::get('{Yenisini yarat}') ?></a></div> <?php
            }
            ?>
        </h4>
        <ol class="breadcrumb">
            <li><a href="<?=URL?>index"><?=Lang::get('{İdarəetmə paneli}')?></a></li>
            <li><a href="<?=URL.$this->menu?>"><?= Lang::get($this->menu)?></a></li>
            <li class="active"><?= $this->titleSub ?></li>
        </ol>
    </div>
</div>
<!-- /.row -->

<div class="row">
    <div class="col-md-12">
        <?php
        // show success
        $alert = Session::get('note_success') ? Session::get('note_success') : NULL;
        if($alert){
            Func::headerAlert($alert, 'success');
            Session::delete('note_success');
        }

        // show error
        $alert = Session::get('note_error') ? Session::get('note_error') : NULL;
        if($alert){
            Func::headerAlert($alert);
            Session::delete('note_error');
        }

        // token for ordering, delete, change status
        $token = Func::token('token_'.$this->menu);
        ?>
        <div class="panel panel-default">
            <div class="panel-body">

                <menu id="nestable-menu">
                    <button type="button" data-action="collapse-all" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-plus"></span> <?=Lang::get('{Bölmələri yığ}')?></button>
                    <button type="button" data-action="expand-all" class="btn btn-success btn-sm"><span class="glyphicon glyphicon-minus"></span> <?=Lang::get('{Bölmələri genişləndir}')?></button>
                </menu>

                <div class="dd" id="nestable" data-url="<?= URL . $this->menu ?>" data-token="<?=$token?>">
                    <?php
                    function has_children($rows,$id) {
                        foreach ($rows as $row) {
                            if ($row['parent'] == $id)
                                return true;
                        }
                        return false;
                    }

                    function build_menu($rows,$parent=0, $admin, $menu){
                        $result = '<ol class="dd-list">';
                        foreach ($rows as $row) {
                            if ($row['parent'] == $parent){

                                $link = Func::create_link($row);

                                $result.= '<li class="dd-item dd3-item" data-id="'.$row['id'].'">
                                                <div class="dd-handle dd3-handle">Drag</div>
                                                <div class="dd3-content"><div class="content-title"><strong>'.$row['title'].'</strong><br><i>'.$link.'</i></div>';

                                    if(Func::checkAdminActionButton($admin, $menu, 'edit')){
                                        $status = ($row['status'] == 2) ? ' checked' : ' deactive';
                                        $result .= '<div class="content-status"><input type="checkbox"'.$status.' data-toggle="toggle" data-size="mini"></div>';
                                    } else {
                                        $status = ($row['status'] == 2) ? Lang::get('{Aktiv}') : '<span class="color-red">'.Lang::get('{Passiv}').'</span>';
                                        $result .= '<div class="content-status">'.$status.'</div>';
                                    }
                                    if(Func::checkAdminActionButton($admin, $menu, 'delete')){
                                        $result .= '<div class="content-link"><a class="btn btn-xs confirm-delete"><span class="glyphicon glyphicon-trash"></span></a></div>';
                                    }
                                    if(Func::checkAdminActionButton($admin, $menu, 'edit')){
                                        $result .= '<div class="content-link"><a class="btn btn-xs" href="'.URL . $menu.'/edit/'.$row['id'].'"><span class="glyphicon glyphicon-pencil"></span></a></div>';
                                    }
                                $result .= '</div>';

                                if (has_children($rows,$row['id']))
                                    $result.= build_menu($rows,$row['id'], $admin, $menu);
                                $result.= '</li>';
                            }
                        }
                        $result.= '</ol>';

                        return $result;
                    }
                    echo build_menu($this->listItems, 0, $this->admin, $this->menu);
                    ?>

                </div>

            </div>
        </div>
    </div>
</div>
<!-- /.row -->

<?php require __DIR__.'/../delete_modal.php'; ?>