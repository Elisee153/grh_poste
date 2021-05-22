<aside class="sidebar">
    <div class="scrollbar-inner">
        <div class="user">
            <div class="user__info" data-toggle="dropdown">
                <img class="user__img" src=<?=base_url("assets/demo/img/profile-pics/8.jpg")?> alt="">
                <div>
                    <div class="user__name"><?=$this->session->name?></div>
                    <div class="user__email"><?=$this->session->email?></div>
                </div>
            </div>
        </div>

        <ul class="navigation">
            <li id="home"><a href="<?=site_url('acceuil/index')?>"><i class="zmdi zmdi-home"></i> Acceuil</a></li>

            <li id="poste"><a href="<?=site_url('acceuil/all_poste')?>"><i class="zmdi zmdi-laptop zmdi-hc-fw"></i> Postes</a></li>

            <li id="filtre">
                <a href="<?=site_url('acceuil/filter')?>"><i class="zmdi zmdi-filter-list zmdi-hc-fw"></i> Filtre</a>
            </li>

            <li id="cv">
                <a href="<?=site_url('acceuil/cv')?>"><i class="zmdi zmdi-file-text zmdi-hc-fw"></i> Cv</a>
            </li>
        </ul>
    </div>
</aside>