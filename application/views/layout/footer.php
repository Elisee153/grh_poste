<script src=<?= base_url('assets/vendors/jquery/jquery.min.js')?>></script>

<?php
    if(isset($index_menu))
    {
?>
    <script>
        $(function(){
            $('#home').addClass('navigation__active');
        })
    </script>
<?php
    }else{
?>
    <script>
        $(function(){
            $('#home').removeClass('navigation__active');
        })
    </script>
<?php
    }
?>
<?php
    if(isset($poste_menu))
    {
?>
    <script>
        $(function(){
            $('#poste').addClass('navigation__active');
        })
    </script>
<?php
    }else{
?>
    <script>
        $(function(){
            $('#poste').removeClass('navigation__active');
        })
    </script>
<?php
    }
?>
<?php
    if(isset($filtre_menu))
    {
?>
    <script>
        $(function(){
            $('#filtre').addClass('navigation__active');
        })
    </script>
<?php
    }else{
?>
    <script>
        $(function(){
            $('#filtre').removeClass('navigation__active');
        })
    </script>
<?php
    }
?>
<?php
    if(isset($cv_menu))
    {
?>
    <script>
        $(function(){
            $('#cv').addClass('navigation__active');
        })
    </script>
<?php
    }else{
?>
    <script>
        $(function(){
            $('#cv').removeClass('navigation__active');
        })
    </script>
<?php
    }
?>

<footer class="footer hidden-xs-down">
    <p>© GRH. All rights reserved.</p>

    <ul class="nav footer__nav">
        <a class="nav-link" href="<?=site_url("acceuil/index")?>">Acceuil</a>

        <a class="nav-link" href="<?=site_url("acceuil/all_poste")?>">Postes</a>

        <a class="nav-link" href="<?=site_url("acceuil/cv")?>">CV</a>
    </ul>
</footer>