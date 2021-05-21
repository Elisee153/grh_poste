<section class="content">
    <div class="card animated fadeInLeft">
        <div class="card-body">
            <header class="content__title">
                <p><b>CRITERE</b></p>
                <small>Veuillez selectionner un poste et donner les criteres en les separant par une virgule</small>
            </header>
            <form class="row" action="<?=site_url('acceuil/filter')?>" method="post">
                <div class="col-md-6 offset-md-3">
                    <div class="form-group form-group--float">
                        <label style="margin-top:-9px"></label>
                        <div class="select">
                            <select class="form-control" name="poste" id="poste">
                                <?php
                                    foreach($poste as $p){
                                ?>
                                        <option value=<?=$p->id?>><?=$p->name?></option>
                                <?php
                                    }
                                ?>                    
                            </select>
                            <i class="form-group__bar"></i>
                        </div>            
                    </div> 

                    <div class="form-group form-group--float">                        
                        <input type="text" class="form-control" id="critere" name="critere" placeholder="Criteres" required>
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