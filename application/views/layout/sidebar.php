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
            <li class="navigation__active"><a href="<?=site_url('acceuil/index')?>"><i class="zmdi zmdi-home"></i> Home</a></li>

            <li><a href="<?=site_url('acceuil/all_poste')?>"><i class="zmdi zmdi-format-underlined"></i> Postes</a></li>

            <li class="navigation__sub">
                <a href="<?=site_url('acceuil/filter')?>"><i class="zmdi zmdi-view-list"></i> Filtre</a>
            </li>
        </ul>
    </div>
</aside>