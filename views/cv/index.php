
    <!--====================  breadcrumb area ====================-->
    <div class="page-breadcrumb bg-img space__bottom--r120" data-bg="<?=URL?>public/assets/img/backgrounds/bc-bg.jpg">
        <div class="container">
            <div class="row">
                <div class="col">
                    <div class="page-breadcrumb-content text-center">
                        <h1><?=((isset($this->pages['subtitle']) && !empty($this->pages['subtitle']))?$this->pages['subtitle']:(isset($this->pages['title'])?$this->pages['title']:''))?></h1>
                        <ul class="page-breadcrumb-links">
                            <li><a href="<?=URL.MF::$_lang?>"><?=Lang::get('{Ana səhifə}')?> </a></li>
                            <li><?=isset($this->pages['title'])?$this->pages['title']:''?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of breadcrumb area  ====================-->

    <!--====================  about area ====================-->
    <div class="about-area space__bottom--r120">
        <div class="container">
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
                    if(isset($this->postData->headerError)){
                        Func::headerAlert($this->postData->headerError);
                    }

                    // formError
                    if(isset($this->postData->formError)){
                        $error = $this->postData->formError;
                    }

                    // data
                    if(isset($this->postData->data)){
                        $data = $this->postData->data;
                    }
                    ?>

                    <form action="" method="post" class="cv-form" enctype="multipart/form-data">
                        <?php $unique_form_name = Func::csrf_token_unique_form_name(); ?>

                        <input type="hidden" name="web_csrf_name" value="<?= $unique_form_name ?>">
                        <input type="hidden" name="web_csrf_token" value="<?= Func::csrf_token_generate($unique_form_name) ?>">

                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="data_name"><?=Lang::get('{Adınız}')?> *</label>
                                <input type="text" class="form-control" id="data_name" name="data_name" value="<?=(isset($data->data_name))?$data->data_name:''?>" required>
                                <?=(isset($error))?Func::showError('data_name', $error):''?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="data_surname"><?=Lang::get('{Soyadınız}')?> *</label>
                                <input type="text" class="form-control" id="data_surname" name="data_surname" value="<?=(isset($data->data_surname))?$data->data_surname:''?>" required>
                                <?=(isset($error))?Func::showError('data_surname', $error):''?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="data_father"><?=Lang::get('{Ata adı}')?> *</label>
                                <input type="text" class="form-control" id="data_father" name="data_father" value="<?=(isset($data->data_father))?$data->data_father:''?>" required>
                                <?=(isset($error))?Func::showError('data_father', $error):''?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="data_birthday"><?=Lang::get('{Təvəllüd}')?> *</label>
                                <input type="text" class="form-control" id="data_birthday" name="data_birthday" value="<?=(isset($data->data_birthday))?$data->data_birthday:''?>" required>
                                <?=(isset($error))?Func::showError('data_birthday', $error):''?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="data_mob_phone"><?=Lang::get('{Mobil telefon}')?> *</label>
                                <input type="text" class="form-control" id="data_mob_phone" name="data_mob_phone" value="<?=(isset($data->data_mob_phone))?$data->data_mob_phone:''?>" required>
                                <?=(isset($error))?Func::showError('data_mob_phone', $error):''?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="data_email"><?=Lang::get('{E-poçt}')?> *</label>
                                <input type="email" class="form-control" id="data_email" name="data_email" value="<?=(isset($data->data_email))?$data->data_email:''?>" required>
                                <?=(isset($error))?Func::showError('data_email', $error):''?>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="data_photo"><?=Lang::get('{Şəkil}')?> *</label>
                                <input type="file" class="form-control-file" id="data_photo" name="data_photo" required>
                                <?=(isset($error))?Func::showError('data_photo', $error):''?>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="data_file"><?=Lang::get('{CV Yüklə}')?> *</label>
                                <input type="file" class="form-control-file" id="data_file" name="data_file" required>
                                <?=(isset($error))?Func::showError('data_file', $error):''?>
                            </div>
                        </div>

                        <div class="form-row">

                            <div class="col-12">
                                <div class="form-group recaptcha-block">
                                    <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITEKEY ?>"></div>
                                    <?=(isset($error))?Func::showError('data_recaptcha', $error):''?>
                                    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                </div>
                            </div>

                            <div class="form-group col-md-4">
                                <br>
                                <button type="submit" class="btn btn-primary"><?=Lang::get('{CV GÖNDƏR}')?></button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of about area  ====================-->

    <?php require __DIR__.'/../footer_partners.php'; ?>