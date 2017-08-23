<?php
/**
 *
 * Dynmic_menu.php
 *
 */
class Dynamic_menu {

    private $ci;                // for CodeIgniter Super Global Reference.

    private $id_menu        = 'id="menu"';
    private $class_menu        = 'class="nav nav-list"';
    private $class_parent    = 'class="parent"';
    private $class_last        = 'class="last"';

    // --------------------------------------------------------------------

    /**
     * PHP5        Constructor
     *
     */
    function __construct()
    {
        $this->ci =& get_instance();    // get a reference to CodeIgniter.
	// $this->load->library('database');
    }

    // --------------------------------------------------------------------

    /**
     * build_menu($table, $type)
     *
     * Description:
     *
     * builds the Dynaminc dropdown menu
     * $table allows for passing in a MySQL table name for different menu tables.
     * $type is for the type of menu to display ie; topmenu, mainmenu, sidebar menu
     * or a footer menu.
     *
     * @param    string    the MySQL database table name.
     * @param    string    the type of menu to display.
     * @return    string    $html_out using CodeIgniter achor tags.
     */
    function build_menu($table = '', $type = '0',$otori = '0')
    {
        $menu = array();
        $tampung = array();

// use active record database to get the menu.
// $query = $this->ci->db->get($table);
//	  $this->ci =& get_instance();
//	  echo $this->userdata['pcOtoriName'];
//	$otoriname         = $CI->session->userdata('pcOtoriName');
//	$otori = $this->session->userdata('pcOtoriName');
	$CI =& get_instance();
	$otori = $CI->session->userdata('pcUser');
	$otori2 = $CI->session->userdata('pcOtoriName');
    $group = $CI->session->userdata('group');
	//echo "otori ==  ($otori)<br />";
	//echo "otori2 ==  ($otori2)<br />";
	//echo "type ==  ($type)<br />";
	$sq1 = "SELECT  a.id, a.title,  a.link_type,  a.page_id,  a.module_name,  a.url,  a.uri,  a.dyn_group_id,  a.position,  a.target,  a.parent_id,  a.is_parent,  
    '1' AS show_menu,a.icon,b.Create,b.Delete,b.Update FROM dyn_menu a JOIN sysmenugroup b ON a.id=b.id WHERE b.groupCode='$group' and show_menu='1' ORDER BY a.page_id "; 
	
    $sq2 = "SELECT  a.id, a.title,  a.link_type,  a.page_id,  a.module_name,  a.url,  a.uri,  a.dyn_group_id,  a.position,  a.target,  a.parent_id,  a.is_parent,  
	b.akses AS show_menu,a.icon FROM dyn_menu a JOIN otori b ON a.id=b.menu_id WHERE a.id in ('1','2','3','4','5','30') ORDER BY a.id "; 
	
    $sq = "$sq1"; 
	//echo "<br />$sq<br />";
	$x = 1;
	$query=$CI->db->query($sq);
        if ($query->num_rows() > 0)
        {
            // `id`, `title`, `link_type`, `page_id`, `module_name`, `url`, `uri`, `dyn_group_id`, `position`, `target`, `parent_id`, `show_menu`
            foreach ($query->result() as $row)
            {
				$tampung[$x]            = $row->id;
				//echo "zz===========>".$row->id."<br />";
				$x = $x+1;
				
                $menu[$row->id]['id']            = $row->id;
                $menu[$row->id]['title']        = $row->title;
                $menu[$row->id]['link']            = $row->link_type;
                $menu[$row->id]['page']            = $row->page_id;
                $menu[$row->id]['module']        = $row->module_name;
                $menu[$row->id]['url']            = $row->url;
                $menu[$row->id]['uri']            = $row->uri;
                $menu[$row->id]['dyn_group']    = $row->dyn_group_id;
                $menu[$row->id]['position']        = $row->position;
                $menu[$row->id]['target']        = $row->target;
                $menu[$row->id]['parent']        = $row->parent_id;
                $menu[$row->id]['is_parent']    = $row->is_parent;
                $menu[$row->id]['show']            = $row->show_menu;
                $menu[$row->id]['icon']            = $row->icon;
                $menu[$row->id]['create']            = $row->Create;
                $menu[$row->id]['delete']            = $row->Delete;
                $menu[$row->id]['update']            = $row->Update;
            }
        }
        $query->free_result();    // The $query result object will no longer be available

        // ----------------------------------------------------------------------
        
        // now we will build the dynamic menus.
        $html_out  = '';//"\t".'<div '.$this->id_menu.'>'."\n";

        /**
         * check $type for the type of menu to display.
         *
         * ( 0 = top menu ) ( 1 = horizontal ) ( 2 = vertical ) ( 3 = footer menu ).
         */
        switch ($type)
        {
            case 0:            // 0 = top menu
                break;

            case 1:            // 1 = horizontal menu
                $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";
                break;

            case 2:            // 2 = sidebar menu
                break;

            case 3:            // 3 = footer menu
                break;

            default:        // default = horizontal menu
                $html_out .= "\t\t".'<ul '.$this->class_menu.'>'."\n";

                break;
        }
		//echo "COUNT = (".count($menu).")<br />"; 
        // loop through the $menu array() and build the parent menus.
		//print_r($menu);
		//echo "<br /> ===>".$menu[30]['id']."<===<br />";
		
		

		$x = 1;

		//print_r($tampung);
       // $html_out .= "\t\t\t\t".'<li class="active">'.anchor("", '<i class="fa fa-tachometer bigger-140"></i><span class="menu-text"> &nbsp;&nbsp;Dashboard</span>');
        for ($a = 1; $a <= count($menu); $a++)
        {
		$xid = $tampung[$a];
		//echo "<br />====================================>$xid<br />";
			if (is_array($menu[$xid]))    // must be by construction but let's keep the errors home
            {
                if ($menu[$xid]['show'] && $menu[$xid]['parent'] == 0)    // are we allowed to see this menu?
                {
					if ($menu[$xid]['is_parent'] == TRUE)
                    {
                        // CodeIgniter's anchor(uri segments, text, attributes) tag.
                        $html_out .= "\t\t\t".'<li><a href= "#" class="dropdown-toggle"><i class="'.$menu[$xid]['icon'].'"></i> &nbsp;&nbsp;<span class="menu-text"> '.$menu[$xid]['title'].'</span><b class="arrow icon-angle-down"></b></a>';
                    }
                    else
                    {
                       // $html_out .= "\t\t\t\t".'<li>'.anchor($menu[$xid]['url'], '<i class="'.$menu[$xid]['icon'].'"></i> <span class="menu-text">'.$menu[$xid]['title'].'</span>');
                        $html_out .= "\t\t\t".'<li><a
                        href= "'.site_url('APP/HRIS').'?link='.$menu[$xid]['url'].'&create='.$menu[$xid]['create'].'&delete='.$menu[$xid]['delete'].'&update='.$menu[$xid]['update'].'&title='.$menu[$xid]['title'].'"
                        class="dropdown-toggle link"><i class="'.$menu[$xid]['icon'].'"></i> <span class="menu-text"> &nbsp;&nbsp;'.$menu[$xid]['title'].'</span></a>';
                    }

                    // loop through and build all the child submenus.
                    $html_out .= $this->get_childs($menu, $xid, $tampung);

                    $html_out .= '</li>'."\n";
                }
            }
            else
            {
                exit (sprintf('menu nr %s must be an array', $xid));
            }
		}

        $html_out .= "\t\t".'</ul>' . "\n";
        $html_out .= '';//"\t".'</div>' . "\n";
        return $html_out;
    } 
    
     // --------------------------------------------------------------------

    /**
     * get_childs($menu, $parent_id) - SEE Above Method.
     *
     * Description:
     *
     * Builds all child submenus using a recurse method call.
     *
     * @param    mixed    $menu    array()
     * @param    string    $parent_id    id of parent calling this method.
     * @return    mixed    $html_out if has subcats else FALSE
     */
    function get_childs($menu, $parent_id, $tampung)
    {
	   		//print_r($tampung);

	   
	    $has_subcats = FALSE;

        $html_out  = '';
        $html_out .= '';//"\n\t\t\t\t".'<div>'."\n";
        $html_out .= "\t\t\t\t\t".'<ul class="submenu">'."\n";

		for ($a = 1; $a <= count($menu); $a++)
        {
		$xid = $tampung[$a];
		
            if ($menu[$xid ]['show'] && $menu[$xid ]['parent'] == $parent_id)    // are we allowed to see this menu?
            {
                $has_subcats = TRUE;

                if ($menu[$xid ]['is_parent'] == TRUE)
                {
                    $html_out .= "\t\t\t\t\t\t".'<li><a href= "#" class="dropdown-toggle"><i class="icon-double-angle-right"></i><span><i class="'.$menu[$xid ]['icon'].'"></i>&nbsp;&nbsp;'.$menu[$xid ]['title'].'</span><b class="arrow icon-angle-down"></b></a>';
                }
                else
                {
                    $html_out .= "\t\t\t\t\t\t".'<li><a id="menu12345"
                    href= "'.site_url('APP/HRIS').'?link='.$menu[$xid]['url'].'&create='.$menu[$xid]['create'].'&delete='.$menu[$xid]['delete'].'&update='.$menu[$xid]['update'].'&title='.$menu[$xid]['title'].'"
                    class="dropdown-toggle link"><i class="icon-double-angle-right"></i><span><i class="'.$menu[$xid ]['icon'].'"></i>&nbsp;&nbsp;'.$menu[$xid ]['title'].'</span></a>';                    
                 //  $html_out .= "\t\t\t\t\t\t".'<li>'.anchor($menu[$xid ]['url'], '<i class="icon-double-angle-right"></i><span><i class="'.$menu[$xid ]['icon'].'"></i>&nbsp;&nbsp;'.$menu[$xid ]['title'].'</span>', array('class' => 'dropdown-toggle'));
                }

                // Recurse call to get more child submenus.
                $html_out .= $this->get_childs($menu, $xid , $tampung);

                $html_out .= '</li>' . "\n";
            }
        }

        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";
        $html_out .= '';//"\t\t\t\t".'</div>' . "\n";

        return ($has_subcats) ? $html_out : FALSE;
    }
}

// ------------------------------------------------------------------------
// End of Dynamic_menu Library Class.

// ------------------------------------------------------------------------
/* End of file Dynamic_menu.php */
/* Location: ../application/libraries/Dynamic_menu.php */  