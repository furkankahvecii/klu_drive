<?php $this->load->view('template/v_header'); ?>
<?php $this->load->view('template/v_menu'); ?>

<div class="pcoded-content">
    <div class="page-header card">
        <div class="row align-items-end">
            <div class="col-lg-8">
                <?php if(isset($mesaj))
                {
                    if($mesaj == "accept")
                    {
                        echo '<div class="alert alert-success background-success">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        <strong>' . $email . ' mail sahibi personele ' . $size . ' MB yer ayrıldı. </strong></div>';
                    }
                    else{
                        echo '<div class="alert alert-danger background-danger">
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <i class="icofont icofont-close-line-circled text-white"></i>
                        </button>
                        <strong> Lütfen girilen maili kontrol ediniz. </strong></div>';
                    }
                }
                ?>
                <div class="page-header-title">
                    <i class="feather icon-clipboard bg-c-blue"></i>
                    <div class="d-inline">
                        <h5>Personel Ekleme Sayfası</h5>
                        <span>KLU Drive uygulamasından yararlanmak isteyen KLU personellerini mail adresleri
                            ile ekleyebilirsiniz.</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="pcoded-inner-content">
        <div class="main-body">
            <div class="page-wrapper">
                <div class="page-body">
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-header">
                                    <h5>Personel Ekle</h5>
                                    <span>Add class of <code>.form-control</code> with <code>&lt;input&gt;</code>
                                        tag</span>
                                </div>
                                <div class="card-block">
                                    <form id="form" name="form" method="post"
                                        action="<?php echo base_url();?>AddManager/addDatabase">
                                        <div class="form-group row" id="renkButonu" name="renkButonu">
                                            <label class="col-sm-2 col-form-label" for="inputSuccess1">Email
                                                Adress</label>
                                            <div class="col-sm-10">
                                                <input type="email" class="form-control" id="email" name="email"
                                                    placeholder="furkankahveci@klu.edu.tr" autocomplete="off">
                                                <div class="col-form-label" id="message"></div>
                                            </div>
                                        </div>

                                        <div class="form-group row" style="display:none;" id="sizeId" name="sizeId">
                                            <label class="col-sm-2 col-form-label">Size(MB)</label>
                                            <div class="col-sm-8">
                                                <input type="number" min="0" max="9999" class="form-control" id="size"
                                                    name="size" placeholder="Integers Only" autocomplete="off" required>
                                                <span class="messages"></span>
                                            </div>
                                        </div>

                                        <div class="form-group row" style="display:none;" id="personalityInformation">
                                            <label class="col-sm-2 col-form-label">Adı</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="name" name="name"
                                                    readonly="">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Soyadı</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="surname" name="surname"
                                                    placeholder="" readonly="">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Unvan</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="unvan" name="unvan"
                                                    placeholder="" readonly="">
                                            </div>
                                        </div>

                                        <div class="form-group row" style="display:none;" id="dutyInformation">
                                            <label class="col-sm-2 col-form-label">Program Adı</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="progad" name="progad"
                                                    placeholder="" readonly="">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Fakulte Adı</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="fakad" name="fakad"
                                                    placeholder="" readonly="">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Bolum Adı</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="bolad" name="bolad"
                                                    placeholder="" readonly="">
                                            </div>
                                        </div>

                                        <div class="form-group row" style="display:none;" id="generalInformation">
                                            <label class="col-sm-2 col-form-label">Brans Adı</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="brans" name="brans"
                                                    placeholder="" readonly="">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Personel Tipi</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="perTip" name="perTip"
                                                    placeholder="" readonly="">
                                            </div>
                                            <label class="col-sm-2 col-form-label">Aktif</label>
                                            <div class="col-sm-2">
                                                <input type="text" class="form-control" id="aktif" name="aktif"
                                                    placeholder="" readonly="">
                                            </div>
                                        </div>

                                        <div class="form-group row" style="display:none;" id="btnGonder">
                                            <label class="col-sm-4 col-form-label"></label>
                                            <div class="col-sm-2">
                                                <button
                                                    class="btn btn-mat waves-effect waves-light btn-inverse">Gönder</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript" src="<?php echo base_url(); ?>/html/js/ajaxData.js"></script>

    <?php $this->load->view('template/v_footer'); ?>