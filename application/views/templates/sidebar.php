<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-info sidebar sidebar-dark accordion" id="accordionSidebar">

<!-- Sidebar - Brand -->
<a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
    <img src="<?= base_url('assets/img/boon-software_icon-circle.png') ?>" class="img-fluid mx-auto d-block">
    </div>
    <div class="sidebar-brand-text mx-3">PT Boon Software</div>
</a>

<!-- Divider -->
<hr class="sidebar-divider my-0"> 

<!-- Menu Query --> 
<?php 
    $role_id = $this->session->userdata('role_id');
    $menuQuery = "SELECT `user_menu`.`menu_id`, `menu_name` FROM `user_menu` JOIN `user_access_menu` 
                    ON `user_menu`.`menu_id` = `user_access_menu`.`menu_id` 
                    WHERE `user_access_menu`.`role_id` = $role_id 
                    ORDER BY `user_access_menu`.`amenu_id` ASC
                    "; 

    $menu = $this->db->query($menuQuery)->result_array();
?>

<!-- Divider -->
<hr class="sidebar-divider">

<!-- Menu Looping --> 
<?php foreach($menu as $m) : ?>
<div class="sidebar-heading">
    <?= $m['menu_name']; ?>
</div> 

<!-- Prepare sub menu that suits to menu --> 
<?php 
$menu_id = $m['menu_id'];
    $submenuQuery = "SELECT * FROM `user_sub_menu` JOIN `user_menu` 
                        ON `user_sub_menu`.`menu_id` = `user_menu`.`menu_id`
                    WHERE `user_sub_menu`.`menu_id` = $menu_id 
                    AND `user_sub_menu`.`is_active` = 1
                        "; 
    $submenu = $this->db->query($submenuQuery)->result_array(); 
?>
    <?php foreach($submenu as $sm) : ?> 
        <!-- Nav Item - Dashboard -->
        <li class="nav-item">
            <a class="nav-link" href="<?= base_url($sm['url']); ?>">
                <i class="<?= $sm['icon']; ?>"></i>
                <span><?= $sm['title']; ?></span></a>
        </li>
    <?php endforeach ?> 
        <!-- Divider -->
        <hr class="sidebar-divider">
<?php endforeach ?>

<li class="nav-item">
    <a class="nav-link" href="<?= base_url('auth/logout'); ?>" data-toggle="modal" data-target="#logoutModal">
    <i class="fas fa-fw fa-sign-out alt"></i>
    <span>Logout</span></a>
</li> 

    </ul> 

<!-- End of Sidebar -->