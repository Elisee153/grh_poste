<?php
    if($this->session->poste_added)
    {
?>
        <script>swal("Bon travail!", "Poste ajouté avec succè!", "success");</script>
<?php
    }
?>

<section class="content">
    <header class="content__title">
        <h1 class="animated"><b>Postes</b></h1>
    </header>

    <div class="card animated fadeInLeft">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-3 content__title">
                    <h1><b>Postes occupés</b></h1>
                </div>
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="user_space">
                        <?php
                            $num = 0;
                            foreach($p_o as $p)
                            { $num++?> 
                                <tr class="text-center">
                                    <td style="text-align: center;"><?=$num?></td>                                    
                                    <td><?=$p->name?></td>
                                    <td width="150px">                                        
                                        <form id="form-delete1" onclick='javascript:confirmation($(this));return false;'action="<?= site_url("acceuil/change_stat")?>" method="post">                                
                                            <input type="hidden" value="<?=$p->id?>" name="id">
                                            <input type="hidden" value="<?=$p->etat?>" name="etat">
                                            <button id="delete1" class="btn btn-success btn--raised" title="Mettre en vacance">
                                                <i class="zmdi zmdi-assignment-alert zmdi-hc-fw" style="font-size:20px"></></i>
                                            </button>
                                        </form>                                                                                 
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr><br>
    <div class="card animated fadeInRight">
        <div class="card-body">
        <header class="content__title">
            <div class="row">
                <div class="col-md-3 content__title">
                    <h1><b>Postes vacants</b></h1>
                </div>                
            </div>
        </header>
            <div class="table-responsive">
                <table id="data-table" class="table table-bordered">
                    <thead class="thead-default">
                        <tr class="text-center">
                            <th>No</th>
                            <th>Nom</th>
                            <th>Actions</th>
                        </tr>
                    </thead>                    
                    <tbody id="user_space">
                        <?php
                            $num = 0;
                            foreach($p_v as $p)
                            { $num++?> 
                                <tr class="text-center">
                                    <td style="text-align: center;"><?=$num?></td>                                    
                                    <td><?=$p->name?></td>
                                    <td width="150px">                                        
                                        <form id="form-delete" onclick='javascript:confirmation2($(this));return false;'action="<?= site_url("acceuil/change_stat")?>" method="post">                                
                                            <input type="hidden" value="<?=$p->id?>" name="id">
                                            <input type="hidden" value="<?=$p->etat?>" name="etat">
                                            <button id="delete" class="btn btn-success btn--raised" title="Occupé">
                                                <i class="zmdi zmdi-assignment-check zmdi-hc-fw" style="font-size:20px"></i>
                                            </button>
                                        </form>                                                                                 
                                    </td>
                                </tr>
                        <?php
                            }
                        ?>                                                          
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <hr><br>
    <div class="card animated fadeInLeft">
        <div class="card-body">
            <header class="content__title">
                <p><b>Nouveau poste</b></p>
            </header>
            <form class="row" action="<?=site_url('acceuil/new_poste')?>" method="post">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nom du nouveau poste" required>
                        <i class="form-group__bar"></i>
                    </div>                   

                    <div class="text-center">
                        <p id="error_message" class="text-red animated fadeInUp" hidden>Complete the missing informations</p>
                        <button type="submit" id="submit" class="btn btn--icon login__block__btn">
                            <i class="zmdi zmdi-check"></i>
                        </button>
                    </div>

                </div>
            </form>
        </div>
    </div>
</section>

<script src=<?= base_url('assets/vendors/jquery/jquery.min.js')?>></script>

<script>
   //=================================================================
    function confirmation(anchor)
    {
        swal({
            title: "Voulez-vous vraiment mettre ce poste en vacance?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                swal("Poste mis en vacance!", {
                icon: "success",
                });
                anchor.submit();
            } else {
                swal("Opération annullée!");
            }
        });
    } 
    //=======================================================================
    function confirmation2(anchor)
    {
        swal({
            title: "Voulez-vous vraiment mettre ce poste en Occupation?",
            text: "",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                swal("Poste mis en occupation!", {
                icon: "success",
                });
                anchor.submit();
            } else {
                swal("Opération annullée!");
            }
        });
    }
    //=============================================================================
    $(function()
    {
        $('.edit').click(function(e)
        {
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];
            
            $('.td'+id).attr('hidden',true);
            $('.td-form'+id).removeAttr('hidden'); 
            $('#edit-'+id).attr('hidden',true);
            $('#check-'+id).removeAttr('hidden');
        })

        $('.check').click(function(e)
        {
            e.preventDefault();

            var id = e.target.getAttribute('id').split('-')[1];

            var orateur = $('#orateur-'+id).val();
            var service = $('#service-'+id).val();
            var date = $('#date-'+id).val();
            var lieu = $('#lieu-'+id).val();
            var theme = $('#theme-'+id).val();
            var verset = $('#verset-'+id).val();
            var video = $('#video-'+id).val();

            $.post('<?=site_url('ajax/edit_sermon')?>', { orateur: orateur, service: service, date:date,
            lieu:lieu,theme:theme,verset:verset,video:video,id:id},
                function(data,textStatus, jqXHR) 
                {
                    if(data == 1)
                    {
                        location.assign('<?=site_url("admin/all_sermons")?>'); 
                    }                                         
                }
            )
        })
    })
           
</script>