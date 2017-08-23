<?php
class Dynmenucust{

    function __construct()
    {
        $CI =& get_instance();        
        $this->db= $CI->load->database();
    }

    function build_menu()
    {
    $html_out = '';
    $CI =& get_instance();
    $menu = array();
    $tampung = array();

    $group = '4';

	$sq1 = "
    SELECT a.IdMenu,a.title,a.url,a.parent_id,LENGTH(a.parent_id) AS par,a.icon,a.show_menu,is_parent FROM cust_menu a INNER JOIN cust_otor b ON a.IdMenu=b.IdMenu 
    WHERE IdGroup = '$group' ORDER BY IdMenu"; 
	
  	
    $sq = "$sq1"; 

	$x = 1;
	$query=$this->db->query($sq);
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
				$tampung[$x]            = $row->IdMenu;
				$x = $x+1;
				
                $menu[$row->IdMenu]['id']      = $row->IdMenu;
                $menu[$row->IdMenu]['title']   = $row->title;
                $menu[$row->IdMenu]['parent']  = $row->parent_id;
                $menu[$row->IdMenu]['is_parent']  = $row->is_parent;
                $menu[$row->IdMenu]['url']     = $row->url;
                $menu[$row->IdMenu]['icon']    = $row->icon;
                $menu[$row->IdMenu]['show']    = $row->show_menu;
                $menu[$row->IdMenu]['par']    = $row->par;
            }
        }
        $query->free_result(); 

       $html_out .= "\t\t".'<ul >' . "\n";


		$x = 1;
	   for ($a = 1; $a <= count($menu); $a++)
        {
		$xid = $tampung[$a];
			if (is_array($menu[$xid])) 
            {
                
                if ($menu[$xid]['par'] == 1)
                {
					if ($menu[$xid]['is_parent'] == 1)
                    {
                        $html_out .= '<li title="'.$menu[$xid]['title'].'">
                                        <a href="#">
                                            <span class="menu_icon"><i class="material-icons">'.$menu[$xid]['icon'].'</i></span>
                                            <span class="menu_title">'.$menu[$xid]['title'].'</span>    
                                        </a>';
                    }
                    else
                    {
                        $html_out .= '<li title="'.$menu[$xid]['title'].'">
                                        <a href="'.base_url().$menu[$xid]['url'].'">
                                            <span class="menu_icon"><i class="material-icons">'.$menu[$xid]['icon'].'</i></span>
                                            <span class="menu_title">'.$menu[$xid]['title'].'</span>
                                        </a>';
                    }

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
        $html_out .= '';
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
	   		
	    $has_subcats = FALSE;

        $html_out  = '';
        $html_out .= '';
        $html_out .= "\t\t\t\t\t".'<ul>'."\n";

		for ($a = 1; $a <= count($menu); $a++)
        {
		$xid = $tampung[$a];
		
            if ($menu[$xid ]['parent'] == $parent_id)   
            {
                $has_subcats = TRUE;

                if ($menu[$xid ]['is_parent'] == 1)
                {
                    $html_out .= "\t\t\t\t\t\t".'<li><a href="#" >'.$menu[$xid]['title'].'</a>';
                }
                else
                {
                    $html_out .= "\t\t\t\t\t\t".'<li><a href="'.base_url().$menu[$xid]['url'].'" onclick="show_mysidebar()">'.$menu[$xid]['title'].'</a>';                    
                }
                $html_out .= $this->get_childs($menu, $xid , $tampung);

                $html_out .= '</li>' . "\n";
            }
        }

        $html_out .= "\t\t\t\t\t".'</ul>' . "\n";
        $html_out .= '';

        return ($has_subcats) ? $html_out : FALSE;
    }
    
    
    function build_menu_head()
    {
    $html_out = '';
    $CI =& get_instance();
    $menu = array();
    $tampung = array();

    $group = '4';

	$sq1 = "SELECT a.IdMenu,a.title,a.url,a.parent,LENGTH(a.parent) AS par,a.icon,a.show_menu,is_parent FROM cust_menu a INNER JOIN cust_otor b ON a.IdMenu=b.IdMenu 
    WHERE parent = '0' and id_group = '$group' ORDER BY IdMenu "; 
	
  	
    $sq = "$sq1"; 

	$x = 1;
	$query=$this->db->query($sq);
        if ($query->num_rows() > 0)
        {
            foreach ($query->result() as $row)
            {
				$tampung[$x]            = $row->IdMenu;
				$x = $x+1;
				
                $menu[$row->IdMenu]['id']      = $row->IdMenu;
                $menu[$row->IdMenu]['title']   = $row->title;
                $menu[$row->IdMenu]['parent']  = $row->parent;
                $menu[$row->IdMenu]['is_parent']  = $row->parent;
                $menu[$row->IdMenu]['url']     = $row->url;
                $menu[$row->IdMenu]['icon']    = $row->icon;
                $menu[$row->IdMenu]['show']    = $row->show_menu;
                $menu[$row->IdMenu]['par']    = $row->par;
            }
        }
        $query->free_result(); 

       $html_out .= "\t\t".'<ul >' . "\n";


		$x = 1;
	   for ($a = 1; $a <= count($menu); $a++)
        {
		$xid = $tampung[$a];
	
			if (is_array($menu[$xid]))   
            {
                    $html_out .= '<a href="'.base_url().$menu[$xid]['url'].'/'.$menu[$xid]['id'].'">
                                     <i class="material-icons md-36">'.$menu[$xid]['icon'].'</i>
                                     <span class="uk-text-muted uk-display-block">'.$menu[$xid]['title'].'</span>
                                  </a>';
            }
            else
            {
                exit (sprintf('menu nr %s must be an array', $xid));
            }
		}

        $html_out .= "\t\t".'</ul>' . "\n";
        $html_out .= '';
        return $html_out;
    } 
}