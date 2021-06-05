<section class="content">
        <header class="content__title">
            <h1>Resultat</h1>
            <small>Voici les personnes qui repondent à ce critere</small>
        </header>
<div class="card animated fadeInLeft">
            <div class="card-body">
                <header class="content__title">
                    <div class="row">
                        <div class="col-md-7 content__title">
                            <h1><b><?=$poste?></b></h1>
                        </div>
                    </div>
                </header>                        
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered">
                        <thead class="thead-default">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Email</th>
                                <th>Nom complet</th>
                                <th>Province,Ville</th>
                                <th>Selectionner</th>
                            </tr>
                        </thead>                    
                        <tbody>
                        <form action="<?=site_url('acceuil/send_mail')?>" class="form-group" method="post">
                            <?php
                                $num = 0;                                
                                foreach($cv as $c)
                                {                                     
                                    if (count($c)>0) {
                                        $num = $num + 1;
                            ?>                                    
                                    <tr class="text-center text-justify">
                                    <td><?=$num?></td> 
                                        
                            <?php
                                    for ($i=0;$i<count($c);$i++) {
                                        if($i==1||$i==2||$i==3)
                                        {                                        
                            ?>                                                                               
                                        <td><?=$c['k'.$i]?></td>                                  
                            <?php
                                        }
                                    } 
                            ?>
                                        <td>                                        
                                            <div class="checkbox">
                                                <input type="checkbox" id="<?=$num?>" value="<?=$c['k1'].'-'.$c['k2']?>" name="<?=$c['k3']?>">
                                                <label class="checkbox__label" for="<?=$num?>"></label>
                                            </div>
                                        </td>
                                    </tr>
                                <?php
                                    }
                                }
                            ?>                                                                       
                        </tbody>
                    </table>                
                    <br>   
                    <div class="text-center">
                        <button class="btn btn-success text-center">Envoyer</button>
                    </div>  
                    </form>                    
                </div>              
            </div>
        </div>
</section>
