

    <section class="content">
        <header class="content__title">
            <h1>Administration</h1>
            <small>Bien venu à l'interface d'administration de postes</small>
        </header>

        <div class="row quick-stats animated fadeInRight">
            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-blue">
                    <div class="quick-stats__info">
                        <h2><?=count($poste)?></h2>
                        <small>Postes</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats">6,4,8,6,5,6,7,8,3,5,9,5</div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-amber">
                    <div class="quick-stats__info">
                        <h2><?=count($p_o)?></h2>
                        <small>Postes occupés</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats">4,7,6,2,5,3,8,6,6,4,8,6</div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-purple">
                    <div class="quick-stats__info">
                        <h2><?=count($p_v)?></h2>
                        <small>Postes vacants</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats">9,4,6,5,6,4,5,7,9,3,6,5</div>
                </div>
            </div>

            <div class="col-sm-6 col-md-3">
                <div class="quick-stats__item bg-red">
                    <div class="quick-stats__info">
                        <h2>214</h2>
                        <small>CV</small>
                    </div>

                    <div class="quick-stats__chart sparkline-bar-stats">5,6,3,9,7,5,4,6,5,6,4,9</div>
                </div>
            </div>
        </div>

        <div class="card animated fadeInLeft">
            <div class="card-body">
                <header class="content__title">
                    <div class="row">
                        <div class="col-md-3 content__title">
                            <h1><b>Postes</b></h1>
                        </div>
                    </div>
                </header>
                <div class="table-responsive">
                    <table id="data-table" class="table table-bordered">
                        <thead class="thead-default">
                            <tr class="text-center">
                                <th>No</th>
                                <th>Nom</th>
                                <th>Etat</th>
                            </tr>
                        </thead>                    
                        <tbody>
                            <?php
                                $num = 0;
                                foreach($poste as $p)
                                { $num++?> 
                                    <tr class="text-center text-justify">
                                        <td><?=$num?></td>
                                        <td><?=$p->name?></td>
                                        <td><?=$p->etat==1? 'Occupé': 'Vacant' ?></td>
                                    </tr>
                            <?php
                                }
                            ?>                                                          
                        </tbody>
                    </table>
                    <a href="<?=site_url('acceuil/all_poste')?>"><p class="text-center view-more">Voir plus</p></a>
                </div>
            </div>
        </div>

                
    </section>
</main>

        <!-- Older IE warning message -->
            <!--[if IE]>
                <div class="ie-warning">
                    <h1>Warning!!</h1>
                    <p>You are using an outdated version of Internet Explorer, please upgrade to any of the following web browsers to access this website.</p>

                    <div class="ie-warning__downloads">
                        <a href="http://www.google.com/chrome">
                            <img src="img/browsers/chrome.png" alt="">
                        </a>

                        <a href="https://www.mozilla.org/en-US/firefox/new">
                            <img src="img/browsers/firefox.png" alt="">
                        </a>

                        <a href="http://www.opera.com">
                            <img src="img/browsers/opera.png" alt="">
                        </a>

                        <a href="https://support.apple.com/downloads/safari">
                            <img src="img/browsers/safari.png" alt="">
                        </a>

                        <a href="https://www.microsoft.com/en-us/windows/microsoft-edge">
                            <img src="img/browsers/edge.png" alt="">
                        </a>

                        <a href="http://windows.microsoft.com/en-us/internet-explorer/download-ie">
                            <img src="img/browsers/ie.png" alt="">
                        </a>
                    </div>
                    <p>Sorry for the inconvenience!</p>
                </div>
            <![endif]-->

        <!-- Javascript -->
        <!-- Vendors -->
  