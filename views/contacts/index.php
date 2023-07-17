
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
    <!--====================  contact area ====================-->
    <div class="conact-section space__bottom--r120">
        <div class="container">
            <div class="row">
                <div class="col space__bottom--40">
                    <div class="contact-map">
                        <?php
                        if(isset($this->def[12]) && !empty($this->def[12])){
                            ?><iframe src="<?= $this->def[12] ?>"></iframe><?php
                        }
                        ?>

                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-12">
                    <div class="contact-information">
                        <h4 class="space__bottom--30"><?=Lang::get('{Əlaqə məlumatları}')?></h4>
                        <ul>
                            <li>
                                <span class="icon"><i class="fa fa-map-marker"></i></span>
                                <span class="text"><span><?= isset($this->def[6])? $this->def[6] : '' ?></span></span>
                            </li>
                            <li>
                                <span class="icon"><i class="fa fa-phone"></i></span>
                                <span class="text"><span><?= isset($this->def[4])? $this->def[4] : '' ?></span></span>
                            </li>
                            <li>
                                <span class="icon"><i class="fa fa-envelope-open"></i></span>
                                <span class="text"><span><?= isset($this->def[8])? $this->def[8] : '' ?></span></span>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-8 col-12">
                    <div class="contact-form">
                        <h4 class="space__bottom--30"><?=Lang::get('{Bizə məktub yazın}')?></h4>

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
                        <form id="contact-form" action="" method="post">
                            <?php $unique_form_name = Func::csrf_token_unique_form_name(); ?>

                            <input type="hidden" name="web_csrf_name" value="<?= $unique_form_name ?>">
                            <input type="hidden" name="web_csrf_token" value="<?= Func::csrf_token_generate($unique_form_name) ?>">

                            <div class="row row-10">
                                <div class="col-md-6 col-12 space__bottom--20">
                                    <input name="data_name" type="text" placeholder="<?=Lang::get('{Ad Soyad}')?> *" value="<?=(isset($data->data_name))?$data->data_name:''?>" required>
                                    <?=(isset($error))?Func::showError('data_name', $error):''?>
                                </div>
                                <div class="col-md-6 col-12 space__bottom--20">
                                    <input name="data_email" type="email" placeholder="<?=Lang::get('{E-mail ünvanı}')?> *" value="<?=(isset($data->data_email))?$data->data_email:''?>" required>
                                    <?=(isset($error))?Func::showError('data_email', $error):''?>
                                </div>
                                <div class="col-12">
                                    <textarea name="data_msg" placeholder="<?=Lang::get('{Mətn}')?> *" required><?=(isset($data->data_msg))?$data->data_msg:''?></textarea>
                                    <?=(isset($error))?Func::showError('data_msg', $error):''?>
                                </div>
                                <div class="col-12">
                                    <div class="form-group recaptcha-block">
                                        <div class="g-recaptcha" data-sitekey="<?= RECAPTCHA_SITEKEY ?>"></div>
                                        <?=(isset($error))?Func::showError('data_recaptcha', $error):''?>
                                        <script src="https://www.google.com/recaptcha/api.js" async defer></script>
                                    </div>
                                </div>

                                <div class="col-12"><button><?=Lang::get('{Göndər}')?></button></div>
                            </div>
                        </form>
                        <p class="form-message"></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--====================  End of contact area  ====================-->