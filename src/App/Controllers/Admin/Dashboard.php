<?php
/**
 * Description of dashboard
 *
 * @author Douglas
 */
namespace Controllers\Admin {

    class Dashboard
    {

        private $template_sys;

        function __construct($template_system)
        {
            $this->template_sys = $template_system;
        }


        /* ====================================================================
         *  CONTROLLER ADMIN MENU
         * ==================================================================== */
        public function controller_loadAdminMenu($odin_add_menu)
        {
            add_action('admin_menu', function() use ($odin_add_menu) {
                return $this->build_admin_menu($odin_add_menu);
            });
        }


        private function build_admin_menu($oam, $twigBuilder = null)
        {
            $menu = $oam;
            $menu->add_menu("umbrella", "Umbrella", $capability = 'manage_options', function() {
                return $this->adminMenuTemplate();
            }, 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNjEycHgiIGhlaWdodD0iNjEycHgiIHZpZXdCb3g9IjAgMCA2MTIgNjEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MTIgNjEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGc+PHBhdGggZD0iTTU5OC4wMzksMTU3LjA1OWwtNzMuNDk0LTkyLjIwNmMtNi45NDMtOC43MS0xNy40NzYtMTMuNzg0LTI4LjYxNC0xMy43ODRIMTE2LjA2OGMtMTEuMTM4LDAtMjEuNjcsNS4wNzMtMjguNjEyLDEzLjc4M0wxMy45NiwxNTcuMDU5QzYuMjgxLDE2Ni42OTEsMCwxODQuNjUyLDAsMTk2Ljk3djMxOC4yMjNjMCwyNS4yNjEsMjAuNDc4LDQ1LjczOCw0NS43MzgsNDUuNzM4aDUyMC41MjRjMjUuMjYxLDAsNDUuNzM4LTIwLjQ3OCw0NS43MzgtNDUuNzM4VjE5Ni45N0M2MTIsMTg0LjY1Miw2MDUuNzE4LDE2Ni42OTEsNTk4LjAzOSwxNTcuMDU5eiBNNDMyLjY5NSwzNjYuNTYyYy0yMC4zOTEsMC0zNy40MDQsOC41MTUtNDEuMzYyLDE5LjgzOGgtMS42OTljLTMuODYyLTExLjM5Ni0yMC45MjgtMTkuOTg2LTQxLjQwNi0xOS45ODZjLTEzLjE5MiwwLTI0Ljk0MiwzLjU3Ni0zMi42ODUsOS4xNTh2OTUuODQ4YzAsMjMuODU0LTE5LjQwNiw0My4yNi00My4yNiw0My4yNmMtMjMuODU0LDAtNDMuMjYtMTkuNDA1LTQzLjI2LTQzLjI2YzAtNS4yNzEsNC4yNzEtOS41NDQsOS41NDMtOS41NDRjNS4yNzEsMCw5LjU0Miw0LjI3Miw5LjU0Miw5LjU0NGMwLDEzLjMyOSwxMC44NDUsMjQuMTc0LDI0LjE3NCwyNC4xNzRjMTMuMzMsMCwyNC4xNzUtMTAuODQ1LDI0LjE3NS0yNC4xNzR2LTk1LjY5MWMtNy43NDQtNS41ODYtMTkuNTAxLTkuMTY2LTMyLjY5OC05LjE2NmMtMjAuMzkxLDAtMzcuNDA2LDguNTE1LTQxLjM2MywxOS44MzhoLTEuNjk4Yy0zLjg2Mi0xMS4zOTYtMjAuOTI4LTE5Ljk4Ni00MS40MDctMTkuOTg2Yy0xMy4xNjEsMC0yNC45MTMsMy41NS0zMi42NTksOS4xMDljNi4yMjUtNjcuOTYsNzAuMTY5LTEyMS45NzksMTQ5LjgyNi0xMjYuMDAydi03LjEzNGMwLTUuMjcxLDQuMjcxLTkuNTQyLDkuNTQyLTkuNTQyczkuNTQzLDQuMjcxLDkuNTQzLDkuNTQydjcuMTM1Yzc5LjcxMiw0LjAzMiwxNDMuNjg3LDU4LjEzLDE0OS44MjUsMTI2LjE2QzQ1Ny42MjMsMzcwLjExNyw0NDUuODY1LDM2Ni41NjIsNDMyLjY5NSwzNjYuNTYyeiBNMzcuOTc5LDE1Ni4yNzhsMjQuMzM4LTMwLjUzNmgxNjYuMDYxbDE2LjM4Ny0yNi45NDNIODMuNzkzbDE3Ljk2OS0yMi41NDRjMy40OTEtNC4zOCw4LjcwNi02Ljg5MiwxNC4zMDYtNi44OTJoMzc5Ljg2M2M1LjYwMiwwLDEwLjgxNSwyLjUxMiwxNC4zMDgsNi44OTJsMTcuOTY5LDIyLjU0NGgtMTYzLjg0bDkuMTQ3LDI2Ljk0M2gxNzYuMTY3bDI0LjMzOSwzMC41MzZIMzcuOTc5eiIvPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48L3N2Zz4=');
        }


        private function adminMenuTemplate()
        {
            global $twig;
            echo $this->template_sys->render('dashboard.twig', array(
                'plugin_is_auth' => true
                    )
            );
        }


//        private function build_dashboard($oam, $twigBuilder = null)
//        {
//            $menu = $oam;
//            $menu->add_menu("umbrella", "Umbrella", $capability = 'manage_options', function() {
//                return $this->adminDashboardTemplate();
//            }, 'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iaXNvLTg4NTktMSI/PjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCI+PHN2ZyB2ZXJzaW9uPSIxLjEiIGlkPSJDYXBhXzEiIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgeG1sbnM6eGxpbms9Imh0dHA6Ly93d3cudzMub3JnLzE5OTkveGxpbmsiIHg9IjBweCIgeT0iMHB4IiB3aWR0aD0iNjEycHgiIGhlaWdodD0iNjEycHgiIHZpZXdCb3g9IjAgMCA2MTIgNjEyIiBzdHlsZT0iZW5hYmxlLWJhY2tncm91bmQ6bmV3IDAgMCA2MTIgNjEyOyIgeG1sOnNwYWNlPSJwcmVzZXJ2ZSI+PGc+PHBhdGggZD0iTTU5OC4wMzksMTU3LjA1OWwtNzMuNDk0LTkyLjIwNmMtNi45NDMtOC43MS0xNy40NzYtMTMuNzg0LTI4LjYxNC0xMy43ODRIMTE2LjA2OGMtMTEuMTM4LDAtMjEuNjcsNS4wNzMtMjguNjEyLDEzLjc4M0wxMy45NiwxNTcuMDU5QzYuMjgxLDE2Ni42OTEsMCwxODQuNjUyLDAsMTk2Ljk3djMxOC4yMjNjMCwyNS4yNjEsMjAuNDc4LDQ1LjczOCw0NS43MzgsNDUuNzM4aDUyMC41MjRjMjUuMjYxLDAsNDUuNzM4LTIwLjQ3OCw0NS43MzgtNDUuNzM4VjE5Ni45N0M2MTIsMTg0LjY1Miw2MDUuNzE4LDE2Ni42OTEsNTk4LjAzOSwxNTcuMDU5eiBNNDMyLjY5NSwzNjYuNTYyYy0yMC4zOTEsMC0zNy40MDQsOC41MTUtNDEuMzYyLDE5LjgzOGgtMS42OTljLTMuODYyLTExLjM5Ni0yMC45MjgtMTkuOTg2LTQxLjQwNi0xOS45ODZjLTEzLjE5MiwwLTI0Ljk0MiwzLjU3Ni0zMi42ODUsOS4xNTh2OTUuODQ4YzAsMjMuODU0LTE5LjQwNiw0My4yNi00My4yNiw0My4yNmMtMjMuODU0LDAtNDMuMjYtMTkuNDA1LTQzLjI2LTQzLjI2YzAtNS4yNzEsNC4yNzEtOS41NDQsOS41NDMtOS41NDRjNS4yNzEsMCw5LjU0Miw0LjI3Miw5LjU0Miw5LjU0NGMwLDEzLjMyOSwxMC44NDUsMjQuMTc0LDI0LjE3NCwyNC4xNzRjMTMuMzMsMCwyNC4xNzUtMTAuODQ1LDI0LjE3NS0yNC4xNzR2LTk1LjY5MWMtNy43NDQtNS41ODYtMTkuNTAxLTkuMTY2LTMyLjY5OC05LjE2NmMtMjAuMzkxLDAtMzcuNDA2LDguNTE1LTQxLjM2MywxOS44MzhoLTEuNjk4Yy0zLjg2Mi0xMS4zOTYtMjAuOTI4LTE5Ljk4Ni00MS40MDctMTkuOTg2Yy0xMy4xNjEsMC0yNC45MTMsMy41NS0zMi42NTksOS4xMDljNi4yMjUtNjcuOTYsNzAuMTY5LTEyMS45NzksMTQ5LjgyNi0xMjYuMDAydi03LjEzNGMwLTUuMjcxLDQuMjcxLTkuNTQyLDkuNTQyLTkuNTQyczkuNTQzLDQuMjcxLDkuNTQzLDkuNTQydjcuMTM1Yzc5LjcxMiw0LjAzMiwxNDMuNjg3LDU4LjEzLDE0OS44MjUsMTI2LjE2QzQ1Ny42MjMsMzcwLjExNyw0NDUuODY1LDM2Ni41NjIsNDMyLjY5NSwzNjYuNTYyeiBNMzcuOTc5LDE1Ni4yNzhsMjQuMzM4LTMwLjUzNmgxNjYuMDYxbDE2LjM4Ny0yNi45NDNIODMuNzkzbDE3Ljk2OS0yMi41NDRjMy40OTEtNC4zOCw4LjcwNi02Ljg5MiwxNC4zMDYtNi44OTJoMzc5Ljg2M2M1LjYwMiwwLDEwLjgxNSwyLjUxMiwxNC4zMDgsNi44OTJsMTcuOTY5LDIyLjU0NGgtMTYzLjg0bDkuMTQ3LDI2Ljk0M2gxNzYuMTY3bDI0LjMzOSwzMC41MzZIMzcuOTc5eiIvPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48Zz48L2c+PGc+PC9nPjxnPjwvZz48L3N2Zz4=');
//
////            //Descomente para adicionar um submenu
////            $submenu = clone $oam;
////            $submenu->add_submenu("umbrella/developer", $menu, "Definições de Desenvolvedor", "Developer", 'manage_options', function() {
////                return $this->adminEditTemplate();
////            });
//        }
    }
}
